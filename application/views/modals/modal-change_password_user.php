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
					<h4 class="modal-title">Change Password</h4>
				</div>
				<div class="modal-body">
					
					<form role="form" name="user_changepassword" id="user_changepassword">
					
						<? //print_r($detail);?>
						<div class="form-group">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						</div>
						<div class="form-group">
							<label for="user_id">User ID</label>
							<input type="input" class="form-control" id="user_id" name="user_id" placeholder="Enter username" value="" autocomplete="off" readonly>
						</div>
						<div class="form-group">
							<label for="real_name">Old Password</label>
							<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter old password" value="" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="real_name">New Password</label>
							<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" value="" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="real_name">Retype New Password</label>
							<input type="password" class="form-control" id="retype_new_password" name="retype_new_password" placeholder="Retype new password" value="" autocomplete="off">
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
		var newPassword = false;		
	
		/*$('input').keyup(function(){
			if ( 	   $('#user_id').val() != '' 
					&& $('#old_password').val() != '' 
					&& $('#new_password').val() != '' 
					&& $('#retype_new_password').val() != ''
				){
				$('#userSaveButton').removeAttr('disabled');
			}
			else{
				$('#userSaveButton').attr('disabled', 'disabled');
			}
		});*/
		
		$(function(){
			$('input').keyup(function(event){
				checkButton();
			});
			
			$('#new_password').blur(function(event){
				if (event.target.value.length >0 ){
					var pwd = $('#new_password').val();
					var checkPass = checkRepeatPass(pwd);
					var p = pwd,errors = [];
					if (	p.length < 10 
							|| p.length > 128 
							|| p.search(/[a-z]/) < 0 
							|| p.search(/[A-Z]/) < 0 
							|| p.search(/[0-9]/) < 0 
							|| checkPass != 0
						) 
					{
						newPassword = false;
						alert("Your password must be at least 10 characters, contain lowercase letter, UPPERCASE letter and number (0..9). \nMaximum use 2 times of the same character in a sequence. (i.e. don't use : test12223)"); 
					} else {
						newPassword = true;						
					}
					checkButton();
				}
			});			
		});
		
		$('#userSaveButton').click(function(){			
			var check = true;
			
			var path = "<?=ROOT;?>register/user_check_old_password/";
			
			var user_id = $('#user_id').val();
			var old_password = $('#old_password').val();
			
			$.post(path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',user_id:user_id,old_password:old_password})
				.done(function( data ) {
					console.log(data);
					if(data==0)
					{
						alert("Old password failed");
					}
					else if (data>0)
					{

						if($('#new_password').val()!=$('#retype_new_password').val())
						{
							alert("retype new password doesn't same with new password");
							$('#retype_new_password').focus();
						}
						else 
						{
							console.log('else :'+data);
							var tmp = {};
							$('#user_changepassword input').each(function(){
								//console.log(this.name);
								tmp[this.name] = this.value;
							});
							
							updatePasswordUser(tmp);
						}
					}
					else
					{
						alert(data);
						if (data.indexOf("Your user login is not activated") !== -1 )
							document.location.href = "<?=ROOT?>main/logout";
					}
			}).fail(function() {
				alert("error, update customer gagal");
				check = false;
			});
		});
		
		function checkRepeatPass(pass){
			var tmp = {};
			var tmpC;
			var count = 0;
			for(var i = pass.length-1; i >= 0; i--) {
				var c = pass.charAt(i);
				if (i == pass.length-1){
					tmpC = c;
				}else {
					if (c == tmpC){
						if(c in tmp) {
							tmp[c] += 1;
						}
						else {
							tmp[c] = 1;
						}
						if(tmp[c] >= 2){
							count =+ 1;
						}				
					}else {
						tmp = {};
						tmpC = c;
					}
				}
			} 
			return count;
		}
		
		function checkButton(){
			if ( 	   $('#user_id').val() != '' 
					&& $('#old_password').val() != '' 
					&& $('#new_password').val() != '' 
					&& $('#retype_new_password').val() != ''
					&& newPassword
				)
			{
				$('#userSaveButton').removeAttr('disabled');
			}
			else{
				$('#userSaveButton').attr('disabled', 'disabled');
			}
		}
	</script>