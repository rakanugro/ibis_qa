<!DOCTYPE HTML>
<?php header("X-FRAME-OPTIONS: DENY"); ?>
<html>
<head>
<style>
div#overlays {display: none;z-index: 6;background: #000;position: fixed;width: 100%;height: 100%;top: 0px;left: 0px;text-align: center;}div#specialBoxs {display: none;position: relative;z-index: 7;}
</style>
<title>ipc e-service</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="icon" type="image/png" href="<?=CUBE_;?>homepage/images/ipclog.png" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?=CUBE_;?>homepage/js/skel.min.js"></script>
<!--do not enaabled <script src="js/skel-panels.min.js"></script>-->
<script src="<?=CUBE_;?>homepage/js/init.js"></script>
<link rel="stylesheet" href="<?=CUBE_;?>homepage/css/skel-noscript.css" />
<link rel="stylesheet" href="<?=CUBE_;?>homepage/css/style.css" />
<link rel="stylesheet" href="<?=CUBE_;?>homepage/css/style-desktop.css" />
<!--slides-->
<link rel="stylesheet" type="text/css" href="<?=CUBE_;?>homepage/slides/css/component.css" />
<script src="<?=CUBE_;?>homepage/slides/js/modernizr.custom.js"></script>
<!--captcha-->
<script type="text/javascript" src="<?=CUBE_;?>homepage/captcha/jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?=CUBE_;?>homepage/captcha/ui.core.js"></script>
<script type="text/javascript" src="<?=CUBE_;?>homepage/captcha/ui.sortable.js"></script>
<!--captcha-->
<link rel="stylesheet" href="<?=CUBE_;?>homepage/login/css/style.css">
<script>
function toggleOverlay(username=""){
	var overlay = document.getElementById('overlays');
	var specialBox = document.getElementById('specialBoxs');overlay.style.opacity = .5;
	//if(overlay.style.display == "block"){
		//overlay.style.display = "none";$('#specialBoxs').fadeOut('normal');specialBox.style.display = "none";
		//} 
	//else {
		overlay.style.display = "block";specialBox.style.opacity = "0.9";
		$('#specialBoxs').load("<?=APP_ROOT?>index.php/main/login_view/"+username).fadeIn('normal');specialBox.style.display = "block";
		//}
	}
