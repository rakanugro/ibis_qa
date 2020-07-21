<?php
	//initiate
	if(!isset($detail)){
		$detail = array(
			'BLACKLIST_ID' 	=> '',
			'BLACKLIST_ATTRIBUTE' => '',
			'BLACKLIST_VALUE'		=> '',
			'NOTES'		=> ''
		);
		
		$isEditing = 'N';
	}
	else{
		$isEditing = 'Y';
	}
	
	if(!isset($action)){$action = '';}
	
	if(!isset($blacklist_id)){$blacklist_id = $detail['BLACKLIST_ID'];}
	
	// load data from db
	if(!isset($opt_attribute)){$opt_attribute = rsArrToOptArr(	load_options('BLACKLISTATRIBUTE','ID')->result('array')	);}
	//var_dump($detail);die;
	
	//informasi blacklist
	echo $sel_attribute = $detail['BLACKLIST_ATTRIBUTE'];
	echo $sel_value = $detail['BLACKLIST_VALUE'];
	echo $sel_notes = $detail['NOTES'];
	
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
					<h4 class="modal-title">Blacklist Data</h4>
				</div>
				<div class="modal-body">
				
										<form role="form" action="<?php echo $action;?>" method="POST" id="form" name="form">
															<div class="main-box-body clearfix">
															<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
																<div class="form-group col-md-3">
																	<label>Atribut</label>
																	<?php 	
																		echo form_dropdown("attribute", $opt_attribute, $sel_attribute ,"class='form-control'");
																	?>
																	<input type="hidden" id="blacklist_id" name="blacklist_id" value="<?php echo $blacklist_id;?>"></input>
																	<input type="hidden" name="isEditing" value="<?php echo $isEditing;?>"></input>
																</div>
																<div class="form-group col-md-3">
																	<label for="account_no">Value</label>
																	<input type="text" class="form-control" id="value" name="value" value="<?php echo $sel_value;?>" />
																</div>
																<div class="form-group col-md-3">
																	<label for="account_no">Notes</label>
																	<textarea class="form-control" id="notes" name="notes" placeholder="" title="Notes" cols="500"><?php echo $sel_notes;?></textarea>
																</div>
															</div>
															
										</form>
							
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="saveButton" disabled ><?php echo $savebutton;?></button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
	
	<script>
	
	$(function(){
		$('#saveButton').click(function(){
			var isEditing = $('[name=isEditing]').val();
			var names = ['value'];
			
			if (validateForm('#form', names)){
				var check = true;
				
				//validasi npwp
				var blacklist_id = $('#blacklist_id').val();
				var attribute = $('select[name="attribute"] option:selected').val();
				var value = $('#value').val();
				
				var url="<?=ROOT?>register/validate_blacklist";
				
				$.ajax({
				  type: 'POST',
				  url: url,
				  data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',blacklist_id:blacklist_id,attribute:attribute,value:value},
				  success: function(data) {
								if(data=="KO")
								{
									alert("Blacklist Terdaftar.");
									$('#value').focus();
									check= false;
								}
					},
					async:false
				});
				
				if(check)
				{
					if( isEditing == 'N' ){
						console.log('save......');
						save_form("register/submit_blacklist");
					}
					else{
						console.log('update......');
						save_form("register/update_blacklist");
					}
				}
			}
		});
		
		$('#form input[name=value],#form textarea').keyup(function(){
			validate_form();
		});
		
		$('#form select[name=attribute]').change(function(){
			validate_form();
			if($('#form select[name=attribute]').val()=="NPWP")
			{
				$("#value").mask("99.999.999.9-999.999");	
			}
			else if($('#form select[name=attribute]').val()=="ID")
			{
				$("#value").mask("9999999999999999");
			}
			else 
			{
				$("#value").unmask();
			}		
		});
		
		if($('#form select[name=attribute]').val()=="NPWP")
		{
			$("#value").mask("99.999.999.9-999.999");	
		}
		else if($('#form select[name=attribute]').val()=="ID")
		{
			$("#value").mask("9999999999999999");
		}
		else 
		{
			$("#value").unmask();
		}
		
		
	})
	</script>
