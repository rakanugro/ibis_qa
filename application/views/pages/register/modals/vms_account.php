<!-- <?php
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
	
?> -->

	<style type="text/css">
		.hidden_content {
			display: none;
		}
	</style>
	
	<!-- Standard Bootstrap Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">User VMS</h4>
				</div>
				<div class="modal-body">
				
										<form role="form" action="<?php echo $action;?>" method="POST" id="bankform" name="bankform">
															<?	//echo "AUTOCOLLECTION : ".$sel_autocollection; ?>
															<div class="main-box-body clearfix">
															<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												
																<div class="row">
																	<div class="form-group example-twitter-oss col-md-12">
																		<label for="holding" >VMS ID</label>
																		<input type="text" class="form-control " id="vms_id" name="vms_id" />
																	</div>
																</div>
																<div class="row">
																	<div class="form-group example-twitter-oss col-md-12">
																		<label for="holding" >NAMA</label>
																		<input type="text" class="form-control" id="nama" name="nama" />
																	</div>
																</div>
																<div class="row">
																	<div class="form-group example-twitter-oss col-md-12">
																		<label for="holding" >CABANG</label>
																		<input type="text" class="form-control" id="nama" name="nama" />
																	</div>
																</div>
																<div class="row">
																	<div class="form-group example-twitter-oss col-md-12">
																		<label for="holding" >NPWP</label>
																			<input type="text" class="form-control" id="npwp" name="npwp" value="" />
																		<span class="help-block">ex. 99.999.999.9-999.999</span>
																	</div>															
																</div>
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
	
	$("#npwp").mask("99.999.999.9-999.999");
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
