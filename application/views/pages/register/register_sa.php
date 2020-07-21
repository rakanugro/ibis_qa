<?
	//echo $skapal_user_status; //die;
	//print_r($opt_postalcode); die;
	//print_r($mandatory); die;
	if (!isset($sa)){
		$sa = array(
						'SHIPPING_AGENT_ID'		=> '',
						'THREE_PARTIED_CODE'	=> '',
						'SIAPDEL'				=> '',
						'SIAPDEL_EXPIRE_DATE'	=> '',
						'INSA_MEMBER_NO'		=> '',
						'SKPT'					=> '',
						'SIUPAL'				=> '',
						'SIUPAL_PUBLISH_DATE'	=> '',
						'SIUPAL_EXPIRE_DATE'	=> '',
						'SIOPSUS'				=> '',
						'SIOPSUS_PUBLISH_DATE'	=> '',
						'SIOPSUS_EXPIRE_DATE'	=> '',
						'SKTD'					=> '',
						'SKTD_PUBLISH_DATE'		=> '',
						'SKTD_CREATED_DATE'		=> '',
						'SKTD_START'			=> '',
						'SKTD_END'				=> '',
						//'SKPT_PUBLISH_DATE'		=> '',
						//'SKPT_EXPIRE_DATE'		=> '',
						'ROUTE_TRAMPER'			=> '',
						'ROUTE_LINER'			=> '',
						'CUSTOMER_ID'			=> '',
						'NPWP'					=> '',
						'ADDRESS'				=> $register['ADDRESS'],
						'BRANCH_ID'				=> '',
						'EXTERNAL_ID'			=> ''
					);	
	}
	

	if(!isset($cek_mandatory)){$cek_mandatory = $mandatory['BILLING_CUSTOMER_ID'];}
	//print_r($cek_mandatory); die;
	if(!isset($sel_three_partied)){$sel_three_partied = $sa['THREE_PARTIED_CODE'];}

	if(!isset($customer_id)){$customer_id = $sa['CUSTOMER_ID'];}
	if(!isset($shipping_agent_id)){$shipping_agent_id = $sa['SHIPPING_AGENT_ID'];}
	if(!isset($skapal_user_data_record)){$skapal_user_data_record = 0;}
	
	if(!isset($isEditing)){$isEditing = false;}
	
	if(!isset($skapal_user_status)){$skapal_user_status = '';}
	if(!isset($skapal_user_data)){$skapal_user_data = array('USER_ID'=>'','REAL_NAME'=>'','INFO_SMS_NUMBER'=>'','INFO_EMAIL_ADDRESS'=>'');}
	
