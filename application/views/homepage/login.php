<?php 
function isMobile() {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>
    
	<script src="<?=CUBE_;?>homepage/login/js/index.js"></script>
    <style type="text/css">
            #sortable {
                list-style-type: none;
                margin: 5px 0px 0px 5px;
                padding: 0;
            }
            #sortable li {
                margin: 0px 3px 3px 0;
                padding: 1px;
                float: left;
                width: 30px;
                height: 30px;
                font-size: 14px;
                text-align: center;
                line-height:22px;
                cursor:pointer;
                -moz-border-radius:5px;
                -webkit-border-radius:5px;
                -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.5);
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.5);
                text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
                background:#2daebf url(images/overlay.png) repeat-x scroll 50% 50%;
                color:#fff;
                font-weight:normal;
            }
            .captcha_wrap{
                border:1px solid #fff;
                -moz-border-radius:10px;
                -webkit-border-radius:10px;
                -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
                float:left;
                height:40px;
                font-weight: bold;
                width:140px;
                overflow:hidden;
                /*margin: 0 auto 10px auto;*/
				margin:0px 0px 0px 230px;
                background-color:#fff;
				right:0px;
				text-align:center;
            }
            .captcha{
                -moz-border-radius:10px;
                -webkit-border-radius:10px;
                font-size:14px;
				font-weight: bold;
                color:#BBBBBB;
                text-align: center;
                border-bottom:1px solid #CCC;
                background-color:#fff;
            }
        </style>
        
            <script type="text/javascript">
            $(function() {
                $("#login-button").click(function(){
					var sortable = true;
					
					if(sortable) 
					{
						
						var url="<?=APP_ROOT?>index.php/main/do_log";
						//alert('<?php echo $this->security->get_csrf_hash(); ?>');
						
						$.post(url,{"username":$("#username").val(), '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',"password":$("#password").val(),"lang":$("#lang").val(),"security_code":$("#security_code").val()},function(data){
							//alert(data);
							if(data=="Success"){
								window.location = "<?=APP_ROOT?>index.php/main";
							}
							else if(data=="Active"){
								alert("User is active, cannot use concurrent user!");
								toggleOverlay($("#username").val());
							}
							else
							{
								//alert("wrong username & password");
								alert(data);
								//alert("Login Failed : Invalid username or password. \n(see log for detail).");
								toggleOverlay($("#username").val());
							}
							
						});
					}
                });
				
                $("#cancel").click(function(){
					cancelOverlay();
                });				
            });
			$(document).ready(function() {
				//sql injection protection
				$(":input").keyup(function(event) {
					// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
					$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
				});
			});

        </script>

  <div class="d1">
    <div class="wrappers">
	<div class="notcontainer">
		<h1>Sign in</h1>
		
		<form class="form2" autocomplete="off">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<input type="text" placeholder="Username" id="username" value="<?=$username?>" autocomplete="off"/>
			<?php echo form_error('username'); ?>
			
			<input type="password" placeholder="Password" id="password" autocomplete="off"/>
			<?php echo form_error('password'); ?>
			
			<select placeholder="language" id="lang">
				<option value="ID">Bahasa</option>
				<option value="EN">English</option>
			</select>
			<fieldset>
			<center>Please Input this code:</center>
			<?=$image;?>
			
			<input type="text" placeholder="code" name="security_code" id="security_code">
			<?php echo form_error('security_code') ?>
			
            </p>
            </fieldset>
			<?php 
			if(isMobile())
			{
			?>			
				<button type="button" id="login-button" style="margin:10px;">Sign In</button>
				<a href="<?=ROOT?>reguser"><button type="button" id="register-button">Register</button></a>
			<?php
			}
			else 
			{
			?>
				<a href="<?=ROOT?>reguser"><button type="button" id="register-button">Register</button></a>			
				<button type="button" id="login-button">Sign In</button>
			<?php 
			}?>
			<div align="right">
			<a style="color:white" href="#" id="cancel">cancel login</a> || 
			<a style="color:white" href="<?=ROOT?>forgotpassword">forgot password?</a>
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			</div>
		</form>
	</div>
	<?php		
		if(!isMobile()){
	?>
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
	<?php }?>
</div>
</div>

	<script>
		$(document).ready(function() {
			//sql injection protection
			$(":input").keyup(function(event) {
				// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
				$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
			});
		});
	</script>
