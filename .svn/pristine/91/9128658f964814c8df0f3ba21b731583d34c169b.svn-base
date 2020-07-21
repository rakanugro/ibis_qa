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
      <form class="form-signin" autocomplete="off">
	  <!--form class="form-signin" role="form" action="<?=ROOT?>forgotpassword/submit/" method="POST" onsubmit="return validate()" autocomplete="off"-->
     <?php 
		//$attributes = array('role'=>'form','onsubmit'=>'return validate()','autocomplete'=>'off','class'=>'form-signin');
        //echo form_open(ROOT.'forgotpassword/submit',$attributes);	
	  ?>
	 <h2 class="form-signin-heading">Reset Password</h2>
		<input type="text" class="form-control " placeholder="User Name" name="username" id="username" required autofocus>
		<br/>
		<div>
			<center>Please Input this code:</center>
			<div id="captcha"><?=$image;?></div>
			<input type="text" class="form-control" placeholder="code" name="security_code" id="security_code" required>
			<?php echo form_error('security_code'); ?>
		</div>
        <button class="btn btn-lg btn-primary btn-block" id="submit" type="button" onclick="submitForgot()" disabled>Reset</button>
		<button class="btn btn-lg btn-primary btn-block" id="back" type="button" onclick="location.href='../';">Back</button>
		<input type="hidden" name="created_by" id="created_by" value="system-ibis"/>
		<input type="hidden" name="ajax" id="ajax" value="0"/>
      </form>

	  <script src="<?=CUBE_?>js/jquery.js"></script>
	  <script src="<?=CUBE_?>js/spark-md5.min.js"></script>
	  <script>
		/*var newuser = false;
		
	  	$(function(){
			$('#username').blur(function(event){
				//console.log(event);				
				if (event.target.value.length >0 ){
					var username = $('#username').val();
					$.get("<?=ROOT;?>reguser/check_username/"+username, function(data){
						if (!data){
							newuser = false;
							alert('Username not registered! Please use another username');
							//console.log('exist...');		
						}
						else{
							newuser = true;
							//console.log('new...');
						}
						check();
					})
				}
			});

		});*/
		
		$(function(){
			$('#username, #security_code').keyup(function(event){
				//console.log(event);
				check();
			});		
		});
		
		function check(){
			if ($('#username').val().length > 0 && $('#security_code').val().length > 0){
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
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
						security_code:security_code
					},
			  async: false,
			  cache: false,					
			  success: function(data) {
							//console.log(data);
							if(data=="OK")
							{
								alert("ok captcha");
								getNewCaptcha();
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
		};
		
		function getNewCaptcha()
		{
			$("#captcha").load("<?=ROOT;?>reguser/getNewCaptcha/true");
		}	

		function submitForgot()
		{	
			var security_code = $('#security_code').val();
			var username = $('#username').val();
			var created_by = $('#created_by').val();
			var ajax = $('#ajax').val();
			
			var url="<?=ROOT?>forgotpassword/submit1";
			$.post(url,{
					security_code:security_code,
					username:username,
					ajax:ajax,
					created_by:created_by,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},			
			function(data) {
				if(data == 'NOKreset') {
					alert('Reset sudah pernah dilakukan sebelumnya, silakan cek email Anda.');
					getNewCaptcha();
					//return false;
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
					//alert("Reset Success");
					document.location.href = "<?=ROOT?>"+data;
				}
			});
		}
	  </script>
	  
	  
	<script>
		$(document).ready(function() {
			//sql injection protection
			$(":input").keyup(function(event) {
				$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
			});
		});
	</script>