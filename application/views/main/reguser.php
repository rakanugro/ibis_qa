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
      
      <form class="form-signin">
	  <?php 
		//$attributes = array('role'=>'form','onsubmit'=>'return validate()','autocomplete'=>'off','class'=>'form-signin');
        //echo form_open(ROOT.'reguser/submit',$attributes);
	
	  ?>	
	  <h2 class="form-signin-heading">New User</h2>
		<input type="text" class="form-control " placeholder="User Name" name="username" id="username" required autofocus>
		<?php echo form_error('username'); ?>
		
		<input type="text" class="form-control middle" placeholder="Real Name" name="name" id="name" required>
		<?php echo form_error('name'); ?>
		
		<input type="email" class="form-control middle last" placeholder="Email" name="email" id="email" required>
		<?php echo form_error('email'); ?>
		
        <div class="form-group">
			<input type="password" class="form-control middle last" placeholder="Password" id="password" autocomplete="off" required >
        </div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Retype Password" id="password_retype" autocomplete="off" required>
        </div>
		<div>
			<center>Please Input this code:</center>
			<div id="captcha"><?=$image;?></div>			
			<input type="text" class="form-control" placeholder="code" name="security_code" id="security_code" required>
			<?php echo form_error('security_code') ?>
		</div>
		<br/>
        <button class="btn btn-lg btn-primary btn-block" id="submit" type="button" onclick="submitReguser()" disabled>Save</button>
		<button class="btn btn-lg btn-primary btn-block" id="back" type="button" onclick="location.href='../';">Back</button>
		<input type="hidden" id="encryptedpass" name="encryptedpass"/>
		<input type="hidden" id="created_by" name="created_by" value="user-ibis"/>
		<input type="hidden" name="ajax" value="0"/>
      </form>

	  <script src="<?=CUBE_?>js/jquery.js"></script>
	  <script src="<?=CUBE_?>js/spark-md5.min.js"></script>
	  <script>
		var newuser = false;
		
	  	$(function(){
			$('#password, #password_retype, #username, #security_code').keyup(function(event){
				//console.log(event);
				check();
			});
			
			/*$('#username').blur(function(event){
				console.log(event);				
				if (event.target.value.length >0 ){
					var username = $('#username').val();
					$.get("<?=ROOT;?>reguser/check_username/"+username, function(data){
						if (!data){
							newuser = true;
							//console.log('new...');
						}
						else{
							newuser = false;
							alert('Invalid User');
							//console.log('exist...');
						}
						check();
					})
				}
			});*/
			
			$('#password').blur(function(event){
				if (event.target.value.length >0 ){
					var pwd = $('#password').val();
					var checkPass = checkRepeatPass(pwd);
					var p = pwd,errors = [];
					if (	p.length < 10 
							|| p.length > 128 
							|| p.search(/[a-z]/) < 0 
							|| p.search(/[A-Z]/) < 0 
							|| p.search(/[0-9]/) < 0 
							|| checkPass != 0
						) {
						newuser = false;
						alert("Your password must be at least 10 characters, contain lowercase letter, UPPERCASE letter and number (0..9). \nMaximum use 2 times of the same character in a sequence. (i.e. don't use : test12223)"); 
					} else {
						newuser = true;
					}
					check();
				}
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
		
		function check(){
			if ($('#password_retype').val() == $('#password').val() 
				&& $('#username').val().length > 0 
				&& $('#security_code').val().length > 0
				&& newuser){
				$('#submit').removeAttr('disabled');					
				$('#encryptedpass').val( SparkMD5.hash($('#password').val()+$('#username').val()) );				
			}
			else{
				$('#submit').attr('disabled','disabled');
			}
		}		

		function validate(){
			
			var security_code = $('#security_code').val();
			var result = false;
			
			$.ajax({
			  type: 'POST',
			  url: "<?=ROOT;?>reguser/checksecuritycode/",
			  data: {
						security_code:security_code,
						 '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
					},
			  async: false,
			  cache: false,					
			  success: function(data) {
							//console.log(data);
							if(data=="OK")
							{
								//alert("ok captcha");
								result = true;
							}
							else
							{
								alert("Wrong captcha");
								getNewCaptcha();
								result = false;
							}
						}
			});

			return result;
		}
		
		function getNewCaptcha()
		{
			$("#captcha").load("<?=ROOT;?>reguser/getNewCaptcha/true");
		}
		
		function submitReguser()
		{	
			var security_code = $('#security_code').val();
			var encryptedpass = $('#encryptedpass').val();
			var username = $('#username').val();
			var name = $('#name').val();
			var email = $('#email').val();
			var created_by = $('#created_by').val();
	
			var url="<?=ROOT?>reguser/submit1";
			$.post(url,{
					encryptedpass:encryptedpass,
					security_code:security_code,
					username:username,
					name:name,
					email:email,
					created_by:created_by,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},			
			function(data) {
				if(data == 'salah') {
					alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
					getNewCaptcha();
					return false;
				}
				else if(data=='NOK') {
					alert("Wrong Captcha");
					getNewCaptcha();
					//$('#submit').attr('disabled','disabled');
				}
				else if(data=='NOKuser') {
					alert("Invalid User");
					getNewCaptcha();
					//$('#submit').attr('disabled','disabled');
				}
				else if(data=='Failed') {
					alert("Register Failed");
					getNewCaptcha();
					//$('#submit').attr('disabled','disabled');
				}
				else
				{
					alert("Register Success");
					document.location.href = "<?=ROOT?>"+data;
				}
			});
		}
	  </script>
	
	
	<script>
		$(document).ready(function() {
			//sql injection protection
			$(":input").keyup(function(event) {
				$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
			});
		});
	</script>