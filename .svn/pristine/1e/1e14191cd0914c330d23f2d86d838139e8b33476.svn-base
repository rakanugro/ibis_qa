    <!-- OVERRIDE STYLE -->
	<style>
		.form-signin input[type="password"] {
			margin-bottom: -1px;
		}
		
		.form-signin .middle {
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		  border-bottom-left-radius: 0;
		  border-bottom-right-radius: 0;
		}
		
		.form-signin .last{
			margin-bottom: -1px; 
		}
		
		.form-signin input[name="password_retype"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
		
		.form-group {
			margin-bottom: 0px;
		}
	
	</style>
      <form class="form-signin" role="form" action="<?=ROOT?>forgotpassword/resetpassword/" method="POST">
      <h2 class="form-signin-heading">Reset Password</h2>
	  <input type="text" class="form-control " placeholder="Username" name="username" id="username" value="<?php echo $_GET["usid"]?>" readonly required autofocus>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<input type="password" class="form-control " placeholder="Kata sandi baru / New password" name="new_password" id="new_password" autocomplete="off" required autofocus>
		<input type="password" class="form-control " placeholder="Tulis ulang kata sandi baru / Retype New password" name="new_password_retype" id="new_password_retype" autocomplete="off" required autofocus>
		<br/>
        <button class="btn btn-lg btn-primary btn-block" id="submit" type="submit" onsubmit="validate();" disabled>Reset</button>
		<button class="btn btn-lg btn-primary btn-block" id="back" type="button" onclick="location.href='../';">Back</button>
		<input type="hidden" id="encryptedpass" name="encryptedpass"/>
		<input type="hidden" name="created_by" value="system-ibis"/>
		<input type="hidden" name="ajax" value="0"/>
      </form>

	  <script src="<?=CUBE_?>js/jquery.js"></script>
	  <script src="<?=CUBE_?>js/spark-md5.min.js"></script>
	  <script>
	  var newuser = false;
	  
	  	$(document).ready(function() {
			//sql injection protection
			$(":input").keyup(function(event) {
				$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
			});
		});
		
		$(function() {
			$('#new_password, #new_password_retype').keyup(function(event){
					//console.log(event);
					check();
			});
		
			$('#new_password').blur(function(event) {
					if (event.target.value.length >0 ){
						var pwd = $('#new_password').val();
						var checkPass = checkRepeatPass(pwd);
						var p = pwd,errors = [];
						if ( p.length < 10 
								|| p.length > 128 
								|| p.search(/[a-z]/) < 0 
								|| p.search(/[A-Z]/) < 0 
								|| p.search(/[0-9]/) < 0 
								|| checkPass != 0 )
						{
							newuser = false;
							alert("Your password must be at least 10 characters, contain lowercase letter, UPPERCASE letter and number (0..9). \nMaximum use 2 times of the same character in a sequence. (i.e. don't use : test12223)"); 			
						} 
						else {
							newuser = true; 
						}
						check();
					}
				});
		});
		
		function checkRepeatPass(pass) {
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
		
		function check() {
			if ($('#new_password').val().length > 4 && ($('#new_password').val()==$('#new_password_retype').val()) && newuser){
				$('#submit').removeAttr('disabled');
				$('#encryptedpass').val( SparkMD5.hash($('#new_password').val()+$('#username').val()) );
			}
			else{
				$('#submit').attr('disabled','disabled');
			}
		}
	  </script>