//	print_r($skapal_user_data);die;

	$sel_route_type = array(
		($sa['ROUTE_LINER']=='Y'?'LINER':''),
		($sa['ROUTE_TRAMPER']=='Y'?'TRAMP':'')
	);
	
	//var_dump($sa);
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
										$attributes = array('name' => 'saform','id'=>'saform','role'=>'form');
										echo form_open($action,$attributes);
										?>
											<div class="main-box-body clearfix">
											
												<div class="row">
												
													<div class="col-lg-12">
														<div class="main-box">
															<header class="main-box-header clearfix">
																<h2>Shipping Agent</h2>
															</header>
															
															<div class="main-box-body clearfix">
																
																<input type="hidden" name="customer_id" value="<?=$customer_id;?>" />
																<input type="hidden" name="shipping_agent_id" value="<?=$shipping_agent_id;?>" />
																<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
																
																<div class="form-group">
																	<label for="npwp">KODE AGEN</label>
																	<input type="text" class="form-control" id="external_id" name="external_id" value="<?php echo $sa['EXTERNAL_ID']?>" readonly/>
																</div>
																
																<div class="form-group">
																	<label>Cabang</label>
																	<? 	
																		if($sa['BRANCH_ID']!="")
																			$enable_branch_edit = "readonly";
																		else 
																			$enable_branch_edit = "";
																		
																		echo form_dropdown('branch', $opt_branch, $sa['BRANCH_ID'] ,"class='form-control' $enable_branch_edit ". $is_readonly);
																	?>
																</div>
																
																<div class="form-group">
																	<label>Three Partied Code</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_three_partied, 'three_partied_code', '', $sel_three_partied,$disabled);
																		echo options_group_loader('radio', $x);
																	?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>
																
																<div class="form-group">
																	<label for="siapdel">SI ADPEL</label>
																	<input type="text" class="form-control withTooltip" id="siapdel" name="siapdel" data-toggle="tooltip" data-placement="bottom" title="Diisi sesuai akta pendirian tanpa menyertakan 'PT', 'CV', dsb" value="<?=$sa['SIAPDEL'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="siapdel_expire_date">Masa Berlaku ADPEL</label>
																		<div class="input-group">
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="siapdel_expire_date" name="siapdel_expire_date" value="<?php echo $sa['SIAPDEL_EXPIRE_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="insa_member_no">Nomor Anggota INSA</label>
																	<input type="text" class="form-control withTooltip" id="insa_member_no" name="insa_member_no" value="<?=$sa['INSA_MEMBER_NO'];?>" <?=$is_readonly?>/>
																</div>
																
																<!--<div class="form-group">
																	<label for="skpt">SKPT</label>
																	<input type="text" class="form-control withTooltip" id="skpt" name="skpt" value="<?=$sa['SKPT'];?>" <?=$is_readonly?>/>
																</div>-->
																
																<div class="form-group">
																	<label for="siupal">SIUPAL</label>
																	<input type="text" class="form-control withTooltip" id="siupal" name="siupal" value="<?=$sa['SIUPAL'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="siupal_publish_date">Tanggal Terbit SIUPAL</label>
																		<div class="input-group">
																			<label style="display:none">Tanggal Terbit SIUPAL</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="siupal_publish_date" name="siupal_publish_date" value="<?php echo $sa['SIUPAL_PUBLISH_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																	
																	<div class="form-group col-md-6">
																		<label for="siupal_expire_date">Masa Berlaku SIUPAL</label>
																		<div class="input-group">
																			<label style="display:none">Masa Berlaku SIUPAL</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="siupal_expire_date" name="siupal_expire_date" value="<?php echo $sa['SIUPAL_EXPIRE_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="siopsus">No Siopsus</label>
																	<input type="text" class="form-control withTooltip" id="siopsus" name="siopsus" value="<?=$sa['SIOPSUS'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="siopsus_publish_date">Tanggal Terbit Siopsus</label>
																		<div class="input-group">
																			<label style="display:none">Tanggal Terbit Siopsus</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="siopsus_publish_date" name="siopsus_publish_date" value="<?php echo $sa['SIOPSUS_PUBLISH_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																	
																	<div class="form-group col-md-6">
																		<label for="siopsus_expire_date">Masa Berlaku Siopsus</label>
																		<div class="input-group">
																			<label style="display:none">Masa Berlaku Siopsus</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="siopsus_expire_date" name="siopsus_expire_date" value="<?php echo $sa['SIOPSUS_EXPIRE_DATE']?>" readonly <?=$disabled?>>															
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																</div>

																<div class="form-group">
																	<label for="siupkk">SIUPKK</label>
																	<input type="text" class="form-control withTooltip" id="siupkk" name="siupkk" value="<?=$sa['SIUPKK'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="siupkk_publish_date">Tanggal Terbit SIUPKK</label>
																		<div class="input-group">
																			<label style="display:none">Tanggal Terbit SIUPKK</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="siupkk_publish_date" name="siupkk_publish_date" value="<?php echo $sa['SIUPKK_PUBLISH_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																	
																	<div class="form-group col-md-6">
																		<label for="siupkk_expire_date">Masa Berlaku SIUPKK</label>
																		<div class="input-group">
																			<label style="display:none">Masa Berlaku SIUPKK</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="siupkk_expire_date" name="siupkk_expire_date" value="<?php echo $sa['SIUPKK_EXPIRE_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																</div>

																<div class="form-group">
																	<label for="sktd">SKTD</label>
																	<input type="text" class="form-control withTooltip" id="sktd" name="sktd" value="<?=$sa['SKTD'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="form-group col-md-6">
																		<label for="sktd_publish_date">Tanggal Diberikan SKTD</label>
																		<div class="input-group">
																			<label style="display:none">Tanggal Diberikan SKTD</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="sktd_publish_date" name="sktd_publish_date" value="<?php echo $sa['SKTD_PUBLISH_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																</div>
																
																<div class="form-group col-md-12">
																	<div class="form-group col-md-6">
																		<label for="sktd_start">Tanggal Awal SKTD</label>
																		<div class="input-group">
																			<label style="display:none">Tanggal Awal SKTD</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="sktd_start" name="sktd_start" value="<?php echo $sa['SKTD_START'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																	
																	<div class="form-group col-md-6">
																		<label for="sktd_end">Tanggan Akhir SKTD</label>
																		<div class="input-group">
																			<label style="display:none">Tanggal Akhir SKTD</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="sktd_end" name="sktd_end" value="<?php echo $sa['SKTD_END'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																</div>

																<!--<div class="form-group">
																	<label for="skpt">SKPT</label>
																	<input type="text" class="form-control withTooltip" id="skpt" name="skpt" value="<?=$sa['SKPT'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="skpt_publish_date">Tanggal Terbit SKPT</label>
																		<div class="input-group">
																			<label style="display:none">Tanggal Terbit SKPT</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="skpt_publish_date" name="skpt_publish_date" value="<?php echo $sa['SKPT_PUBLISH_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																	
																	<div class="form-group col-md-6">
																		<label for="skpt_expire_date">Masa Berlaku SKPT</label>
																		<div class="input-group">
																			<label style="display:none">Masa Berlaku SKPT</label>
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="skpt_expire_date" name="skpt_expire_date" value="<?php echo $sa['SKPT_EXPIRE_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																</div>-->
																
																<div class="form-group col-md-6">
																	<label>Jenis Trayek</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_route_type, 'route_type[]', '', $sel_route_type,$disabled);
																		echo options_group_loader('checkbox', $x);
																	?>
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
										</form>
									</div>	

									<div id="register_login_div" class="hidden_content row">
										<div class="col-lg-12">
											<div class="main-box">
												<header class="main-box-header clearfix">
													<h2>Register Login</h2>
												</header>
												
												<div class="main-box-body clearfix">
													<form class="form-inline" role="form" id="userForm">
														<div class="form-group">
															<label class="sr-only" for="username_view">Username</label>
															<input type="input" class="form-control" id="username_view" disabled value="<?=$skapal_user_data['USER_ID'];?>" mandatory="yes">
														</div>
														<div class="form-group">
															<label class="sr-only" for="phone_view">SMS to</label>
															<input type="text" class="form-control" id="phone_view" disabled value="<?=$skapal_user_data['INFO_SMS_NUMBER'];?>" mandatory="yes">
														</div>
														<div class="form-group">
															<label class="sr-only" for="email_view">Email to</label>
															<input type="text" class="form-control" id="email_view" disabled value="<?=$skapal_user_data['INFO_EMAIL_ADDRESS'];?>" mandatory="yes">
														</div>
														<div class="form-group">
															<!--button type="submit" class="btn btn-success">Sign in</button-->
															<?
																if (($skapal_user_status == 'O' && $skapal_user_data_record!=0) || $skapal_user_status == 'S' || $skapal_user_status == 'F'){
																	$btn = "Ubah Detail Kontak";
																}
																else{
																	$btn = "Daftar";
																}
															?>
															<a data-toggle="modal" id="showModalButton" href="#myModal" class="btn btn-primary"><?=$btn;?></a>
														</div>
														<div class="form-group">
															<a href="#userForm" class="btn btn-warning" id="userSyncButton" disabled>Sync User Data</a>
														</div>
													</form>
												</div>
											</div>
										</div>	
									</div>
						

									<div>		<!-- BANK LIST -->
										<div id="bank_placeholder"></div>
										<!-- ACCOUNT MANAGER LIST -->
										<div id="am_placeholder"></div>

										<div id="modalplaceholder"></div>

									
							
						</div>

									
					
	<!-- this page specific inline scripts -->
	<script src="<?=CUBE_;?>js/ipc/validation.js"></script>

	<script>




	//var submitbuttonclicked = false;
	var isloginformloaded = false;
	var skapal_user_status = '<?=$skapal_user_status;?>';
	var skapal_user_data_record = '<?=$skapal_user_data_record?>';
		
	$(function($) {
		checkIfSyncReady();
		
		$("#npwp").mask("99.999.999.9-999.999");
		
		$("#submitButton").click(function(){
			var names = ['siapdel'];
			if ( $('#siupal').val()!='' || ($('#siupal').val()=='' && $('#siopsus').val()=='' && $('#siupkk').val()=='')){
				names.push('siupal');
				names.push('siupal_publish_date');
			}
			else if ($('#siupkk').val()!='' || ($('#siupkk').val()=='' && $('#siopsus').val()=='')){
				names.push('siupkk');
				names.push('siupkk_publish_date');
			}
			else
			{
				names.push('siopsus');
				names.push('siopsus_publish_date');				
			}
			
			
			//validasi cabang 
			var branch = $('[name=branch]').val();
			var customer_id = "<?=$customer_id?>";
			var shipping_agent_id = "<?=$shipping_agent_id?>";
			var cek_mandatory = "<?=$cek_mandatory?>";
			
			var check= true;

			//validasi siapdel
			var siapdel = $('#siapdel').val();
			var customer_id = "<?=$customer_id?>";
			var registration_company_id = "<?=$this->session->userdata('registrationcompanyid_phd');?>";
			
			var url="<?=ROOT?>register/validate_siapdel";
			$.ajax({
			  type: 'POST',
			  url: url,
			  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',siapdel:siapdel,customer_id:customer_id,registration_company_id:registration_company_id},
			  success: function(data) {
							if(data!="OK")
							{
								alert("SIAPDEL Number Already Used by Another Customer.");
								$('#siapdel').focus();
								check= false;
							}
				},
				async:false
			});	
			
			//validasi insa_member_no
			var insa_member_no = $('#insa_member_no').val();
			var customer_id = "<?=$customer_id?>";
			var registration_company_id = "<?=$this->session->userdata('registrationcompanyid_phd');?>";
			
			var url="<?=ROOT?>register/validate_insa_member_no";
			$.ajax({
			  type: 'POST',
			  url: url,
			  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',insa_member_no:insa_member_no,customer_id:customer_id,registration_company_id:registration_company_id},
			  success: function(data) {
							if(data!="OK")
							{
								alert("Nomor Anggota Insa Number Already Used by Another Customer.");
								$('#insa_member_no').focus();
								check= false;
							}
				},
				async:false
			});			
			
			//validasi siupal
			var siupal = $('#siupal').val();
			var customer_id = "<?=$customer_id?>";
			var registration_company_id = "<?=$this->session->userdata('registrationcompanyid_phd');?>";
			
			var url="<?=ROOT?>register/validate_siupal";
			$.ajax({
			  type: 'POST',
			  url: url,
			  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',siupal:siupal,customer_id:customer_id,registration_company_id:registration_company_id},
			  success: function(data) {
							if(data!="OK")
							{
								alert("SIUPAL Number Already Used by Another Customer.");
								$('#siupal').focus();
								check= false;
							}
				},
				async:false
			});
			
			//validasi siopsus
			var siopsus = $('#siopsus').val();
			var customer_id = "<?=$customer_id?>";
			var registration_company_id = "<?=$this->session->userdata('registrationcompanyid_phd');?>";
			
			var url="<?=ROOT?>register/validate_siopsus";
			$.ajax({
			  type: 'POST',
			  url: url,
			  data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',siopsus:siopsus,customer_id:customer_id,registration_company_id:registration_company_id},
			  success: function(data) {
							if(data!="OK")
							{
								alert("SIOPSUS Number Already Used by Another Customer.");
								$('#siopsus').focus();
								check= false;
							}
				},
				async:false
			});
			
			if(cek_mandatory == null || cek_mandatory == ''){
				if(shipping_agent_id!="")
				{
					if($('#username_view').val() == ""){
						alert('Please input Register Login User !');
						check= false;
					}
				}
			}
			
			
			if(check)
			{
				if (validateForm('#saform', names)){
					$("#saform").submit();
				}
			}
		});
		
		//tooltip init
		$('.withTooltip').tooltip();
	
		//masked inputs
		$('.calendar').mask("99-99-9999");
		
		//nice select boxes
		$('.sel2').select2();
		
		//datepicker
		$('#siupal_publish_date, #siopsus_publish_date, #siupkk_publish_date, #sktd_publish_date, #sktd_created_date, #sktd_start, #skpt_publish_date').datepicker({
		  format: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true,
		  endDate	: '0d'
		});

		$('#siupal_expire_date, #siupal_expire_date, #siupkk_expire_date, #siapdel_expire_date, #siopsus_expire_date, #sktd_end, #skpt_expire_date').datepicker({
		  format: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true,
		  startDate	: '0d'
		});
		
		$('#showModalButton').click(function(){
			
			if (skapal_user_status == 'F' || skapal_user_status == 'S' || skapal_user_status == 'N' || (skapal_user_status == 'O' && skapal_user_data_record != '0')){
				var path = '';
				
				if (skapal_user_status == 'F' || skapal_user_status == 'S' || (skapal_user_status == 'O' && skapal_user_data_record != '0') ){
					path = "<?=ROOT;?>register/loadmodal_edit/modal-simkapal_user/user_simkapal/<?=$shipping_agent_id;?>";
				}
				else if (skapal_user_status == 'N' || (skapal_user_status == 'O' && skapal_user_data_record == '0')){
					path = "<?=ROOT;?>register/loadmodal/modal-simkapal_user";
				}
					
				$('#modalplaceholder').html('');
				$.get(path, function(data){
					$('#modalplaceholder').html(data).children().modal('show');
				})
				.then(function(){
					//hack... can't assign through $data in controller
					$('#user_simkapal  [name=customer_id]').val('<?php echo $customer_id;?>');
					$('#user_simkapal  [name=shipping_agent_id]').val('<?php echo $shipping_agent_id;?>');
					$('#user_simkapal  [name=external_id]').val('<?php echo $sa['EXTERNAL_ID'];?>');
					$('#user_simkapal  [name=branch_id]').val('<?php echo $sa['BRANCH_ID'];?>');
				});
			}
			/*else if (skapal_user_status == 'O'){
				alert('User already generated by SIM KAPAL');
			}*/
			else if (skapal_user_status == 'X'){
				alert('Customer data not yet Synced with SIM KAPAL');
			}
			else{
				alert('UNDEFINED STATUS : '+skapal_user_status);
			}
			// else automatic from template
		});
		
		
		
		$("#userSyncButton").click(function(){
			$.blockUI();
			//alert('<?php echo $customer_id;?>');
			
			global_t_status = 'F';
			$.get("<?=ROOT;?>register/syncUserSKapal/<?php echo $customer_id;?>", function(data){
				console.log(data);
				$.unblockUI();
				
				try{
					feed = JSON.parse(data);
					console.log(feed);
					
					rc			= feed.rc;
					rcmsg		= feed.rcmsg;
					
					global_t_status = rc;
					console.log('status '+ rc);
					console.log('msg '+ rcmsg);
					
					if(global_t_status != 'S'){
						alert('User sync to SIM Kapal failed : '+rcmsg);
						console.log(rcmsg);
					}
				}
				catch(err){
					console.log(err);
				}
			})
			.then(function(){
				if (global_t_status == 'S'){
					var user = $('#username_view').val();
					var path = "<?=ROOT;?>register/send_success_notification/"+user;
					$.get(path, function(data){
						alert('OK!');
						console.log(data);
					});
				}
			});
		});
		
		var table2 = $('#table_kd_agen').dataTable({
			'info': true,
			'sDom': 'lTfr<"clearfix">tip',
			"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
		});		
	})
	
	//called from dialog
	function saveSimkapalUser(params, action){
		//$.get("<?=ROOT;?>register/sync_user_simkapal/
		var path = '';
		if (action == 'S'){
			path = "<?=ROOT;?>register/skapal_user_submit/";
		}	
		else{
			path = "<?=ROOT;?>register/skapal_user_update/";
		}	
		
		$.post(path, params)
		.then(function(){
			$('#modalplaceholder').children().modal('hide');
			console.log(params);
			$('#username_view').val(params.user_id);
			$('#phone_view').val(params.info_sms_number);
			$('#email_view').val(params.info_email_address);
			checkIfSyncReady();
		});
	}
	
	function checkIfSyncReady(){
		var t_sync = '';
		$.get("<?=ROOT;?>register/echo_user_simkapal_sync_status/<?=$shipping_agent_id;?>",function(data){
			console.log(data);
			skapal_user_status = data;
		})
		.then(function(){
			if (skapal_user_status == 'F' || skapal_user_status == 'S' || skapal_user_status == 'O'){
				$('#userSyncButton').removeAttr('disabled');
			} 
			else{
				$('#userSyncButton').attr('disabled','disabled');
			}			
		});
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
	
	<?php
	if($shipping_agent_id!=""){
		
		echo "$('#register_login_div').removeClass('hidden_content');";

	}
	?>
	
	</script>