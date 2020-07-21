<?
	//print_r($opt_postalcode); die;
	if (!isset($register)){
		$register = array(
						'CUSTOMER_ID'	=> '',
						'NAME'			=> '',
						'ADDRESS'		=> '',
						'NPWP'			=> '',
						'PASSPORT'			=> '',
						'CITIZENSHIP'  	=> 'WNI',
						'EMAIL'			=> '',
						'WEBSITE'		=> '',
						'PHONE'			=> '',
						'COMPANY_TYPE'	=> '', 
						'ALT_NAME'		=> '', 
						'DEED_ESTABLISHMENT'	=> '',
						'CUSTOMER_GROUP'		=> '', 
						'CUSTOMER_TYPE'			=> '', 				// deprecated
						'SVC_VESSEL'		=> '', 
						'SVC_CARGO'			=> '',
						'SVC_CONTAINER'		=> '', 
						'SVC_MISC'			=> '', 
						'IS_SUBSIDIARY'		=> 'N', 
						'HOLDING_NAME'		=> '',
						'EMPLOYEE_COUNT'	=> '', 
						'IS_MAIN_BRANCH'	=> '', 
						'PARTNERSHIP_DATE'	=> '',
						'PROVINCE'			=> '', 
						'CITY'				=> '', 
						'KECAMATAN'			=> '', 
						'KELURAHAN'			=> '', 
						'POSTAL_CODE'		=> '',
						'FAX'				=> '', 
						'PARENT_ID'			=> '',
						'IS_SHIPPING_AGENT'	=> '',
						'IS_SHIPPING_LINE'	=> '',
						'IS_PBM'			=> '',
						'IS_FF'				=> '',
						'IS_EMKL'			=> '',
						'IS_PPJK'			=> '',
						'IS_CONSIGNEE'		=> '',
						'IS_RUPA'	=> '',
						'HEADQUARTERS_ID'		=> '',
						'HEADQUARTERS_NAME'		=> '',
						'REG_TYPE'			=> 'OLD'
					);	
	}

	$sel_partnership_date = $register['PARTNERSHIP_DATE'];

	$sel_register_type = array(
		($register['IS_CUSTOMER']=='Y'?'CUS':''),
		($register['IS_MITRA']=='Y'?'MTR':'')
	);
	
	$sel_service_type = array(
		($register['SVC_CARGO']=='Y'?'CONGC':''),
		($register['SVC_CONTAINER']=='Y'?'CONGC':''),
		($register['SVC_VESSEL']=='Y'?'VESSE':''),
		($register['SVC_MISC']=='Y'?'MISC':'')
	);
	
	// TO BE ADDED LATER WHEN OTHER CUSTOMER TYPES ARE AVAILABLE
	/*$sel_customer_type = array(
		($register['IS_SHIPPING_AGENT']=='Y'?'SHIPA':''),
		($register['IS_SHIPPING_LINE']=='Y'?'SHIPL':''),
		($register['IS_PBM']=='Y'?'STVCO':''),
		($register['IS_FF']=='Y'?'FFORW':''),
		($register['IS_EMKL']=='Y'?'EMKL':''),
		($register['IS_PPJK']=='Y'?'PPJK':''),
		($register['IS_CONSIGNEE']=='Y'?'CONSG':'')
	);*/
	$sel_customer_type="";
	VAR_DUMP($register['IS_PBM']);
	if($register['IS_SHIPPING_AGENT']=='Y')
	{
		$sel_customer_type = 'SHIPA';
	}
	else if($register['IS_SHIPPING_LINE']=='Y')
	{
		$sel_customer_type = 'SHIPL';
	}
	else if($register['IS_PBM']=='Y')
	{
		$sel_customer_type = 'STVCO';
	}
	else if($register['IS_FF']=='Y')
	{
		$sel_customer_type = 'FFORW';
	}
	else if($register['IS_EMKL']=='Y')
	{
		$sel_customer_type = 'EMKL';
	}
	else if($register['IS_PPJK']=='Y')
	{
		$sel_customer_type = 'PPJK';
	}
	else if($register['IS_CONSIGNEE']=='Y')
	{
		$sel_customer_type = 'CONSG';
	}
	else if($register['IS_RUPA']=='Y'){
		$sel_customer_type = 'RUPA';
	}

	//$sel_customer_type = $register['CUSTOMER_TYPE'];
		
	$sel_entity_type = ($register['IS_MAIN_BRANCH']=='Y'?'MAIN':'BRNCH');

	if(!isset($isEditing)){$isEditing = false;}
	if(!isset($simop_name)){$simop_name = '';}
	
	//custom format
	$sel_area_code = '';
	$sel_phone = ''; 
	parse_phone($register['PHONE'], $sel_area_code, $sel_phone);
	
	$sel_fax_area_code = '';
	$sel_fax = ''; 
	$sel_fax_ext = ''; 
	parse_phone_ext($register['FAX'], $sel_fax_area_code, $sel_fax, $sel_fax_ext);

