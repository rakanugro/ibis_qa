<!DOCTYPE html>
<html>
<head>
<!-- /.website title -->
<title>IPC eService</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no,text/html;charset=utf-8" http-equiv="Content-Type">
<!-- CSS Files -->
<link href="<?=CSS2_;?>bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?=CSS2_;?>font-awesome.min.css" rel="stylesheet">
<link href="<?=CSS2_;?>fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
<link href="<?=CSS2_;?>animate.css" rel="stylesheet" media="screen">
<link href="<?=CSS2_;?>owl.theme.css" rel="stylesheet">
<link href="<?=CSS2_;?>owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>

<!-- Colors -->
<link href="<?=CSS2_;?>css-index.css" rel="stylesheet" media="screen">
<!-- <link href="css/css-index-green.css" rel="stylesheet" media="screen"> -->
<!-- <link href="css/css-index-purple.css" rel="stylesheet" media="screen"> -->
<!-- <link href="css/css-index-red.css" rel="stylesheet" media="screen"> -->
<!-- <link href="css/css-index-orange.css" rel="stylesheet" media="screen"> -->
<!-- <link href="css/css-index-yellow.css" rel="stylesheet" media="screen"> -->

<!-- Google Fonts -->
<link rel="stylesheet" href="<?=CSS2_;?>fonts/font_css.css" />

</head>
  
<body data-spy="scroll" data-target="#navbar-scroll">

<!-- /.preloader -->
<div id="preloader"></div>
<div id="top"></div>

<!-- /.parallax full screen background image -->
<div class="fullscreen landing parallax" style="background-image:url('<?=CSS2_;?>/images/bg.jpg');" data-img-width="2000" data-img-height="1333" data-diff="100">
	
	<div class="overlay">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
				
					<!-- /.logo -->
					<div class="logo wow fadeInDown"> <a href=""><img src="<?=CSS2_;?>/images/logo.png" alt="logo"></a></div>

					<!-- /.main title -->
						<h1 class="wow fadeInLeft">
						IPC eService
						</h1>

					<!-- /.header paragraph -->
					<div class="landing-text wow fadeInUp">
						<!--<p>Backyard is a modern and customizable landing page template designed to increase conversion of your product. Backyard is flexible to suit any kind of your business. Try now and join with our happy customers!</p>-->
						<p>Find your port service, in eService. eService will help you to apply any of port service in IPC (PT. Pelabuhan Indonesia II) area on One Site, One Click, One Pay, and only one our point is customer satisfaction.</p>
					</div>				  

					<!-- /.header button -->
					<div class="head-btn wow fadeInLeft">
						
						<a href="<?=CSS2_;?>/manual e-service.rar" class="btn-default">Download User Guide</a>
					</div>
	
		  

				</div> 
				
				<!-- /.signup form -->
				<div class="col-md-5">
					 <?php 
					 	//pop up buat tgl 3 - 4 Nov 2019
					 	$date=date('Ymd');
					 	if($date < '20191105'){
					 ?>
					<div id="thover"></div>
					  <div id="tpopup">
					    <img src="<?=CSS2_;?>/images/image_sosialisasi.png" width="100%"> 
					 
					    <div id="tclose">X</div>    
					  </div>
					  <?php } ?>
					<div class="signup-header wow fadeInUp">
						<h3 class="form-title text-center">Sign In</h3>
						<form class="form-header" action="" autocomplete="off" role="form" id="#">
						<input type="hidden" name="u" value="503bdae81fde8612ff4944435">
						<input type="hidden" name="id" value="bfdba52708">
							<div class="form-group">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<input class="form-control input-lg" name="username" id="username" type="text" placeholder="User name" required>
								<?php echo form_error('username'); ?>
							</div>
							<div class="form-group">
								<input class="form-control input-lg" name="passwordx" id="passwordx" type="password" placeholder="Password" required>
								 <p><input type="checkbox" onchange="document.getElementById('passwordx').type = this.checked ? 'text' : 'password'">&nbsp;Show password<p>
								 <?php echo form_error('password'); ?>
							</div>
							<div class="form-group" align="center">
							<center>Please Input this code:</center>
							<select placeholder="language" id="lang">
								<option value="ID">Bahasa</option>
								<option value="EN">English</option>
							</select><br>
							<?=$image;?>
							<input type="text" placeholder="Entry Security Code" name="security_code" id="security_code">
							<?php echo form_error('security_code') ?>
							</div>
							<div class="form-group last">
								<input type="button" class="btn btn-warning btn-block btn-lg" id="login-button" onclick="Login()" value="Sign In">
								<br>
								<a href="<?=ROOT?>reguser"><input type="button" class="btn btn-warning btn-block btn-lg" id="login-button" value="Sign Up"></a>
								<a style="color:white;" href="<?=ROOT?>forgotpassword">forgot password?</a>
							</div>
							<p class="privacy text-center">We will not share your account. Read our <a href="privacy.html">privacy policy</a>.</p>
						</form>
					</div>				
				
				</div>
			</div>
		</div> 
	</div> 
