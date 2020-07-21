<?php
	//var_dump($detail); die;

	//initiate
	if(!isset($detail)){
		$detail = array(
			'ID' 	=> '',
			'PPJK_ID' 	=> '',
			'CONSIGNEE_ID' 	=> '',
			'CONSIGNEE_NAME' => '',
			'EXPIRED_DATE' 	=> ''
		);
		
		$isEditing = 'N';
	}
	else{
		$isEditing = 'Y';
	}
	
	if(!isset($action)){$action = '';}
	
	if(!isset($id)){$id = $detail['ID'];}
	if(!isset($ppjk_id)){$ppjk_id = $detail['PPJK_ID'];}
	if(!isset($consignee_id)){$consignee_id = $detail['CONSIGNEE_ID'];}
	if(!isset($consignee_name)){$consignee_name = $detail['CONSIGNEE_NAME'];}
	if(!isset($expired_date)){$expired_date = $detail['EXPIRED_DATE'];}
	
	// load data from db
	// -- none -- 
		
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
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />		
	
	<!-- Standard Bootstrap Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Choose Consignee</h4>
				</div>
				<div class="modal-body">
				
										<form role="form" action="<?php echo $action;?>" method="POST" id="form" name="form">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
											<div class="main-box-body clearfix">
												<div class="row">
													<div class="form-group example-twitter-oss">
														<label for="autocompleta">Autocomplete Customer</label>
														<!--<input type="text" class="form-control withTooltip" id="autocomplete" name="autocomplete" data-provide="typeahead" data-toggle="tooltip" data-placement="bottom" title="Consignee harus sudah terdaftar terlebih dahulu"/>
														-->
														<input  type="text" class="form-control withTooltip" id="autocompleta" name="autocompleta" 	/>
														<input type="hidden" name="isEditing" value="<?php echo $isEditing;?>" />
														<input type="hidden" name="ppjk_id" value="<?php echo $ppjk_id;?>" />
														<input type="hidden" name="id" value="<?php echo $id;?>" />
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-3">
														<label for="consignee_id">ID</label>
														<input type="text" class="form-control" id="consignee_id" name="consignee_id" value="<?php echo $consignee_id;?>" readonly />																	
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label for="consignee_name">Name</label>
														<input type="text" class="form-control" id="consignee_name" name="consignee_name" value="<?php echo $consignee_name;?>"  readonly />
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-3">
														<label for="expired_date">Expiry Date</label>
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															<input type="text" class="form-control calendar" id="expired_date" name="expired_date" value="<?php echo $expired_date;?>" />
														</div>
													</div>
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
	<script src="<?=CUBE_?>js/hogan.js"></script>
	<script src="<?=CUBE_?>js/typeahead.min.js"></script>
	
	<script>
	
	$(function(){
		
		$('#saveButton').click(function(){
			//alert('save implementation on progress');
			var isEditing = $('[name=isEditing]').val();
			var names = ['value'];
			
			if (validateForm('#form', names)){
				var check = true;
				
				if(check){
					if( isEditing == 'N' ){
						console.log('save......');
						save_form("register/submit_ppjk_consg");
					}
					else{
						console.log('update......');
						save_form("register/update_ppjk_consg");
					}
				}			
			}
		});
		
		$('#form input').change(function(){
			validate_form();
		});
		
		
		$('#autocompleta').typeahead({
			name: 'autocomplete_consignee',
			remote: '<?=ROOT;?>register/searchcompanies/%QUERY/<?=$branch_id?>', 	// you can change anything but %QUERY
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
					$('#consignee_id').val(	datum.customer_id	);
					$('#consignee_name').val(	datum.name	);
					
					$('#consignee_id').change(); //trigger
				} );
		
		//datepicker
		$('.calendar').datepicker({
		  format	: 'dd-mm-yyyy',
		  clearBtn 	: true,
		  autoclose	: true
		});
		
	})
	</script>
