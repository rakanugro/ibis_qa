<?php
	//initiate
	if(!isset($detail)){
		$detail = array(
			'BANK_ACCOUNT_ID' 	=> '',
			'BILLING_ID' 		=> '',
			'ACCOUNT_NO'		=> '',
			'BANK_ID'			=> '',
			'CURRENCY'			=> '',
			'AUTOCOLLECTION'	=> '',
			'AUTOCOLLECTION_BARANG'	=> '',
			'AUTOCOLLECTION_BM_BARANG'	=> '',
			'CMS'	=> '',
			'SALDO_MIN_CMS'	=> '',
			'BRANCH_ID'	=> '',
			'TOKEN_ID'			=> ''
		);
		
		$isEditing = 'N';
	}
	else{
		$isEditing = 'Y';
	}
	
	if(!isset($action)){$action = '';}
	//if(!isset($isEditing)){$isEditing = 'N';}
	
	if(!isset($billing_id)){$billing_id = $detail['BILLING_ID'];}
	if(!isset($bank_account_id)){$bank_account_id = $detail['BANK_ACCOUNT_ID'];}
	
	// load data from db
	if(!isset($opt_bank)){$opt_bank = rsArrToOptArr(	load_options('BANK','ID')->result('array')	);}
	if(!isset($box_currency)){$box_currency = load_options('CURRENCY','ID')->result('array');}	
	if(!isset($box_autocollection)){$box_autocollection = load_options('AUTOCOLLECTION','ID')->result('array');}	
	if(!isset($box_autocollection_barang)){$box_autocollection_barang = load_options('AUTOCOLLECTION_BARAN','ID')->result('array');}	
	if(!isset($box_autocollection_bm_barang)){$box_autocollection_bm_barang = load_options('AUTOCOLLECTION_BMBRG','ID')->result('array');}	
	if(!isset($box_cms)){$box_cms = load_options('CMS','ID')->result('array');}

	//var_dump($detail);die;
	
	//informasi bank
	$sel_bank = $detail['BANK_ID'];
	$sel_currency = $detail['CURRENCY'];
	$sel_autocollection = array($detail['AUTOCOLLECTION']);
	$sel_autocollection_barang = array($detail['AUTOCOLLECTION_BARANG']);
	$sel_autocollection_bm_barang = array($detail['AUTOCOLLECTION_BM_BARANG']);
	$sel_cms = array($detail['CMS']);
	//array(
	//	($detail['AUTOCOLLECTION']=='Y'?'Y')
	//);
	
	//if(!isset($sel_autocollection)){$sel_autocollection = '';}
	
	if($isEditing =='N'){
		$savebutton = 'Save';
	}
	else{
		$savebutton = 'Update';
	}
	
