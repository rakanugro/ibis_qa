<?
	if (!isset ($msg)){ $msg= ''; }
			
?>	  
	<link rel="stylesheet" type="text/css" href="<?=CUBE_;?>css/libs/ns-default.css"/>
	<link rel="stylesheet" type="text/css" href="<?=CUBE_;?>css/libs/ns-style-growl.css"/>
	<link rel="stylesheet" type="text/css" href="<?=CUBE_;?>css/libs/ns-style-theme.css"/>
	<!-- OVERRIDE STYLES -->
	<style>
		.ns-growl {
			top:auto;
			left:auto;
			top: 120px;
			right: 30%;
		}
	</style>
	

      <form class="form-signin" role="form" action="<?=ROOT?>main/do_log" method="POST">
      <h2 class="form-signin-heading">IPC e-Service</h2>
        <input type="text" class="form-control" placeholder="User Name" name="username" required autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password" required>
		<select class="form-control" name="lang" id="lang">
			<option value="EN">English</option>
			<option value="ID">Bahasa Indonesia</option>
		</select>
		<br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<br/>
        <a class="btn btn-lg btn-primary btn-block" type="button" href="<?=ROOT?>reguser">Register</a>
      </form>

<script src="<?=CUBE_;?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_;?>js/classie.js"></script>
<script src="<?=CUBE_;?>js/notificationFx.js"></script>
<script>		
		(function() {
			var msg = '<?=$msg;?>';

			if (msg.length > 0 ){
				
				// create the notification
				var notification = new NotificationFx({
					message : '<p>'+msg+'</p>',
					layout : 'growl',
					effect : 'scale',
					type : 'warning', // notice, warning, error or success
					onClose : function() {
						//bttn.disabled = false;
					}
				});

				// show the notification
				notification.show();
			}
		})();
</script>		