</div>
 
<!-- NAVIGATION -->
<div id="menu">
	<nav class="navbar-wrapper navbar-default" role="navigation">
		<div class="container">
			  <div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand site-name" href="#top"><img src="<?=CSS2_;?>/images/logo2.png" alt="logo"></a>
			  </div>
	 
			  <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
				<ul class="nav navbar-nav">
					<!--<li><a href="#intro">About</a></li>-->
					<li><a href="#feature">Features</a></li>
					<!--<li><a href="#download">Download</a></li>-->
					<!--<li><a href="#package">Pricing</a></li>-->
					<!--<li><a href="#testi">Partner</a></li>-->
					<li><a href="#contact">Contact</a></li>
				</ul>
			  </div>
		</div>
	</nav>
</div>

<!-- /.intro section -->
<!--<div id="intro">
	<div class="container">
		<div class="row">

		<!-- /.intro image -->
<!--			<div class="col-md-6 intro-pic wow slideInLeft">
				<img src="images/intro-image.jpg" alt="image" class="img-responsive">
			</div>	
			
			<!-- /.intro content -->
<!--			<div class="col-md-6 wow slideInRight">
				<h2>Optimize performance through advanced targeting solutions</h2>
				<p>Good marketing makes the company look smart. <a href="#">Great marketing</a> makes the customer feel smart, - Joe Chernov. Never doubt a small group of thoughtful, committed people can change the world. Indeed, it is the only thing that ever has, - Margaret Mead. The best way to predict the future is to create it, - Peter Drucker.
				</p>

					<div class="btn-section"><a href="#feature" class="btn-default">Learn More</a></div>
		
			</div>
		</div>			  
	</div>
</div>

<!-- /.feature section -->

<div id="feature">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

			<!-- /.feature title -->

			<h2>IPC eService Feature</h2>
				<p>Increase our customer loyalty by maintaining mutual relation and provide the best port service.</p>
			</div>
		</div>
		<div class="row row-feat">
			<div class="col-md-4 text-center">

			<!-- /.feature image -->

			<div class="feature-img">
					<img src="<?=CSS2_;?>/images/feature-image.png" alt="image" class="img-responsive wow fadeInLeft">
				</div>
			</div>
		
			<div class="col-md-8">
			
				<!-- /.feature 1 -->

				<div class="col-sm-6 feat-list">
					<i class="pe-7s-notebook pe-5x pe-va wow fadeInUp"></i>
					<div class="inner">
						<h4>Vessel Track & Trace Service</h4>
						<p>Customer can track and trace Vessel Service in IPC (PT. Pelabuhan Indonesia II).<br>						
						</p>
					</div>
				</div>
			
				<!-- /.feature 2 -->

				<div class="col-sm-6 feat-list">
					<i class="pe-7s-cash pe-5x pe-va wow fadeInUp" data-wow-delay="0.2s"></i>
					<div class="inner">
						<h4>Receiving Container Service</h4>
						<p>Customer can create Receiving Container Service in IPC (PT. Pelabuhan Indonesia II).</p>
					</div>
				</div>
			
				<!-- /.feature 3 -->

				<div class="col-sm-6 feat-list">
					<i class="pe-7s-cart pe-5x pe-va wow fadeInUp" data-wow-delay="0.4s"></i>
					<div class="inner">
						<h4>Delivery Container Service</h4>
						<p>Customer can create Delivery Container Service in IPC (PT. Pelabuhan Indonesia II).</p>
					</div>
				</div>
			
				<!-- /.feature 4 -->

				<div class="col-sm-6 feat-list">
					<i class="pe-7s-users pe-5x pe-va wow fadeInUp" data-wow-delay="0.6s"></i>
					<div class="inner">
						<h4>Loading Cancel Container Service</h4>
						<p>Customer can create Loading Cancel Container Service in IPC (PT. Pelabuhan Indonesia II).</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /.contact section -->
<div id="contact">
	<div class="contact fullscreen parallax" style="background-image:url('<?=CSS2_;?>/images/bg.jpg');" data-img-width="2000" data-img-height="1334" data-diff="100">
		<div class="overlay">
			<div class="container">
				<div class="row contact-row">
				
					<!-- /.address and contact -->
					<div class="col-sm-5 contact-left wow fadeInUp">
						<h2><span class="highlight">Pelabuhan</span> Tanjung Priok</h2>
							<ul class="ul-address">
							<li><i class="pe-7s-map-marker"></i>Jl. Pasoso No.1, Tanjung Priok, Jakarta Utara</br>
							Jakarta 14310
							</li>
							<li><i class="pe-7s-phone"></i>+62-21 4367505</br>
							+62-21 4301080
							</li>
							<li><i class="pe-7s-mail"></i><a href="mailto:info@yoursite.com">corp_sec@indonesiaport.co.id</a></li>
							<li><i class="pe-7s-portfolio"></i><a href="#">http://www.indonesiaport.co.id/</a></li>
							</ul>	
								
					</div>
					<div class="col-sm-5 contact-left wow fadeInUp">
						<h2><span class="highlight">Pelabuhan</span> Panjang</h2>
							<ul class="ul-address">
							<li><i class="pe-7s-map-marker"></i>Jl. Pasoso No.1, Tanjung Priok, Jakarta Utara</br>
							Jakarta 14310
							</li>
							<li><i class="pe-7s-phone"></i>+62-21 4367505</br>
							+62-21 4301080
							</li>
							<li><i class="pe-7s-mail"></i><a href="mailto:info@yoursite.com">corp_sec@indonesiaport.co.id</a></li>
							<li><i class="pe-7s-portfolio"></i><a href="#">http://www.indonesiaport.co.id/</a></li>
							</ul>	
								
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	#thover{
	  position:fixed;
	  background:#000;
	  width:100%;
	  height:100%;
	  opacity: .6
	}
 