?>

	<style type="text/css">
		.hidden_content {
			display: none;
		}
	</style>
	
	<!-- Standard Bootstrap Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Informasi Rekening Bank</h4>
				</div>
				<div class="modal-body">
				
										<form role="form" action="<?php echo $action;?>" method="POST" id="bankform" name="bankform">
															<?	//echo "AUTOCOLLECTION : ".$sel_autocollection; ?>
															<div class="main-box-body clearfix">
															<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
																<div class="form-group col-md-3">
																	<label for="account_no">Rekening</label>
																	<div class="input-group">
																		<label class="hidden_content" for="account_no">Rekening</label>
																		<span class="input-group-addon"><i class="fa fa-money"></i></span>
																		<input type="text" class="form-control" id="account_no" name="account_no" value="<?php echo $detail['ACCOUNT_NO'];?>" />
																		<input type="hidden" name="billing_id" value="<?php echo $billing_id;?>"></input>
																		<input type="hidden" name="bank_account_id" value="<?php echo $bank_account_id;?>"></input>
																		<input type="hidden" name="isEditing" value="<?php echo $isEditing;?>"></input>
																	</div>
																</div>															
																
																<div class="form-group col-md-3">
																	<label>Bank</label>
																	<?php 	
																		echo form_dropdown("bank_id", $opt_bank, $sel_bank ,"class='form-control'"); 				
																	?>
																</div>
																
																<div class="form-group col-md-3">
																	<label>Mata Uang</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_currency, "currency", '', $sel_currency);
																		echo options_group_loader('radio', $x);
																	?>
																	</div>
																	<span class="help-block">Pilih salah satu</span>
																</div>
																<div class="form-group col-md-3">
																	<label>Autocollection</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_autocollection, "autocollection", '', $sel_autocollection);
																		echo options_group_loader('checkbox', $x);
																	?>
																	<?php 
																		$x = options_params($box_autocollection_barang, "autocollection_barang", '', $sel_autocollection_barang);
																		echo options_group_loader('checkbox', $x);
																	?>
																	<?php 
																		$x = options_params($box_autocollection_bm_barang, "autocollection_bm_barang", '', $sel_autocollection_bm_barang);
																		echo options_group_loader('checkbox', $x);
																	?>
																	</div>
																</div>
																
																<?php 
																if($this->session->userdata('registrationcompanyid_phd')==JAI_ORG){			
																?>
																
																<div class="form-group col-md-3">
																	<label>CMS</label>
																	<div class="row">
																	<?php 
																		$x = options_params($box_cms, "cms", '', $sel_cms);
																		echo options_group_loader('checkbox', $x);
																	?>
																	</div>
																</div>																
																
																<?php
																}
																?>
																
																<div class="form-group col-md-3 hidden_content" >
																	<label>Token ID</label>
																	<div class="row">
																		<input type="text" class="form-control" id="token_id" name="token_id" value="<?php echo $detail['TOKEN_ID'];?>" />
																	</div>
																</div>
																
																<?php 
																if($this->session->userdata('registrationcompanyid_phd')==JAI_ORG){			
																?>
																
																<div class="form-group col-md-3" id="saldo_minimum_cms_box" class="">
																	<label>Saldo Minimum CMS</label>
																	<div class="row">
																		<input type="text" class="form-control" maxlength="17" id="saldo_minimum_cms" name="saldo_minimum_cms" value="<?php echo $detail['SALDO_MIN_CMS'];?>" />
																	</div>								
																</div>													
																<div class="form-group col-md-3">
																	<div class="form-group col-md-12">
																		<label>Cabang</label>
																		<? 	
																			echo form_dropdown('branch', $opt_branch_group, $detail['BRANCH_ID'] ,"class='form-control'");
																		?>
																	</div>									
																</div>	
																<?php
																}
																?>
															</div>
															
										</form>
							
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="bankSaveButton" disabled ><?php echo $savebutton;?></button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<script src="<?=CUBE_?>js/jquery.maskMoney.js"></script>
	<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
	
	<script>
	
	$(function(){
		$('#bankSaveButton').click(function(){
			var isEditing = $('[name=isEditing]').val();
			var names = ['account_no'];
			
			if (validateForm('#bankform', names)){
				if( isEditing == 'N' ){
					console.log('save......');
					save_bank();
				}
				else{
					console.log('update......');
					update_bank();
				}
			}
		});
		
		$('#bankform input[name=account_no]').keyup(function(){
			validate_bank();
		});
		
		$('#bankform input[name=currency]').change(function(){
			validate_bank();
		});
		
		$('#bankform select[name=bank_id]').change(function(){
			validate_bank();
		});
		
		$('#bankform input[name=autocollection]').change(function(){
			validate_bank();
		});		
		
		$('#bankform input[name=autocollection_barang]').change(function(){
			validate_bank();
		});

		$('#bankform input[name=autocollection_bm_barang]').change(function(){
			validate_bank();
		});

		$('#bankform input[name=cms]').change(function(){
			if(this.checked)
			{
				$('#saldo_minimum_cms_box').removeClass('hidden_content');
			}
			else{
				$('#saldo_minimum_cms_box').addClass('hidden_content');
			}
			validate_bank();
		});
		
		$('#bankform input[name=saldo_minimum_cms]').change(function(){
			validate_bank();
		});		
		
		$('#bankform input[name=token_id]').change(function(){
			validate_bank();
		});
		
		$('#bankform select[name=branch]').change(function(){
			validate_bank();
		});

		
		
		$('#account_no').mask('999?99999999999999999');
		$('#saldo_minimum_cms').maskMoney({thousandsStay:false, precision: 0, prefix:'Rp ', allowNegative: false, thousands:'.', affixesStay: false});
		
		var is_cms = '<?=$sel_cms[0]?>';
		
		if(is_cms!="Y")
		{
			$('#saldo_minimum_cms_box').addClass('hidden_content');
		}
	})
	</script>
