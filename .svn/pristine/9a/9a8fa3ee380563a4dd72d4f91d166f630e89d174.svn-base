<?
	//echo $skapal_user_status; //die;
	//print_r($opt_postalcode); die;
	if (!isset($pbm)){
		$pbm = array(
						'SHIPPING_AGENT_ID'		=> '',
						'THREE_PARTIED_CODE'	=> '',
						'SIUPBM'				=> '',
						'SIUPBM_PUBLISH_DATE'	=> '',
						'APBMI'					=> '',
						'PBM_ID'				=> '',
						'CUSTOMER_ID'			=> ''
					);	
	}
	
	if(!isset($sel_three_partied)){$sel_three_partied = $pbm['THREE_PARTIED_CODE'];}

	if(!isset($customer_id)){$customer_id = $pbm['CUSTOMER_ID'];}
	if(!isset($pbm_id)){$pbm_id = $pbm['PBM_ID'];}
	if(!isset($skapal_user_data_record)){$skapal_user_data_record = 0;}
	
	if(!isset($isEditing)){$isEditing = false;}
	
	if(!isset($skapal_user_status)){$skapal_user_status = '';}
	if(!isset($skapal_user_data)){$skapal_user_data = array('USER_ID'=>'','REAL_NAME'=>'','INFO_SMS_NUMBER'=>'','INFO_EMAIL_ADDRESS'=>'');}
	