?>
	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />		
	<style type="text/css">
		.hidden_content {
			display: none;
		}
	</style>
									<div class="row">

									    <?php 
										$attributes = array('name' => 'registerform','id'=>'registerform','role'=>'form');
										echo form_open_multipart($action,$attributes);
										?>
											<div class="main-box-body clearfix">
											
												<div class="row">
												
													<div class="col-lg-12">
														<div class="main-box">
															<header class="main-box-header clearfix">
																<h2>Informasi Umum</h2>
															</header>
															
															<div class="main-box-body clearfix">
																<?php
																if($register['NAMA_CABANG']!="")
																{
																?>
																<div class="row">
																	<div class="form-group col-md-4">
																		Cabang Pendaftaran : <font size="4"><b><?=$register['NAMA_CABANG']?></b></font>
																	</div>
																</div>
																<?php
																}
																?>
																<div class="row">
																	<div class="form-group col-md-4">
																		<label for="deed_establishment">Tanggal Berita Acara Serah Terima Dokumen</label>
																		<div class="input-group">
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="acceptance_doc_date" name="acceptance_doc_date" readonly value="<?php echo $register['ACCEPTANCE_DOC_DATE'];?>" <?=$disabled?>/>
																		</div>
																		<label for="deed_establishment">Dokumen Berita Acara Serah Terima</label>
																		<input type="file" name="acceptance_doc" class="form-control" id="acceptance_doc" data-toggle="tooltip" data-placement="bottom" title="" size="100" <?=$disabled?>>
																		<?php 
																			if($register['ACCEPTANCE_DOC']!="")
																			{
																		?>
																			<a href="<?php echo $file_link?>" target="_blank"><?=$register['ACCEPTANCE_DOC']?></a>
																		<?
																			}
																			
																		?>
																	</div>
																</div>
																
																<div class="form-group">
																	<label>Jenis Perusahaan</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_company_type, 'company_type', '', $register['COMPANY_TYPE'],$disabled);
																		echo options_group_loader('radio', $x);
																	?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>
																
																<div class="form-group ">
																	<label>Jenis Pendaftaran</label>
																	<div class="row">
																		<div class="col-lg-12">
																		<?php 
																			$x = options_params($box_register_type, 'register_type[]', '', $sel_register_type,$disabled);
																			//print_r($x); die();
																			echo options_group_loader('checkbox', $x);
																		?>	
																		</div>
																	</div>
																</div>
																
																<div class="form-group">
																	<label>Jenis Pelanggan</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_customer_type, 'customer_type', '', $sel_customer_type,$disabled);
																		echo options_group_loader('radio', $x);
																	?>					
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>	
																
																<div class="form-group">
																	<label for="name">Nama Perusahaan</label>
																	<input type="text" class="form-control withTooltip" id="name" name="name" data-toggle="tooltip" data-placement="bottom" title="Diisi sesuai akta pendirian tanpa menyertakan 'PT', 'CV', dsb" value="<?=$register['NAME'];?>" <?=$is_readonly?>/>
																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
																</div>	
																<div class="form-group hidden_content">	
																	<label for="name">Cabang Belum Didaftarkan</label>
																	<input type="text" class="form-control" id="registrationcompanyid" name="registrationcompanyid" value="<?=$registrationcompanyid?>" <?=$is_readonly?>/>
																</div>
																<div class="form-group">
																	<label for="name">Nama Perusahaan untuk Faktur Pajak</label>
																	<input type="text" class="form-control withTooltip" id="alt_name" name="alt_name" data-toggle="tooltip" data-placement="bottom" title="Nama perusahaan yang ingin dicantumkan pada faktur pajak" value="<?=$register['ALT_NAME'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="form-group">
																	<label>Kewarganegaraan</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_citizenship, 'citizenship', '', $register['CITIZENSHIP'],$disabled);
																		echo options_group_loader('radio', $x);
																	?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>

																
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="npwp">NPWP</label>
																		<div class="input-group">
																			<label style="display:none">NPWP</label>
																			<span class="input-group-addon"><i class="fa fa-money"></i></span>
																			<input type="text" class="form-control" id="npwp" name="npwp" value="<?=$register['NPWP'];?>" <?=$is_readonly?>/>
																		</div>
																		<span class="help-block">ex. 99.999.999.9-999.999</span>
																	</div>															
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="npwp">ID Tax</label>
																		<div class="input-group">
																			<label style="display:none">Passport</label>
																			<span class="input-group-addon"><i class="fa fa-money"></i></span>
																			<input type="text" class="form-control" id="passport" name="passport" value="<?=$register['PASSPORT'];?>" <?=$is_readonly?>/>
																		</div>
																		<span class="help-block">ex. 999999999999999</span>
																	</div>															
																</div>																
																		
																<div class="row">
																	<div class="form-group example-twitter-oss col-md-6 ">
																		<label for="simop_customer_name" >Nama di ICT SIMOP</label>
																		<input type="text" class="form-control withTooltip" id="simop_customer_name" name="simop_customer_name" data-provide="typeahead" data-toggle="tooltip" data-placement="bottom" title="Mencocokkan dengan basis data ICT" value="<?php echo $simop_name;?>" <?php if($simop_name!="") echo "readonly";?>/>
																		<input type='hidden' id='simop_customer_id' name='simop_customer_id' value="<?php echo $register['CUSTOMER_ID']?>" />
																		<input type='hidden' id='simop_customer_id_nosync' name='simop_customer_id_nosync' value="<?php echo $register['CUSTOMER_ID']?>" />
																	</div>
																	<div class="form-group col-md-6  <?php echo $reg_type_hidden_content;?>">
																		<label for="new_customer" >Status Pendaftaran Customer</label>
																		<div class="row">
																		<?php 
																			$x = options_params($box_reg_type, 'reg_type', '', $register['REG_TYPE'],$disabled);
																			echo options_group_loader('radio', $x);
																		?>
																		</div>
																		<span class="help-block">Pilih salah satu</span>
																	</div>
																</div>	
																		
																<div class="row">
																	<div class="form-group col-md-4">
																		<label for="deed_establishment">Akte Pendirian Perusahaan</label>
																		<div class="input-group">
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="deed_establishment" name="deed_establishment" readonly value="<?php echo $register['DEED_ESTABLISHMENT'];?>"/>
																		</div>
																	</div>
																</div>
																
																<div class="form-group">
																	<label>Kelompok Pelanggan</label>
																	<? 	
																		echo form_dropdown('customer_group', $opt_customer_group, $register['CUSTOMER_GROUP'] ,"class='form-control' ".$is_readonly); 				
																	?>
																</div>
																
																<div class="form-group ">
																	<label>Jenis Layanan</label>
																	<div class="row">
																		<div class="col-lg-12">
																		<?php 
																			$x = options_params($box_service_type, 'service_type[]', '', $sel_service_type,$disabled);
																			echo options_group_loader('checkbox', $x);
																		?>	
																		</div>
																	</div>
																</div>
																
																<div class="form-group ">
																	<label>Apakah Perusahaan anda merupakan anak perusahaan (memiliki induk)?</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_yesno, 'is_subsidiary', '', $register['IS_SUBSIDIARY'],$disabled);
																		echo options_group_loader('radio', $x);
																	?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>
																
																<div class="form-group example-twitter-oss">
																	<label for="holding" >Induk Usaha/Holding Company</label>
																	<input type="text" class="form-control withTooltip" id="holding_name" name="holding_name" data-provide="typeahead" data-toggle="tooltip" data-placement="bottom" title="Induk usaha harus sudah terdaftar terlebih dahulu" value="<?php echo $register['HOLDING_NAME'];?>" <?=$is_readonly?>/>
																</div>
																<div class="form-group example-twitter-oss hidden_content">
																	<label for="holding" >Induk Usaha/Holding Company Harus Terdaftar di CDM</label>
																	<input type='text' id='holding_company_id' name='holding_company_id' value="<?php echo $register['PARENT_ID'];?>"/>
																</div>
																
																<div class="form-group ">
																	<label>Jumlah Karyawan</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_employee_count, 'employee_count', '', $register['EMPLOYEE_COUNT'],$disabled);
																		echo options_group_loader('radio', $x);
																	?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="partnership_date">Menjadi partner IPC sejak</label>
																		<div class="input-group">
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																		<!--	<input type="text" class="form-control calendar" id="partnership_date" name="partnership_date" value="<?php //echo $register['PARTNERSHIP_DATE'];?>">	-->																			
																			<?	
																				echo form_dropdown('partnership_date', $opt_years, $sel_partnership_date ,"class='sel2' id='partnership_date' style=\"width:300px\" $disabled");
																			?>
																		
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																</div>																
																
																<div class="form-group ">
																	<label>Apakah Anda mendaftar mewakili kantor pusat atau kantor cabang?</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_entity_type, 'entity_type', '', $sel_entity_type, $disabled);
																		echo options_group_loader('radio', $x);
																	?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>
																
																<div class="form-group example-twitter-oss ">
																	<label for="holding" >Kantor Pusat</label>
																	<input type="text" class="form-control withTooltip" id="main_branch_name" name="main_branch_name" data-provide="typeahead" data-toggle="tooltip" data-placement="bottom" title="Kantor pusat harus sudah terdaftar terlebih dahulu" value="<?php echo $register['HEADQUARTERS_NAME'];?>" <?=$is_readonly?>/>
																</div>																
																
																<div class="form-group example-twitter-oss hidden_content">
																	<label for="holding" >Kantor Pusat harus Terdaftar di CDM</label>
																	<input type='text' id='main_branch_id' name='main_branch_id' value="<?php echo $register['HEADQUARTERS_ID'];?>"/>
																</div>	
																
																<div class="form-group">
																	<label for="address">Alamat Perusahaan</label>
																	<textarea class="form-control" id="address" name="address" rows="3" <?=$is_readonly?>><?=$register['ADDRESS'];?></textarea>
																	<span class="help-block">Alamat diisi sesuai yang tertera di npwp </span>
																</div>
																
																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Provinsi</label>
																		<?	
																			echo form_dropdown('address_prov', $opt_province, $register['PROVINCE'] ," class='sel2' id='address_prov' style=\"width:300px\" $disabled"); 				
																		?>
																	</div>
																</div>
																
																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kota / Kabupaten</label>
																		<select style="width:300px" id="address_city" name="address_city" <?=$disabled?>>
																		</select>
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kode Pos</label>
																		<select style="width:300px" id="postal_code" name="postal_code" <?=$disabled?>>
																		</select>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kecamatan</label>
																			<select style="width:300px" id="address_kecamatan" name="address_kecamatan" <?=$disabled?>>
																			</select>
																		</div>
																	</div>
																	
																	<div class="col-lg-4">
																		<div class="form-group form-group-select2">
																			<label>Kelurahan / Desa</label>
																			<select style="width:300px" id="address_kelurahan" name="address_kelurahan" <?=$disabled?>>
																			</select>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="phone">Telepon Perusahaan</label>
																		<div class="input-group">
																			<label style="display:none">Telepon Perusahaan</label>
																			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																			<input type="text" class="form-control fields area-code" style="width:4.5em;" id="phone_area_code" name="phone_area_code" value="<?php echo $sel_area_code;?>" <?=$is_readonly?>/>
																			<input type="text" class="form-control fields phone" style="width:auto;" id="phone" name="phone"  value="<?=$sel_phone;?>" <?=$is_readonly?>/>
																			<div class="clearfix">&nbsp;</div>																		
																		</div>
																		<span class="help-block">ex. 021 1234567</span>
																	</div>

																	<div class="form-group col-md-6">
																		<label for="fax">Faksimili Perusahaan</label>
																		<div class="input-group">
																			<label style="display:none">Faksimili Perusahaan</label>
																			<span class="input-group-addon"><i class="fa fa-fax"></i></span>
																			<input type="text" class="form-control fields area-code" style="width:4.5em;" id="fax_area_code" name="fax_area_code" value="<?php echo $sel_fax_area_code;?>" <?=$is_readonly?>/>
																			<input type="text" class="form-control fields phone" style="width:auto;" id="fax" name="fax"  value="<?=$sel_fax;?>" <?=$is_readonly?>/>
																			<input type="text" class="form-control fields ext" style="width:4.5em;" id="fax_ext" name="fax_ext" value="<?php echo $sel_fax_ext;?>" <?=$is_readonly?>/>
																			<div class="clearfix">&nbsp;</div>
																		</div>
																		<span class="help-block">ex. 021.1234567-89</span>
																	</div>
																</div>
																
																<div class="form-group col-md-6">
																	<label for="website">Website</label>
																	<input type="text" class="form-control" id="website" name="website" placeholder="www.yoursite.com" data-toggle="tooltip" data-placement="bottom" title="tooltip..." value="<?=$register['WEBSITE'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="form-group col-md-6">
																	<label for="email">Alamat Surel</label>
																	<input type="email" class="form-control" id="email" name="email" placeholder="yourname@example.com" value="<?=$register['EMAIL'];?>" <?=$is_readonly?>/>
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
										</form>
									</div>										
					
	<!-- this page specific inline scripts -->
	<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>	
	<script src="<?=CUBE_;?>js/ipc/validation.js"></script>	
	<!--script src="<?//=CUBE_;?>js/typeahead.bundle.min.js"></script-->
	<script src="<?=CUBE_?>js/hogan.js"></script>
	<script src="<?=CUBE_?>js/typeahead.min.js"></script>
	<script>
	
	$(function($) {
		//validation
		$("#submitButton").click(function(){
			
			var check = true;
			
			var filename = $('#acceptance_doc').val();
			if(filename!="")
			{
				var ext = filename.split('.').pop().toLowerCase();
				if($.inArray(ext, ['pdf','jpg','jpeg']) == -1) {
					alert('Dokumen Berita Acara Serah Terima harus : PDF/JPG/JPEG');
					var check = false;
					$('#acceptance_doc').focus();
				}
			}
			
			if(check)
			{
				var names = ['name', 'alt_name', 'address', 'email', 'address', 'deed_establishment', 'customer_group','registrationcompanyid'];
				
				var radios = ['company_type','customer_type'];
			
				if ( $('input[name=citizenship]:checked').val()=='WNI' ){
					names.push('npwp');
				}
				else 
				{
					names.push('passport');
				}
				
				if($('input[name=entity_type]:checked').val()=="BRNCH")
				{
					names.push('main_branch_id');
				}
				
				if($('#fax').val()!='')
				{
					names.push('fax_area_code');
				}
				if($('#fax_area_code').val()!='')
				{
					names.push('fax');
				}	
				
				if($('#phone').val()!='')
				{
					names.push('phone_area_code');
				}
				if($('#phone_area_code').val()!='')
				{
					names.push('phone');
				}			
				
				if ( $('input[name=reg_type]:checked').val()=='OLD' ){
					names.push('simop_customer_name');
					names.push('simop_customer_id');
				}
				
				if ($('[name=is_subsidiary]:checked').val()=='Y'){
					names.push('holding_company_id');
				}
				
				if($('[name=reg_type]:checked').val()=='OLD' && $('#simop_customer_id').val()=="")
				{
					alert('Please choose : Nama di ICT SIMOP');
					check= false;
				}

				//validasi npwp
				var npwp = $('#npwp').val();
				var passport = $('#passport').val();
				var customer_id = "<?=$register['CUSTOMER_ID']?>";
				var registration_company_id = "<?=$this->session->userdata('registrationcompanyid_phd');?>";
				
				if ( $('input[name=citizenship]:checked').val()=='WNI' ){
					var url="<?=ROOT?>register/validate_npwp";
					$.ajax({
					  type: 'POST',
					  url: url,
					  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',npwp:npwp,customer_id:customer_id,registration_company_id:registration_company_id},
					  success: function(data) {
									if(data=="KO")
									{
										alert("NPWP Number Already Used by Another Customer.");
										$('#npwp').focus();
										check= false;
									}
									else if(data=="BLACKLIST")
									{
										alert("NPWP Number Is Blacklisted.");
										$('#npwp').focus();
										check= false;
									}
						},
						async:false
					});
				}
				else 
				{
					var url="<?=ROOT?>register/validate_passport";
					$.ajax({
					  type: 'POST',
					  url: url,
					  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',passport:passport,customer_id:customer_id,registration_company_id:registration_company_id},
					  success: function(data) {
									if(data=="KO")
									{
										alert("Passport Already Used by Another Customer.");
										$('#Passport').focus();
										check= false;
									}
									else if(data=="BLACKLIST")
									{
										alert("Passport Number Is Blacklisted.");
										$('#Passport').focus();
										check= false;
									}
						},
						async:false
					});
				}
				
				if(check)
				{
					if (	
							validateRadios('#registerform', radios) &&
							validateForm('#registerform', names)
						){
						$("#registerform").submit();
					}
				}
			}
		});
		
		
		$("input[name='register_type[]']").click( function () {
			var remember = document.getElementById('checkbox-register_type[]-MTR');
			var remember1 = document.getElementById('checkbox-register_type[]-CUS');
			var cek = 0;
			if(remember.checked){
				cek = 1;
			}
			if(remember1.checked){
				cek = 2;
			}
			
			if(cek == 1){
				document.getElementById("radio-customer_type-SHIPA").disabled = true;
				document.getElementById("radio-customer_type-EMKL").disabled = true;
				document.getElementById("radio-customer_type-CONSG").disabled = true;
				document.getElementById("radio-customer_type-STVCO").disabled = true;
				document.getElementById("radio-customer_type-SHIPA").checked = false;
				document.getElementById("radio-customer_type-EMKL").checked = false;
				document.getElementById("radio-customer_type-CONSG").checked = false;
				document.getElementById("radio-customer_type-STVCO").checked = false;
			}else{
				document.getElementById("radio-customer_type-SHIPA").disabled = false;
				document.getElementById("radio-customer_type-EMKL").disabled = false;
				document.getElementById("radio-customer_type-CONSG").disabled = false;
				document.getElementById("radio-customer_type-STVCO").disabled = false;
			}
		});
		
		$("input[name='customer_type']").click( function () {
			var remember = document.getElementById('radio-customer_type-RUPA');
			var cek = 0;
			if(remember.checked){
				cek = 1;
			}
			//alert(cek);
			if(cek == 1){
				document.getElementById("checkbox-service_type[]-VESSE").disabled = true;
				document.getElementById("checkbox-service_type[]-CONGC").disabled = true;
				document.getElementById("checkbox-service_type[]-VESSE").checked = false;
				document.getElementById("checkbox-service_type[]-CONGC").checked = false;
				document.getElementById("checkbox-service_type[]-MISC").checked = true;
			}else{
				document.getElementById("checkbox-service_type[]-MISC").checked = false;
				document.getElementById("checkbox-service_type[]-VESSE").disabled = false;
				document.getElementById("checkbox-service_type[]-CONGC").disabled = false;
			}
		});
		
		
		$('#name').focusout(function(){
			var str = $('#name').val();
			if (	
					str.match(/^[.,]?(PT|CV|UD)[.,]?[\s]/) || 
					str.match(/^[.,]?(PT|CV|UD)[.,][\s]?/) || 
					str.match(/[\s][.,]?(PT|CV|UD)[.,]?$/) || 
					str.match(/[\s]?[.,](PT|CV|UD)[.,]?$/) || 
					str.match(/[\s][.,]?(PT|CV|UD)[.,]?[\s]/)
				)
			{
				alert ('Name cannot contain PT or CV or UD');
				$('#name').val('');
			}
		});
		
		$('#email').change(function(){
			
			if (!validateEmails('#registerform',['email'])){
				$('#email').val('');
			}
		});
		
		$("#checkbox-register_type").change(function(){
			
		});

		$('#website').change(function(){
			
			if (!validateWebsites('#registerform',['website'])){
				$('#website').val('');
			}
		});
		//-------------------
		
		//tooltip init
		$('.withTooltip').tooltip();
	
		//masked inputs
		$(".phone").mask("9999?9999");
		$(".area-code").mask("999?9");
		$(".ext").mask("?9999");
		
		$("#npwp").mask("99.999.999.9-999.999");
		//$("#passport").mask("99999?99999999999999");
		$("#ktp").mask("9999999999999999");
		$('.calendar').mask("99-99-9999");
		
		//nice select boxes
		$('.sel2').select2();
		
		//datepicker
		$('.calendar').datepicker({
		  format	: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true,
		  endDate	: '0d'
		});

		var myParams = {	
			root	: '<?=ROOT;?>',
		
			city 	: '<?php echo $register['CITY'];?>',
			camat 	: '<?php echo $register['KECAMATAN'];?>',
			lurah 	: '<?php echo $register['KELURAHAN'];?>',
			pos 	: '<?php echo $register['POSTAL_CODE'];?>',
			
			prov_id 	: 'address_prov',
			city_id 	: 'address_city',
			camat_id 	: 'address_kecamatan',
			lurah_id 	: 'address_kelurahan',
			pos_id 		: 'postal_code',

			city_name 	: 'address_city',
			camat_name 	: 'address_kecamatan',
			lurah_name 	: 'address_kelurahan',
			pos_name 	: 'postal_code'
		}
		
		//HEAVY TRAFFIC
		initAddress(myParams);
		
		//HOLDING
		checkHolding();
		$('input[name=is_subsidiary]').change(function(){
			checkHolding();
		})
		
		checkCustomerType();
		$('input[name=citizenship]').change(function(){
			checkCustomerType();
		})
		
		$('input[name=company_type]').change(function(){
			checkCustomerType();
		})
		
		$('input[name=customer_type]').change(function(){
			checkCustomerType();
		})		
		
		//MAIN BRANCH
		checkMainBranch();
		$('input[name=entity_type]').change(function(){
			checkMainBranch();
		});
				
		//SIMOP CUSTOMER
		checkSimopName();
		$('input[name=reg_type]').change(function(){
			checkSimopName();
		});
		
		/*checkCursor('phone');
		checkCursor('area-code');
		checkCursor('ext');
		checkCursor('npwp');
		checkCursor('ktp');
		//checkCursor('calendar');
//		alert('end');*/
	})	
	
	function checkCursor(tagName){
		var inp = document.getElementsByTagName(tagName)[1];
        if (inp.createTextRange) {
            var part = inp.createTextRange();
            part.move("character", 0);
            part.select();
        }else if (inp.setSelectionRange){
            inp.setSelectionRange(0, 0);
		}
        inp.focus();
	}
	
	var testsource = 