function cancelOverlay()	
{
	var overlay = document.getElementById('overlays');
	var specialBox = document.getElementById('specialBoxs');
	overlay.style.display = "none";$('#specialBoxs').fadeOut('normal');specialBox.style.display = "none";
}
</script>
<!--slides-->
</head>
<body class="homepage">
<!-- Header -->
<div id="header">
<div class="container">
<!--sign in-->
<div id="overlays"></div>
<div id="specialBoxs"></div>
<!--sign in-->
<!--navigasi-->
<div id="nav-wrapper"> 
<!-- Nav -->
<nav id="nav">
<ul>
<li class="active"><a href="index.html">Homepage</a></li>
<li><a href="left-sidebar.html">About Us</a></li>
<li><a href="right-sidebar.html">Help</a></li>
<li><a href="#" onclick="toggleOverlay()">Sign in</a></li>
</ul>
</nav>
</div>
<!--navigasi-->
<div id="boxgallery" class="boxgallery" data-effect="effect-1">
<div class="panel"><img src="<?=CUBE_;?>homepage/images/header.jpg" alt="Image 1"/></div>
<div class="panel"><img src="<?=CUBE_;?>homepage/images/header4.jpg" alt="Image 2"/></div>
<div class="panel"><img src="<?=CUBE_;?>homepage/images/header1.jpg" alt="Image 3"/></div>
<div class="panel"><img src="<?=CUBE_;?>homepage/images/header413.jpg" alt="Image 4"/></div>
</div>
<div class="container"> 
<!-- Logo -->
<div id="logo">
<img src="<?=CUBE_;?>homepage/images/ipc.png"></img>
</div>
</div>
</div>
</div>
<!-- Featured -->
<div id="featured">
<div class="container">
<header>
<h2>Welcome to <strong>ipc e-service</strong> </h2>
</header>
<p>This is <strong>ipc e-service</strong>, an application that helps you to finish your request of port service that contains of container service (receiving, delivery, loading cancel,etc) & vessel service  </p>
<hr />
<div class="row">
<section class="4u">
<span class="pennant"><span class="fa fa-briefcase"></span></span>
<h3><strong>Services</strong></h3>
<p><strong>ipc e-service</strong> has two main services</p>
<p>1. Container Services<br/>
2. Vessel Services
</p>
<a href="#" class="button button-style1">Read More</a>
</section>
<section class="4u">
<span class="pennant"><span class="fa fa-lock"></span></span>
<h3><strong>Security</strong>'</h3>
<p><strong>ipc e-service</strong> proven on payment security issue. We use clickpay & smartpay to link our onesign payment. Beside that, we connect to <strong>all channel electronic payment such as edc payment, internet banking, & atm.</strong> </p>
<a href="#" class="button button-style1">Read More</a>
</section>
<section class="4u">
<span class="pennant"><span class="fa fa-globe"></span></span>
<h3><strong>Connection</strong></h3>
<p><strong>ipc e-service</strong> consist of some application that <strong>connect to IPC subsidiary & branches application services</strong>. Specially for container service ipc e-service consist of container services on five main container terminal in IPC. </p>
<a href="#" class="button button-style1">Read More</a>
</section>
</div>
</div>
</div>
<!-- Main -->
<div id="main">
<div id="content" class="container">
<div class="row">
<section class="6u">
<img src="<?=CUBE_;?>homepage/images/pic01.png" alt=""></img>
<header>
<h2><strong>Payment Channel</strong></h2>
</header>
<p>Payment Channel are ATM/EDC, Internet Banking, & Mandiri Clickpay</p>
</section>				
<section class="6u">
<img src="<?=CUBE_;?>homepage/images/pic02.png" alt=""></img>
<header>
<h2><strong>Partner</strong></h2>
</header>
<p>Partner are Mandiri Bank, ILCS, & Maersk Line.</p>
</section>				
</div>			
</div>
</div>

<!-- Footer -->
<div id="footer">
<div class="container">
<section>
<header>
<img src="<?=CUBE_;?>homepage/images/ipc.png"></img>
<h2>Get in touch to ipc e-service</h2>
<span class="byline">Feel the Service</span>
</header>
<ul class="contact">
<li><a href="#" class="fa fa-twitter"><span>Twitter</span></a></li>
<li class="active"><a href="#" class="fa fa-facebook"><span>Facebook</span></a></li>
<li><a href="#" class="fa fa-dribbble"><span>Pinterest</span></a></li>
<li><a href="#" class="fa fa-tumblr"><span>Google+</span></a></li>
</ul>
</section>
</div>
</div>
<!-- Copyright -->
<div id="copyright">
<div class="container">
Design: <a href="#">Information System Bureau</a> Copyright <a href="#">ipc_bsi@2015</a>
</div>
</div>
</body>
<script src="<?=CUBE_;?>homepage/slides/js/boxesFx.js"></script>
<script src="<?=CUBE_;?>homepage/slides/js/classie.js"></script>
<script>
new BoxesFx( document.getElementById( 'boxgallery' ) );
</script>
</html>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<script src="<?=CUBE_;?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_;?>js/classie.js"></script>
<script src="<?=CUBE_;?>js/notificationFx.js"></script>
<?php
if(isset($_GET["msg"]))
{
?>
<script>var notification = new NotificationFx(
	{
		message : '<p><?php echo isset($_GET["msg"]) ? $_GET["msg"] : ""?></p>',
		layout : 'bar',effect : 'exploader',
		type : 'success' // notice, warning, error or success});
	});
// show the notification
notification.show();
</script>
<?php }?>