//	print_r($skapal_user_data);die;
	
	//var_dump($pbm);
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
										$attributes = array('name' => 'pbmform','id'=>'pbmform','role'=>'form');
										echo form_open($action,$attributes);
										?>
											<div class="main-box-body clearfix">
											
												<div class="row">
												
													<div class="col-lg-12">
														<div class="main-box">
															<header class="main-box-header clearfix">
																<h2>PBM</h2>
															</header>
															
															<div class="main-box-body clearfix">
																
																<input type="hidden" name="customer_id" value="<?=$customer_id;?>" />
																<input type="hidden" name="pbm_id" value="<?=$pbm_id;?>" />
																<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
																
																<div class="form-group">
																	<label for="npwp">KODE PBM</label>
																	<input type="text" class="form-control" id="external_id" name="external_id" value="<?php echo $pbm['EXTERNAL_ID']?>" readonly/>
																</div>
																
																<div class="form-group">
																	<label>Cabang</label>
																	<? 	
																		if($pbm['BRANCH_ID']!="")
																			$enable_branch_edit = "readonly";
																		else 
																			$enable_branch_edit = "";
																		
																		echo form_dropdown('branch', $opt_branch, $pbm['BRANCH_ID'] ,"class='form-control' $enable_branch_edit ". $is_readonly);
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
																	<label for="siapdel">Surat Izin Usaha Perusahaan Bongkar Muat (SIUPBM)</label>
																	<input type="text" class="form-control withTooltip" id="siupbm" name="siupbm" data-toggle="tooltip" data-placement="bottom" title="Diisi sesuai akta pendirian tanpa menyertakan 'PT', 'CV', dsb" value="<?=$pbm['SIUPBM'];?>" <?=$is_readonly?>/>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<label for="siupbm_publish_date">Tanggal Terbit Surat Izin Usaha Perusahaan Bongkar Muat (SIUPBM)</label>
																		<div class="input-group">
																			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			<input type="text" class="form-control calendar" id="siupbm_publish_date" name="siupbm_publish_date" value="<?php echo $pbm['SIUPBM_PUBLISH_DATE'];?>" readonly <?=$disabled?>>
																		</div>
																		<span class="help-block">format dd-mm-yyyy</span>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="apbmi">Asosiasi Perusahaan Bongkar Muat Indonesia(APBMI)</label>
																	<input type="text" class="form-control withTooltip" id="apbmi" name="apbmi" value="<?=$pbm['APBMI'];?>" <?=$is_readonly?>/>
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

								<!-- 	<div id="register_login_div" class="row hidden_content">
										<div class="col-lg-12">
											<div class="main-box">
												<header class="main-box-header clearfix">
													<h2>Register Login</h2>
												</header>
												
												<div class="main-box-body clearfix">
													<form class="form-inline" role="form" id="userForm">
														<div class="form-group">
															<label class="sr-only" for="username_view">Username</label>
															<input type="input" class="form-control" id="username_view" disabled value="<?=$skapal_user_data['USER_ID'];?>">
														</div>
														<div class="form-group">
															<label class="sr-only" for="phone_view">SMS to</label>
															<input type="text" class="form-control" id="phone_view" disabled value="<?=$skapal_user_data['INFO_SMS_NUMBER'];?>">
														</div>
														<div class="form-group">
															<label class="sr-only" for="email_view">Email to</label>
															<input type="text" class="form-control" id="email_view" disabled value="<?=$skapal_user_data['INFO_EMAIL_ADDRESS'];?>">
														</div>
														<div class="form-group">
															<!--button type="submit" class="btn btn-success">Sign in</button-->
															<!-- <?
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
									<div id="modalplaceholder"></div> -->
									
					
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
			var names = ['siupbm'];
			names.push('siupbm_publish_date');
			
			var check= true;
			
			//validasi siupbm
			var siupbm = $('#siupbm').val();
			var customer_id = "<?=$customer_id?>";
			var registration_company_id = "<?=$this->session->userdata('registrationcompanyid_phd');?>";
			
			var url="<?=ROOT?>register/validate_siupbm";
			$.ajax({
			  type: 'POST',
			  url: url,
			  data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',siupbm:siupbm,customer_id:customer_id,registration_company_id:registration_company_id},
			  success: function(data) {
							if(data=="KO")
							{
								alert("SIUPBM Number Already Used by Another Customer.");
								$('#siupbm').focus();
								check= false;
							}
							else if(data=="BLACKLIST")
							{
								alert("SIUPBM Number Is Blacklisted.");
								$('#siupbm').focus();
								check= false;
							}							
				},
				async:false
			});		

			//validasi apbmi
			var apbmi = $('#apbmi').val();
			var customer_id = "<?=$customer_id?>";
			var registration_company_id = "<?=$this->session->userdata('registrationcompanyid_phd');?>";
			
			var url="<?=ROOT?>register/validate_apbmi";
			$.ajax({
			  type: 'POST',
			  url: url,
			  data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',apbmi:apbmi,customer_id:customer_id,registration_company_id:registration_company_id},
			  success: function(data) {
							if(data!="OK")
							{
								alert("APBMI Number Already Used by Another Customer.");
								$('#apbmi').focus();
								check= false;
							}
				},
				async:false
			});
			
			if(check)
			{
				if (validateForm('#pbmform', names)){
					$("#pbmform").submit();
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
		$('#siupbm_publish_date').datepicker({
		  format: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true,
		  endDate	: '0d'
		});

		$('#exmp_expire_date, #exmp2_expire_date').datepicker({
		  format: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true,
		  startDate	: '0d'
		});
		
		$('#showModalButton').click(function(){
			
			if (skapal_user_status == 'F' || skapal_user_status == 'S' || skapal_user_status == 'N' || (skapal_user_status == 'O' && skapal_user_data_record != '0')){
				var path = '';
				
				if (skapal_user_status == 'F' || skapal_user_status == 'S' || (skapal_user_status == 'O' && skapal_user_data_record != '0') ){
					path = "<?=ROOT;?>register/loadmodal_edit/modal-simkapal_user/user_simkapal/<?=$pbm_id;?>";
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
					$('#user_simkapal  [name=shipping_agent_id]').val('<?php echo $pbm_id;?>');
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
		
		var table2 = $('#table_kd_pbm').dataTable({
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
		$.get("<?=ROOT;?>register/echo_user_simkapal_sync_status/<?=$pbm_id;?>",function(data){
			console.log(data);
			skapal_user_status = data;
		})
		.then(function(){
			if (skapal_user_status == 'F' || skapal_user_status == 'S'){
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
	if($pbm_id!=""){
		
		echo "$('#register_login_div').removeClass('hidden_content');";
	}
	?>
	</script>