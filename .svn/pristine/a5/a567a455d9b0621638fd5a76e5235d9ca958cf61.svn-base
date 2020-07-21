<?php

	if (!isset($detail)){
		$detail = array(
						'USER_ID' 			=> '',
						'REAL_NAME' 		=> '',
						'INFO_SMS_NUMBER' 	=> '',
						'INFO_EMAIL_ADDRESS' => ''						
					);
	}	
	
	if(!isset($user_id)) 	$user_id 	= $detail['USER_ID'];
	if(!isset($real_name)) 	$real_name 	= $detail['REAL_NAME'];
	if(!isset($sms)) 		$sms 		= $detail['INFO_SMS_NUMBER'];
	if(!isset($email)) 		$email 		= $detail['INFO_EMAIL_ADDRESS'];
	
	if ($user_id != ''){
		$behavior = "edit";

	}
	else{
		$behavior = "new";
	}
?>
	<style type="text/css">
		.hidden_content {
			display: none;
		}
	</style>
	
	<!-- Standard Bootstrap Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pendaftaran User Login</h4>
				</div>
				<div class="modal-body">
					<form role="form" name="user_simkapal" id="user_simkapal">
					
						<? //print_r($detail);?>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div class="form-group">
							<label for="user_id">Username</label>
							<input type="input" class="form-control" id="user_id" name="user_id" placeholder="Enter username" value="<?=$user_id;?>">
						</div>
						<div class="form-group">
							<label for="real_name">Real Name</label>
							<input type="text" class="form-control" id="real_name" name="real_name" placeholder="Your name or company name" value="<?=$real_name;?>">
						</div>
						<div class="form-group">
							<label for="info_sms_number">SMS Number</label>
							<input type="text" class="form-control" id="info_sms_number" name="info_sms_number" placeholder="Phone number for SMS notification" value="<?=$sms;?>">
						</div>
						<div class="form-group">
							<label for="info_email_address">Email address</label>
							<input type="text" class="form-control" id="info_email_address" name="info_email_address" placeholder="Email address for email notification" value="<?=$email;?>">
						</div>
						<div class="form-group">
							<label for="customer_id">Customer ID</label>
							<input type="customer_id" class="form-control" id="customer_id" name="customer_id" readonly>
						</div>
						<div class="form-group hidden_content">
							<label for="customer_id">Shipping Agent ID</label>
							<input type="customer_id" class="form-control" id="shipping_agent_id" name="shipping_agent_id" readonly>
						</div>
						<div class="form-group hidden_content">
							<label for="customer_id">External ID</label>
							<input type="customer_id" class="form-control" id="external_id" name="external_id" readonly>
						</div>
						<div class="form-group hidden_content">
							<label for="customer_id">Branch ID</label>
							<input type="customer_id" class="form-control" id="branch_id" name="branch_id" readonly>
						</div>
					</form>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="userSaveButton" disabled >Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script>
		var behavior = '<?=$behavior;?>';
	
		$('input').keyup(function(){
			if ( 	   $('#user_id').val() != '' 
					&& $('#real_name').val() != '' 
					&& $('#info_sms_number').val() != '' 
					&& $('#info_email_address').val() != '' 
					&& $('#customer_id').val() != ''
					&& $('#shipping_agent_id').val() != ''){
				$('#userSaveButton').removeAttr('disabled');
			}
			else{
				$('#userSaveButton').attr('disabled', 'disabled');
			}
		});
		
		$('#userSaveButton').click(function(){
			tmp = {};
			$('#user_simkapal input').each(function(){
				//console.log(this.name);
				tmp[this.name] = this.value;
			});
			if (behavior == 'new'){
				saveSimkapalUser(tmp, 'S');
			}
			else{
				saveSimkapalUser(tmp, 'U');
			}
		});
	</script>