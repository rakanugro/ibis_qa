<?
	//print_r($opt_postalcode); die;
	if (!isset($billing)){

		//$sites = array(array("SITE_ID"=>"1582"));

		$billing = array(
						'BILLING_ID'			=> '',
						'CUSTOMER_ID'			=> '',
						'ADDRESS_BILLING'		=> strtoupper ($register['ADDRESS']),
						'PROVINCE_BILLING'		=> '',
						'CITY_BILLING'			=> '',
						'KECAMATAN_BILLING'		=> '',
						'KELURAHAN_BILLING'		=> '',
						'POSTAL_CODE_BILLING'	=> '',
						'PHONE_BILLING'			=> '',
						'EMAIL_BILLING'			=> '',
						'HQ_ID'					=> '',
						'BRANCH_ID'				=> $default_branch_id,
						'BILLING_CUSTOMER_ID'	=> '',
						'IS_MAIN_BRANCH'		=> 'Y',
						'REG_TYPE_BILLING'		=> 'OLD'
//						'PHONE'					=> ''
					);
		$isEditing = false;
	}
	else{
		$isEditing = true;
	}

	//informasi billing
	$sel_province_billing 		= $billing['PROVINCE_BILLING'];
	$sel_city_billing 			= $billing['CITY_BILLING'];
	$sel_kecamatan_billing 		= $billing['KECAMATAN_BILLING'];
	$sel_kelurahan_billing 		= $billing['KELURAHAN_BILLING'];
	$sel_postal_code_billing 	= $billing['POSTAL_CODE_BILLING'];
	$sel_branch_billing 		= $billing['BRANCH_ID'];
	$sel_sites					= $sites;

	$reg_type					= $billing['REG_TYPE_BILLING'];

	$sel_cfs_type = array(
		($billing['CFS']=='Y'?'CFS':'')
	);
	
	//var_dump( $sites); //die;

	$sel_sites = array();

	foreach($sites as $site){
		$sel_sites[] = $site['SITE_ID'];
	}

	//var_dump($sel_sites);

	//preset var handling
	if(!isset($is_main_branch)){$is_main_branch = $billing['IS_MAIN_BRANCH'];}


	if(!isset($hq_id)){
		if (isset($billing['HQ_ID'])){
			$hq_id = $billing['HQ_ID'];
		}
		else{
			$hq_id = '';
		}
	}

	//custom format
	$sel_area_code = '';
	$sel_phone = '';
	parse_phone($billing['PHONE_BILLING'], $sel_area_code, $sel_phone);

	//echo $sel_area_code;echo "-";
	//echo $sel_phone;

	if(!isset($customer_id)){$customer_id = $billing['CUSTOMER_ID'];}
	if(!isset($billing_id)){$billing_id = $billing['BILLING_ID'];}
	if(!isset($billing_customer_id)){$billing_customer_id = $billing['BILLING_CUSTOMER_ID'];}
	if(!isset($simop_name)){$simop_name = '';}

	//var_dump($billing); die;