[
{"company_id":"17400806","company_name":"PT.BAHARI SANDI PRATAMA","address":"JL.BELAWAN NO.42\/5 TELUK BAYUR","city":"PADANG","npwp":"02.118.172.2-211.000","value":"PT.BAHARI SANDI PRATAMA"},
{"company_id":"15401002","company_name":"BAHARI SANDI PRATAMA PT","address":"JL.RE MARTADINATA NO.11  ","city":"PALEMBANG","npwp":"02.118.172.2-301.001","value":"BAHARI SANDI PRATAMA PT"},
{"company_id":"12402128","company_name":"BAHARI SANDI PRATAMA PT","address":"LINK GEREM RAYA NO RT 001 RW 004 GEREM GROGOL CILEGON BANTEN","city":"CILEGON","npwp":"02.118.172.2-417.001","value":"BAHARI SANDI PRATAMA PT"},
{"company_id":"10400807","company_name":"PT. BAHARI SANDI PRATAMA","address":"JL.JEND.SUDIRMAN NO.21 THEHOK JAMBI, PH.26423\r\n","city":null,"npwp":"02.118.172.2-211.000","value":"PT. BAHARI SANDI PRATAMA"}
];

	var testsource2 = [{"company_id":"17400806","company_name":"PT.BAHARI SANDI PRATAMA","address":"JL.BELAWAN NO.42\/5 TELUK BAYUR","city":"PADANG","npwp":"02.118.172.2-211.000","value":"PT.BAHARI SANDI PRATAMA"},{"company_id":"15401002","company_name":"BAHARI SANDI PRATAMA PT","address":"JL.RE MARTADINATA NO.11  ","city":"PALEMBANG","npwp":"02.118.172.2-301.001","value":"BAHARI SANDI PRATAMA PT"},{"company_id":"12402128","company_name":"BAHARI SANDI PRATAMA PT","address":"LINK GEREM RAYA NO RT 001 RW 004 GEREM GROGOL CILEGON BANTEN","city":"CILEGON","npwp":"02.118.172.2-417.001","value":"BAHARI SANDI PRATAMA PT"},{"company_id":"10400807","company_name":"PT. BAHARI SANDI PRATAMA","address":"JL.JEND.SUDIRMAN NO.21 THEHOK JAMBI, PH.26423\r\n","city":null,"npwp":"02.118.172.2-211.000","value":"PT. BAHARI SANDI PRATAMA"}];
	
	function initSimopName(){
		$('#simop_customer_name').typeahead({
			name: 'simop_customer',
			remote: '<?=ROOT;?>register/test/%QUERY', 	// you can change anything but %QUERY
			//local: testsource,
			//local: testsource2,
			displayKey:'company_id',
			minLength: 3, 											// send AJAX request only after user type in at least 3 characters
			limit: 10, 												// limit to show only 10 results
			template: [                                                              
				'<p class="repo-language">{{npwp}}</p>',                              
				'<p class="repo-name">{{company_name}} ({{company_id}})</p>',                                      
				'<p class="repo-description">{{address}}</p>',                         
				'<p class="repo-description">{{city}}</p>'                       
			].join(''),                                                                 
			engine: Hogan
		}).on("typeahead:selected",
				function(e,datum){ 
					$('#simop_customer_id').val(	datum.company_id	);
				} );		
	}

	
	function checkSimopName(){
		
		if ( $('input[name=reg_type]:checked').val()=='OLD' ){
			$('#simop_customer_name').removeAttr('disabled');
			initSimopName();
		}
		else{
			$('#simop_customer_name').typeahead('destroy');
			$('#simop_customer_name').val('');
			$('#simop_customer_id').val('');
			$('#simop_customer_name').attr('disabled','disabled');
		}
	}
	
	function initHolding(){
		$('#holding_name').typeahead({
			name: 'holding',
			remote: '<?=ROOT;?>register/searchcompanies/%QUERY', 	// you can change anything but %QUERY
			displayKey:'npwp',
			minLength: 3, 											// send AJAX request only after user type in at least 3 characters
			limit: 10, 												// limit to show only 10 results
			template: [                                                              
				'<p class="repo-language">{{npwp}}</p>',                              
				'<p class="repo-name">{{name}}</p>',                                      
				'<p class="repo-description">{{address}}</p>'                         
			].join(''),                                                                 
			engine: Hogan
		}).on("typeahead:selected",
				function(e,datum){ 
					//console.log('data....');
					//console.log(datum);
					$('#holding_company_id').val(	datum.customer_id	);
				} );		
	}
	
	function checkHolding(){
		
		if ( $('input[name=is_subsidiary]:checked').val()=='Y' ){
			$('#holding_name').removeAttr('disabled');
			initHolding();
		}
		else{
			$('#holding_name').typeahead('destroy');
			$('#holding_name').val('');
			$('#holding_company_id').val('');
			$('#holding_name').attr('disabled','disabled');
		}
	}

	function checkCustomerType(){
		if ( $('input[name=company_type]:checked').val()=='SEMPL' && $('input[name=customer_type]:checked').val()=='CONSG' && $('input[name=citizenship]:checked').val()=='WNA'){
			$('#npwp').attr('disabled','disabled');
			$('#npwp').val("");
			$('#passport').removeAttr('disabled');
		}
		else if($('input[name=citizenship]:checked').val()=='WNI')
		{
			$('#passport').attr('disabled','disabled');
			$('#passport').val("");
			$('#npwp').removeAttr('disabled');			
		}
		else
		{
			$('#npwp').attr('disabled','disabled');
			$('#npwp').val("");
			$('#passport').attr('disabled','disabled');
			$('#passport').val("");			
		}
	}	

	
	function initMainBranch(){
		$('#main_branch_name').typeahead({
			name: 'main_branch',
			remote: '<?=ROOT;?>register/searchcompanies/%QUERY', 	// you can change anything but %QUERY
			displayKey:'npwp',
			minLength: 3, 											// send AJAX request only after user type in at least 3 characters
			limit: 10, 												// limit to show only 10 results
			template: [                                                              
				'<p class="repo-language">{{npwp}}</p>',                              
				'<p class="repo-name">{{name}}</p>',                                      
				'<p class="repo-description">{{address}}</p>'                         
			].join(''),                                                                 
			engine: Hogan
		}).on("typeahead:selected",
				function(e,datum){ 
					//console.log('data....');
					//console.log(datum);
					$('#main_branch_id').val(	datum.customer_id	);
				} );
	}

	function checkMainBranch(){
		
		if ( $('input[name=entity_type]:checked').val()!='MAIN' ){
			$('#main_branch_name').removeAttr('disabled');
			initMainBranch();
		}
		else{
			$('#main_branch_name').typeahead('destroy');
			$('#main_branch_name').val('');
			$('#main_branch_id').val('');
			$('#main_branch_name').attr('disabled','disabled');
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
	
	//		alert('last');
	
	//change to upper case
	$("#name").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#name").val(($("#name").val()).toUpperCase());
	});

	$("#alt_name").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#alt_name").val(($("#alt_name").val()).toUpperCase());
	});
	
	$("#address").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#address").val(($("#address").val()).toUpperCase());
	});
	
	</script>
	<script>
		$(document).ready(function() {
			//sql injection protection
			$(":input").keyup(function(event) {
				$(this).val($(this).val().replace(/[\*=;:'"?%~`$^{}<>|\[\]]/gi, ''));
			});
			
			$("#holding_name").keyup(function() {
				$("#holding_company_id").val("");
			});
			
			$("#main_branch_name").keyup(function() {
				$("#main_branch_id").val("");
			});				
			
		});
	</script>