#tpopup{
  position:absolute;
  width:180%;
  height:30%;
  background:#fff;
  left:-20%;
  top:20%;
  border-radius:5px;
  padding:20px 0;
  margin-left:-520px; /* width/2 + padding-left */
  margin-top:-150px; /* height/2 + padding-top */
  text-align:center;
  box-shadow:0 0 0px 0 #000;
  z-index: 1000;
}
#tclose{
  position:absolute;
  background:black;
  color:white;
  right:-15px;
  top:-15px;
  border-radius:50%;
  width:30px;
  height:30px;
  line-height:30px;
  text-align:center;
  font-size:8px;
  font-weight:bold;
  font-family:'Arial Black', Arial, sans-serif;
  cursor:pointer;
  box-shadow:0 0 10px 0 #000;
}
</style>

<!-- /.footer -->
<footer id="footer">
	<div class="container">
		<div class="col-sm-4 col-sm-offset-4">
			<!-- /.social links -->
				<div class="social text-center">
					<ul>
						<li><a class="wow fadeInUp" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
						<li><a class="wow fadeInUp" href="https://www.facebook.com/" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
						<li><a class="wow fadeInUp" href="https://plus.google.com/" data-wow-delay="0.4s"><i class="fa fa-google-plus"></i></a></li>
						<li><a class="wow fadeInUp" href="https://instagram.com/" data-wow-delay="0.6s"><i class="fa fa-instagram"></i></a></li>
					</ul>
				</div>	
			<div class="text-center wow fadeInUp" style="font-size: 14px;">Copyright Biro Sistem Informasi 2016 - Template by <a href="http://www.moxdesign.com">MoxDesign</a></div>
			<a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
		</div>	
	</div>	
</footer>
	
	<!-- /.javascript files -->
    <script src="<?=CSS2_;?>js/jquery.js"></script>
    <script src="<?=CSS2_;?>js/bootstrap.min.js"></script>
    <script src="<?=CSS2_;?>js/custom.js"></script>
    <script src="<?=CSS2_;?>js/jquery.sticky.js"></script>
	<script src="<?=CSS2_;?>js/wow.min.js"></script>
	<script src="<?=CSS2_;?>js/owl.carousel.min.js"></script>
	<script>
		new WOW().init();
	</script>

<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
	
	<script>
	$(document).ready(function() {
		$("#thover").click(function(){
			$(this).fadeOut();
	    	$("#tpopup").fadeOut();
		});
	  
	  
	  	$("#tclose").click(function(){
			$("#thover").fadeOut();
	    	$("#tpopup").fadeOut();
		});
		<?php
		if(isset($_GET['msg']))
		{
		?>
		var notification = new NotificationFx({
		message : "<p><?php echo $_GET['msg'];?></p>",
		layout : 'bar',
		effect : 'exploader',
		type : 'warning' // notice, warning, error or success
		});

		// show the notification
		notification.show();
		<?php }?>
		
		$("#security_code").keypress(function(e) {
		  if(e.which == 13) {
			Login("");
		  }
		});		
	});	

	function Login(){
		var sortable = true;
		//alert('test');false;
		if(sortable) 
		{
			$("#login-button").prop("disabled","disabled");
			var url="<?=APP_ROOT?>index.php/main/do_log";
			//alert('<?php echo $this->security->get_csrf_hash(); ?>');
			
			$.post(url,{"username":$("#username").val(), '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',"password":$("#passwordx").val(),"lang":$("#lang").val(),"security_code":$("#security_code").val()},function(data){
				if(data.trim()=="Success"){
					window.location = "<?=APP_ROOT?>index.php/main";
					return false;
				}
				
				/*if(data=="Active"){
					alert("User is active, cannot use concurrent user!");
					//toggleOverlay($("#username").val());
					location.reload(); 
				}*/
				else
				{	
					//alert("wrong username & password");
					alert(data);
					location.reload(); 
					//alert("Login Failed : Invalid username or password. \n(see log for detail).");
					toggleOverlay($("#username").val());
				}
				
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