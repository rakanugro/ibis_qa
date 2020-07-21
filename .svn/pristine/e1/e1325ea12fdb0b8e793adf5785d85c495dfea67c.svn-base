<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <title>PT Pelabuhan Indonesia Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="icon" href="<?php echo APP_ROOT;?>assets/images/favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
      body {
        background-image: url("<?php echo APP_ROOT;?>assets/images/bg.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
      }
      .well {
        background-color: white;
      }
      .login-container{
        margin-top:8%;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="login-container">
            <div class="well">
              <div class="container-logo">
                <div class="row">
                  <div class="col-sm-4">
                    <img src="<?php echo APP_ROOT;?>assets/images/ipc_logo.png" alt="">
                  </div>
                  <div class="col-sm-8">
                    <br>
                    <br>
                    <h4>PT PELABUHAN INDONESIA II (PERSERO)</h4>
                    <!-- <p>Jalan Pasoso No 1 Tanjung Priok, Jakarta Utara 14310</p> -->
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <!--form login-->
                    <br>
                      <form class="form-horizontal" id="form2"action="" method="post">
                        <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                        <input type="hidden" name="id" value="bfdba52708">
                          <div class="form-group">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <label class="control-label col-sm-2" for="email">Username</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="passwordx">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="passwordx" placeholder="Password">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="captcha">Captcha</label>
                            <div class="col-sm-10">
                              <center><?=$image;?></center>
                              <br>
                              <input type="text" class="form-control" name="security_code" id="security_code" placeholder="Security Code">
                            </div>
                          </div>
                          <div class="col-sm-2"></div>
                          <div class="col-sm-8"></div>
                          <div class="col-sm-2 col-sm-8 col-sm-2">
                            <input type="button" class="btn btn-danger" name="" value="Login" onClick="Login()">
                          </div>
                        </form>
                    <!--form login-->
                </div>
                <div class="col-lg-2"></div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="col-lg-2"></div>
      </div>
<script type="text/javascript">
$("#form2").keypress(function(event){

	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){Login();
	}

});
function Login(){
		var sortable = true;
		//alert('test');false;
		if(sortable)
		{

			var url="<?=APP_ROOT?>index.php/user/auth";
			//alert('<?php echo $this->security->get_csrf_hash(); ?>');

			$.post(url,{"username":$("#username").val(), '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',"password":$("#passwordx").val(),"lang":$("#lang").val(),"security_code":$("#security_code").val()},function(data){
          var obj = jQuery.parseJSON(data);
          var status = obj['status'];
          //alert("wrong username & password");
          //alert(obj['message']);
          if(obj['message']=='Success'){

            /*alert('Anda berhasil login');*/

            window.location = "<?=APP_ROOT?>index.php/dashboard_invoice";
          }else {

            alert(obj['message']);

          }

          //location.reload();
          //alert("Login Failed : Invalid username or password. \n(see log for detail).");
          //toggleOverlay($("#username").val());


			});
		}
	}

$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
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

  </body>
</html>