?>
	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
	<?php
	//hide some content
	if($this->session->userdata('registrationcompanyid_phd')==JAI_ORG){
		echo "	<style type=\"text/css\">
				.jai_hidden_content {
					display: none;
				}
		</style>";
	}
	else
	{

	}
	?>

									<div class="row">

										<?php
										$attributes = array('name' => 'billingform','id'=>'billingform','role'=>'form');
										echo form_open($action,$attributes);
										?>

											<div class="main-box-body clearfix">

												<div class="row">

													<div class="col-lg-12">
														<div class="main-box">

															<header class="main-box-header clearfix">
																<h2>Informasi Billing/Pembayaran</h2>
															</header>

															<div class="main-box-body clearfix">

																<input type="hidden" name="hq_id" value="<?php echo $hq_id;?>"></input>
																<input type="hidden" name="customer_id" value="<?php echo $customer_id;?>"></input>
																<input type="hidden" name="billing_customer_id" value="<?php echo $billing_customer_id;?>"></input>
																<input type="hidden" name="billing_id" value="<?php echo $billing_id;?>"></input>


																<div class="form-group">
																	<label>Merupakan Billing Account kantor pusat?</label>
																	<div class="row">
																	<?php
																		$x = options_params($box_yesno, 'is_main_branch', '', $is_main_branch,$disabled);
																		echo options_group_loader('radio', $x);
																	?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>																

																<div class="row">
																	<div class="form-group example-twitter-oss col-md-6 jai_hidden_content">
																		<label for="simop_customer_name" >Nama di ICT SIMOP</label>
																		<input type="text" class="form-control withTooltip" id="simop_customer_name" name="simop_customer_name" data-provide="typeahead" data-toggle="tooltip" data-placement="bottom" title="Mencocokkan dengan basis data ICT" value="<?php echo $simop_name;?>" <?=$is_readonly?>/>
																		<input type='hidden' id='billing_customer_id' name='billing_customer_id' value="<?php echo $billing_customer_id;?>" />
																		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
																	</div>

																	<div class="form-group col-md-6 jai_hidden_content">
																		<label for="new_customer" >Status Pendaftaran Billing Account</label>
																		<div class="row">
																		<?php
																			$x = options_params($box_reg_type, 'reg_type_billing', '', $reg_type,$disabled);
																			echo options_group_loader('radio', $x);
																		?>
																		</div>
																		<span class="help-block">Pilih salah satu</span>
																	</div>
																</div>
												
																
																

																<div class="form-group ">
																	<!--<label>CFS</label>-->
																	<div class="row">
																		<div class="col-lg-12">
																		<?php 
																			$x = options_params($box_cfs_type, 'cfs_type[]', '', $sel_cfs_type,$disabled);
																			echo options_group_loader('checkbox', $x);
																		?>	
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="form-group">
																			<label>Perusahaan yang berhubungan</label>
																			<?
																				echo form_dropdown('branch_billing', $opt_branch, $sel_branch_billing ,"class='sel2' id='branch_billing' style=\"width:300px\" $disabled");
																			?>
																		</div>
																	</div>
																	<div class="col-lg-8">
																		<div class="form_group">
																			<label>Site yang berhubungan</label>
																			<div class="row" id="site_placeholder">
																				<?php
																					$xx = &get_instance();
																					$xx->load_site($sel_branch_billing, $sel_sites, $disabled );
																				?>
																				<!--div class="checkbox-nice checkbox-inline">
																					<input type="checkbox" name="eee" id="r1"></input>
																					<label for="r1">wow</label>
																				</div>
																				<div class="checkbox-nice checkbox-inline">
																					<input type="checkbox" name="eee" id="r2"></input>
																					<label for="r2">wew</label>
																				</div-->
																			</div>
																			<span class="help-block">Pilih satu site atau lebih</span>
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label for="address">Alamat Penagihan</label>
																	<textarea class="form-control" id="address_billing" name="address_billing" rows="3" <?=$is_readonly?>><?php echo $billing['ADDRESS_BILLING'];?></textarea>
																	<span class="help-block">input alamat tanpa informasi provinsi, kota/kabupaten, kecamatan, kelurahan/desa, dan kode pos </span>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Provinsi</label>
																		<?
																			echo form_dropdown('address_prov_billing', $opt_province, $sel_province_billing ,"class='sel2' id='address_prov_billing' style=\"width:300px\" $disabled");
																		?>
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kota / Kabupaten</label>
																		<select style="width:300px" id="address_city_billing" name="address_city_billing" <?=$is_readonly?> <?=$disabled?>>
																		</select>
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kode Pos</label>
																		<select style="width:300px" id="postal_code_billing" name="postal_code_billing" <?=$is_readonly?> <?=$disabled?>>
																		</select>
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kecamatan</label>
																		<select style="width:300px" id="address_kecamatan_billing" name="address_kecamatan_billing" <?=$is_readonly?> <?=$disabled?>>
																		</select>
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group form-group-select2">
																		<label>Kelurahan / Desa</label>
																		<select style="width:300px" id="address_kelurahan_billing" name="address_kelurahan_billing" <?=$is_readonly?> <?=$disabled?>>
																		</select>
																	</div>
																</div>

																<div class="form-group col-md-6">
																	<label for="phone">Telepon</label>
																	<div class="input-group">
																		<label style="display:none">Telepon</label>
																		<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																		<input type="text" class="form-control fields area-code" style="width:4.5em;" id="phone_area_code_billing" name="phone_area_code_billing" value="<?php echo $sel_area_code;?>" <?=$is_readonly?>/>
																		<input type="text" class="form-control fields phone" style="width:auto;" id="phone_billing" name="phone_billing"  value="<?=$sel_phone;?>" <?=$is_readonly?>/>
																		<div class="clearfix">&nbsp;</div>
																	</div>
																	<span class="help-block">ex. 021 1234567</span>
																</div>

																<div class="form-group col-md-6">
																	<label for="email">Alamat Surel Penagihan</label>
																	<input type="email" class="form-control" id="email_billing" name="email_billing" placeholder="yourname@example.com" value="<?php echo $billing['EMAIL_BILLING'];?>" <?=$is_readonly?>/>
																</div>

																<div class="main-box clearfix"></div>
																<div class="row">
																	<div class="form-group col-md-6">
																		<button type="button" id="submitButton" class="btn btn-success"><?=$submit?></button>
																	</div>

															<?php if ($isEditing){?>
																	<!--
																	<div class="form-group col-md-6">
																		<button type="button" id="ambutton" class="btn btn-danger pull-right">Lihat Account Manager</button>
																	</div>
																	-->
															<?php } ?>
																</div>
															</div>

														</div>
													</div>
												</div>
											</div>
										</form>

								<?php if ($isEditing){?>
										<!-- BANK LIST -->
										<div id="bank_placeholder"></div>
										<!-- ACCOUNT MANAGER LIST -->
										<div id="am_placeholder"></div>

										<div id="modalplaceholder"></div>
								<?php } ?>

									</div>

	<!-- this page specific inline scripts -->
	<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
	<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
	<script src="<?=CUBE_?>js/hogan.js"></script>
	<script src="<?=CUBE_?>js/typeahead.min.js"></script>
	<script>

	$(function($) {

		$("#npwp").mask("99.999.999.9-999.999");

		$("#submitButton").click(function(){

			var names = ['address_billing', 'email_billing'];

			var radios = ['is_main_branch', 'reg_type_billing'];

			if ( $('[name=reg_type_billing]:checked').val() == 'OLD' ){
				names.push('simop_customer_name');
				names.push('simop_customer_id');
			}

			<?php
			if($this->session->userdata('registrationcompanyid_phd')!=JAI_ORG){
				echo "names.push('address_prov_billing');";
				echo "names.push('address_city_billing');";
				echo "names.push('postal_code_billing');";
				echo "names.push('address_kecamatan_billing');";
				echo "names.push('address_kelurahan_billing');";
			}
			?>

			if($('#phone_billing').val()!='')
			{
				names.push('phone_area_code_billing');
			}

			if($('#phone_area_code_billing').val()!='')
			{
				names.push('phone_billing');
			}

			if (
					validateRadios('#billingform', radios) &&
					validateForm('#billingform', names)
				){
				$("#billingform").submit();
			}

		});

		$('#email_billing').change(function(){

			if (!validateEmails('#billingform',['email_billing'])){
				$('#email_billing').val('');
			}
		});

		$("#ambutton").click(function(){
			window.location = '<?=ROOT;?>register/am_list/<?=$billing['BILLING_ID'];?>';
		});

		//tooltip init
		$('.withTooltip').tooltip();

	
		
		//masked inputs
		$(".phone").mask("9999?9999");
		$(".area-code").mask("999?9");
		//nice select boxes
		$('.sel2').select2();

		$('#branch_billing').change(function(){
			load_site($('#branch_billing').val());
		});

		//load_site($('#branch_billing')).val();
		//load_site($('#branch_billing').val(), [1822,1826]);

		var myParams = {
			root	: '<?=ROOT;?>',

			city 	: '<?php echo $billing['CITY_BILLING'];?>',
			camat 	: '<?php echo $billing['KECAMATAN_BILLING'];?>',
			lurah 	: '<?php echo $billing['KELURAHAN_BILLING'];?>',
			pos 	: '<?php echo $billing['POSTAL_CODE_BILLING'];?>',

			prov_id 	: 'address_prov_billing',
			city_id 	: 'address_city_billing',
			camat_id 	: 'address_kecamatan_billing',
			lurah_id 	: 'address_kelurahan_billing',
			pos_id 		: 'postal_code_billing',

			city_name 	: 'address_city_billing',
			camat_name 	: 'address_kecamatan_billing',
			lurah_name 	: 'address_kelurahan_billing',
			pos_name 	: 'postal_code_billing'
		}

		//HEAVY TRAFFIC
		initAddress(myParams);


		//SIMOP CUSTOMER
		checkSimopName();
		$('input[name=reg_type_billing]').change(function(){
			checkSimopName();
		});

		//BANK
		load_banklist();

		<?php
		if($this->session->userdata('registrationcompanyid_phd')!=JAI_ORG){
		 echo "load_amlist();";
		}?>

	})

	function initSimopName(){
		$('#simop_customer_name').typeahead({
			name: 'simop_customer',
			remote: '<?=ROOT;?>register/test/%QUERY', 	// you can change anything but %QUERY
			displayKey:'npwp',
			minLength: 3, 											// send AJAX request only after user type in at least 3 characters
			limit: 10, 												// limit to show only 10 results
			template: [
				'<p class="repo-language">{{npwp}}</p>',
				'<p class="repo-name">{{company_name}} ({{company_id}})</p>',
				'<p class="repo-description">{{address}}</p>'
			].join(''),
			engine: Hogan
		}).on("typeahead:selected",
				function(e,datum){
					$('#billing_customer_id').val(	datum.company_id	);
				} );
	}


	function checkSimopName(){

		if ( $('input[name=reg_type_billing]:checked').val()=='OLD' ){
			$('#simop_customer_name').removeAttr('disabled');
			initSimopName();
		}
		else{
			$('#simop_customer_name').typeahead('destroy');
			$('#simop_customer_name').val('');
			$('#billing_customer_id').val('');
			$('#simop_customer_name').attr('disabled','disabled');
		}
	}

	function load_site(branch, sites){
		console.log(sites);

		if(sites != null && sites.length > 0){
			//alert('assigning');
			//alert(sites.length);
		}
		else{
			//alert('null');
			sites = null;
		}

		$.get("<?=ROOT;?>register/load_site/"+branch,
				{sites:sites},
				function(data){
					$('#site_placeholder').html(data);
					//alert(data);
					console.log(data);
				});
	};

	<!--------------------------------------------BANK--------------------------------------------->
	<!--------------------------------------------------------------------------------------------->
	function load_banklist(){
		$.get("<?=ROOT;?>register/bank_list/<?php echo $billing['BILLING_ID'];?>/<?php echo $customer_id;?>", function(data){
			$('#bank_placeholder').html(data);
		});
	}

	function showModal_bank(){

		$('#modalplaceholder').html('');
		$.get("<?=ROOT;?>register/loadmodal_local/bank_account", function(data){
			$('#modalplaceholder').html(data).children().modal('show');
		})
		.then(function(){
			//hack... can't assign through $data in controller
			//$('#bankform  [name=isEditing]').val('N');
			$('#bankform  [name=billing_id]').val('<?php echo $billing['BILLING_ID'];?>');
		});
	}

	function edit_bank(bank_account_id){

		$.get("<?=ROOT;?>register/loadmodal_local_edit/bank_account/bank/"+bank_account_id, function(data){
			$('#modalplaceholder').html(data).children().modal('show');
		})
		.then(function(){
			//hack... can't assign through $data in controller
			//$('#bankform  [name=isEditing]').val('Y');
		});
	}

	//for popup

	function save_bank(){
		var tmp = {};

		//protip: don't select all 'input's blindly, 'radio' types need the :checked selector
		//or else they submits everything
		$('#bankform select, #bankform input[type=text],  #bankform input[type=hidden], #bankform input[type=radio]:checked, #bankform input[type=checkbox]:checked ')
			.each(function(){
				tmp[this.name] = this.value;
			});

		console.log(tmp);

		$.post('<?php echo ROOT;?>register/submit_bank',tmp)
		.then(function(){
			load_banklist();
			$('#modalplaceholder').children().modal('hide');
		});
	}

	function update_bank(){
		var tmp = {};

		//protip: don't select all 'input's blindly, 'radio' types need the :checked selector
		//or else they submits everything
		$('#bankform select, #bankform input[type=text],  #bankform input[type=hidden], #bankform input[type=radio]:checked, #bankform input[type=checkbox]:checked ')
			.each(function(){
				tmp[this.name] = this.value;
			});

		console.log(tmp);

		$.post('<?php echo ROOT;?>register/update_bank',tmp)
		.then(function(){
			load_banklist();
			$('#modalplaceholder').children().modal('hide');
		});
	}

	function delete_bank(bank_account_id){
		var txt = 'Anda yakin akan menghapus akun bank ini?';

		if (confirm(txt)){

			$.get('<?=ROOT;?>register/delete_bank/'+bank_account_id)
			.then(function(){
				load_banklist();
				$('#modalplaceholder').children().modal('hide');
			});
		}

	}

	//for popup
	function validate_bank(){
		console.log('validate');

		if ( $('#bank_account').val() != '' && $('input[name=currency]:checked').length > 0 ){
			$('#bankSaveButton').removeAttr('disabled');
		}
		else{
			$('#bankSaveButton').attr('disabled','disabled');
		}
	}

	<!------------------------------------ACCOUNT MANAGER------------------------------------------>
	<!--------------------------------------------------------------------------------------------->

	function load_amlist(){
		$.get("<?=ROOT;?>register/am_list/<?php echo $billing['BILLING_ID'];?>/list", function(data){
			$('#am_placeholder').html(data);
		});
	}

	// jquery extend function
	// http://stackoverflow.com/questions/8389646/send-post-data-on-redirect-with-javascript-jquery/23347763#23347763
	function redirectPost(location, args){
		var form = '';
		$.each( args, function( key, value ) {
			//value = value.split('"').join('\"')
			form += '<input type="hidden" name="'+key+'" value="'+value+'">';
		});
		$('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
	}

	function edit_am(am_id){
		//alert(am_id);
		var url = "<?php echo ROOT;?>register/am_edit/"+am_id;
		redirectPost(url, {test:'12345a','<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'});
	}

	function delete_am(am_id){
		var txt = 'Anda yakin akan menghapus am ini?';

		if (confirm(txt)){

			$.get('<?=ROOT;?>register/delete_am/'+am_id)
			.then(function(){
				load_amlist();
			});
		}
	}
	<!--------------------------------------------------------------------------------------------->

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

	$("#address_billing").bind('keyup', function (e) {
		if (e.which >= 97 && e.which <= 122) {
			var newKey = e.which - 32;
			// I have tried setting those
			e.keyCode = newKey;
			e.charCode = newKey;
		}

		$("#address_billing").val(($("#address_billing").val()).toUpperCase());
	});
	</script>
