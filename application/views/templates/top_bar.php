<?php if($this->session->userdata('invoice')) { ?>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>

<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<script>
	var count_response;
	var count_response_ticket;

	function get_count_new_approval2()
	{
		$.ajaxSetup({
			timeout: 61000
		});

		var url = "<?=ROOT?>approval_request/get_count_new_approval";
		$("#totap").load(url, function( response, status, xhr ) {
			if (status=="error")
			{
				//alert("Network Error!!");
			}
			else if(response=="sessionkill")
			{
				alert("Login anda telah berakhir silahkan login kembali");
				window.location = "<?=ROOT?>main/logout";
			}
			//alert(response);
			//alert(count_response);
			if(response>count_response)
			{
				$('#buzzer').get(0).play();
			}

			count_response = response;

			//var_dump(xhr);
		});
		//$("#totap2").load(url);
	}

	function get_count_new_approval()
	{
		var url = "<?=ROOT;?>approval_request/get_count_new_approval";
		$.get(url,function(data,status){
			$("#totap").html(data);
		});
	}

	function get_count_new_ticket()
	{
		var url = "<?=ROOT;?>customer/get_count_new_ticket";
		$.get(url,function(data,status){
			$("#totap2").html(data);
		});
		// alert("a");
	}

	function change_warning()
	{
		/*if($("#fabel").hasClass("red"))
		{
			$("#fabel").removeClass("red")
		}
		else
		{
			$("#fabel").addClass("red")
		}*/

		if($("#count").hasClass("red"))
		{
			$("#count").removeClass("red");
		}
		else
		{
			$("#count").addClass("red");
		}
	}

	$(function(){
		<?php if($this->session->userdata('group_phd')==="1" or $this->session->userdata('group_phd')==="c"){?>
			get_count_new_approval();
		<?php }?>
		<?php if($this->session->userdata('group_phd')==="p" or $this->session->userdata('group_phd')==="8"){?>
			get_count_new_ticket();
		<?php }?>
	});

	$( document ).ready(function() {
		<?php if($this->session->userdata('group_phd')==="1" or $this->session->userdata('group_phd')==="c"){?>
			setInterval(function(){
				get_count_new_approval();
			}, 62000);
		<?php }?>

		<?php if($this->session->userdata('group_phd')==="p" or $this->session->userdata('group_phd')==="8"){?>
			setInterval(function(){
				get_count_new_ticket();
			}, 62000);
		<?php }?>
		var url = "<?=ROOT?>customer/check_customer_id";
        $.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
			function(data){
				if(data!=""){
					var notification = new NotificationFx({
						message : "<p>"+data+"</p>",
						layout : 'bar',
						effect : 'exploader',
						type : 'warning' // notice, warning, error or success
					});

					// show the notification
					notification.show();
				}
			});

	});
</script>
<script>
	var IDLE_TIMEOUT =3000000;
	var _idleSecondsCounter = 0;
	document.onclick = function() {
		_idleSecondsCounter = 0;
	};
	document.onmousemove = function() {
		_idleSecondsCounter = 0;
	};
	document.onkeypress = function() {
		_idleSecondsCounter = 0;
	};
	window.setInterval(CheckIdleTime, 1000);

	function CheckIdleTime() {
		_idleSecondsCounter++;
		var oPanel = document.getElementById("SecondsUntilExpire");
		if (oPanel)
			oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
		if (_idleSecondsCounter >= IDLE_TIMEOUT) {
			//alert("Time expired!");
			document.location.href = "<?=ROOT?>main/logout";
		}
	}

</script>
<!-- START OF TOP BAR EINVOICE -->
<?php
$role_id =  $this->session->userdata('role_id')	;
//remark by Derry 17 Nov 2019: variable $user_role tidak digunakan dinamapun
//$user_role = $this->auth_model->get_lastrole($role_id);
$unit_code = $this->auth_model->get_filter_role($role_id);
?>
	<div id="theme-wrapper">
		<header class="navbar" id="header-navbar">
			<div class="container">
				<a href="<?=ROOT?>" id="logo" class="navbar-brand">
					<img src="<?=CUBE_?>img/logo.png" alt="" class="normal-logo logo-white"/>
					<img src="<?=CUBE_?>img/logo-black.png" alt="" class="normal-logo logo-black"/>
					<img src="<?=CUBE_?>img/logo-small.png" alt="" class="small-logo hidden-xs hidden-sm hidden"/>
				</a>

				<div class="clearfix">
				<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>

				<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
					<ul class="nav navbar-nav pull-left">
						<li>
							<a class="btn" id="make-small-nav">
								<i class="fa fa-bars"></i>
							</a>
						</li>
						<?php if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="c"){?>
						<audio id="buzzer" src="<?php echo FILE_;?>notif.wav" type="audio/wav"></audio>
						<li id="notif_counter" class="dropdown hidden-xs">
							<a class="btn dropdown-toggle" data-toggle="dropdown">
								<i id="fabel" class="fa fa-bell"></i>
								<span id="count" class="count"><div id="totap" class="total_cls"></div><div id="totap2" class="total_cls"></div></span>
							</a>
							<ul class="dropdown-menu notifications-list">
								<li class="pointer">
									<div class="pointer-inner">
										<div class="arrow"></div>
									</div>
								</li>
								<li class="item-header">You have <span id="totap2"></span> new pending request</li>
								<li class="item-footer">
									<a href="<?php echo ROOT?>approval_request/new_main_approval">
										View all request
									</a>
								</li>
							</ul>
						</li>
						<?php }?>
						<?php if($this->session->userdata('group_phd')=="p" or $this->session->userdata('group_phd')=="8"){?>
						<audio id="buzzer_ticket" src="<?php echo FILE_;?>notif.wav" type="audio/wav"></audio>
						<li id="notif_counter" class="dropdown hidden-xs">
							<a class="btn dropdown-toggle" data-toggle="dropdown">
								<i id="fabel" class="fa fa-bell"></i>
								<span id="count" class="count"><div id="totticket" class="total_cls"></div><div id="totap2" class="total_cls"></div></span>
							</a>
							<ul class="dropdown-menu notifications-list">
								<li class="pointer">
									<div class="pointer-inner">
										<div class="arrow"></div>
									</div>
								</li>
								<li class="item-header">You have <span id="totap2"></span> new pending ticket</li>
								<li class="item-footer">
									<a href="<?php echo ROOT?>customer/index/opennpending">
										View all ticket
									</a>
								</li>
							</ul>
						</li>
						<?php }?>
						<li class="dropdown hidden-xs">
							<?php if($this->session->userdata('lang_phd')=='ID'){ ?>
								<a class="btn dropdown-toggle" data-toggle="dropdown">
								Indonesia
								<i class="fa fa-caret-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li class="item">
										<a href="<?=ROOT?>main/change_lang/EN">
											English
										</a>
									</li>
								</ul>
							<?php }else { ?>
								<a class="btn dropdown-toggle" data-toggle="dropdown">
								English
								<i class="fa fa-caret-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li class="item">
										<a href="<?=ROOT?>main/change_lang/ID">
											Indonesia
										</a>
									</li>
								</ul>
							<?php } ?>
						</li>
					</ul>
				</div>

				<div class="nav-no-collapse pull-right" id="header-nav">
					<ul class="nav navbar-nav pull-right">
						<li class="dropdown profile-dropdown">
							<a href="<?php echo ROOT."einvoice/profil"?>" class="dropdown-toggle" >
								<img src="<?=CUBE_?>img/profile_picture.png" alt=""/>
								<span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></b></span>
							</a>
						</li>
						<li class="dropdown profile-dropdown">
							<a href="<?php echo ROOT."va/transaction/cart"?>" class="dropdown-toggle" >
								<img src="<?php echo APP_ROOT;?>assets/images/goods.png" alt=""/>
								<span class="hidden-xs">My Cart</b></span>
							</a>
						</li>
						<li class="hidden-xxs " >
							<a style="font-size: 17px;">ROLE</a>
						</li>

						<li class="hidden-xxs " >
							<select class="form-control select2"  name="role_user" id="role_user" style="width: 100%; margin-top: 8px;">
								<?php foreach ($role_child as $key => $value) { ?>
								<option value="<?php echo $value->INV_ROLE_ID ?>"<?=$value->INV_ROLE_ID == $this->session->userdata('role_id') ? ' selected="selected"' : '';?> ><?php echo $value->INV_ROLE_NAME ?></option>
								<?php } ?>

							</select>

						</li>

						<li class="hidden-xxs "  style="padding-left: 10px;">
							<a style="font-size: 17px;">UNIT</a>
						</li>

						<li class="hidden-xxs " >
							<select class="form-control select2"  name="unit_role" id="unit_role" style="width: 100%; margin-top: 8px;">
								<?php if (count($unit_code) == 1) {?>
									<option value="<?php echo $value->INV_UNIT_CODE ?>"><?php echo $layanan->INV_UNIT_NAME;?></option>
								<?php } else {?>
									<option value="ALL_UNIT"<?= "ALL_UNIT" == $this->session->userdata('unit_id_val') ? ' selected="selected"' : '';?> >ALL UNIT</option>
								<?php foreach ($unit_code as $key => $value) { ?>
								<option value="<?php echo $value->INV_CODE_ORGID ?>" <?=$value->INV_CODE_ORGID == $this->session->userdata('unit_id_val') ? ' selected="selected"' : '';?> ><?php echo $value->INV_UNIT_NAME_DISP ?></option>
								<?php } ?>
								<?php } ?>
							</select>

						</li>
						<li class="hidden-xxs">
							<a class="btn" onclick="logout()">
								<i class="fa fa-power-off"></i>
							</a>
						</li>
					</ul>
				</div>
				</div>
			</div>
		</header>

		<div id="page-wrapper" class="container">
			<div class="row">
<!-- END OF TOP BAR EINVOICE-->

<?php } else { ?>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<!-- <link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
 --><link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>

<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<script>
	var count_response;
	var count_response_ticket;

	function get_count_new_approval2()
	{
		$.ajaxSetup({
			timeout: 61000
		});

		var url = "<?=ROOT?>approval_request/get_count_new_approval";
		$("#totap").load(url, function( response, status, xhr ) {
			if (status=="error")
			{
				//alert("Network Error!!");
			}
			else if(response=="sessionkill")
			{
				alert("Login anda telah berakhir silahkan login kembali");
				window.location = "<?=ROOT?>main/logout";
			}
			//alert(response);
			//alert(count_response);
			if(response>count_response)
			{
				$('#buzzer').get(0).play();
			}

			count_response = response;

			//var_dump(xhr);
		});
		//$("#totap2").load(url);
	}

	function get_count_new_approval()
	{
		var url = "<?=ROOT;?>approval_request/get_count_new_approval";
		$.get(url,function(data,status){
			$("#totap").html(data);
		});
	}

	function get_count_new_ticket()
	{
		var url = "<?=ROOT;?>customer/get_count_new_ticket";
		$.get(url,function(data,status){
			$("#totap2").html(data);
		});

	}

	function change_warning()
	{

		if($("#count").hasClass("red"))
		{
			$("#count").removeClass("red");
		}
		else
		{
			$("#count").addClass("red");
		}
	}

	$(function(){
		setInterval(function(){
			<?php if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="c"){?>
				get_count_new_approval();
			<?php }?>
			<?php if($this->session->userdata('group_phd')=="p" or $this->session->userdata('group_phd')=="8"){?>
				get_count_new_ticket();
			<?php }?>
		}, 62000);

		<?php if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="c"){?>
			get_count_new_approval();
		<?php }?>
		<?php if($this->session->userdata('group_phd')=="p" or $this->session->userdata('group_phd')=="8"){?>
			get_count_new_ticket();
		<?php }?>
	});

	$( document ).ready(function() {

		<?php if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="c"){?>
			setInterval(function(){
				get_count_new_approval();
			}, 62000);
		<?php }?>

		<?php if($this->session->userdata('group_phd')=="p" or $this->session->userdata('group_phd')=="8"){?>
			setInterval(function(){
				get_count_new_ticket();
			}, 62000);
		<?php }?>

		var url = "<?=ROOT?>customer/check_customer_id";
        $.post(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
			function(data){
				if(data!=""){
					var notification = new NotificationFx({
						message : "<p>"+data+"</p>",
						layout : 'bar',
						effect : 'exploader',
						type : 'warning' // notice, warning, error or success
					});

					// show the notification
					notification.show();
				}
			});

	});
</script>
<script>

	// ap 13


	var IDLE_TIMEOUT =3000000;
	var _idleSecondsCounter = 0;
	document.onclick = function() {
		_idleSecondsCounter = 0;
	};
	document.onmousemove = function() {
		_idleSecondsCounter = 0;
	};
	document.onkeypress = function() {
		_idleSecondsCounter = 0;
	};
	window.setInterval(CheckIdleTime, 1000);

	function CheckIdleTime() {
		_idleSecondsCounter++;
		var oPanel = document.getElementById("SecondsUntilExpire");
		if (oPanel)
			oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
		if (_idleSecondsCounter >= IDLE_TIMEOUT) {
			//alert("Time expired!");
			document.location.href = "<?=ROOT?>main/logout";
		}
	}

</script>
<!-- START OF TOP BAR ESERVICE -->
	<div id="theme-wrapper">
		<header class="navbar" id="header-navbar">
			<div class="container">
				<a href="<?=ROOT?>" id="logo" class="navbar-brand">
					<img src="<?=CUBE_?>img/logo.png" alt="" class="normal-logo logo-white"/>
					<img src="<?=CUBE_?>img/logo-black.png" alt="" class="normal-logo logo-black"/>
					<img src="<?=CUBE_?>img/logo-small.png" alt="" class="small-logo hidden-xs hidden-sm hidden"/>
				</a>

				<div class="clearfix">
				<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>

				<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
					<ul class="nav navbar-nav pull-left">
						<li>
							<a class="btn" id="make-small-nav">
								<i class="fa fa-bars"></i>
							</a>
						</li>
						<?php if($this->session->userdata('group_phd')=="1" or $this->session->userdata('group_phd')=="c"){?>
						<audio id="buzzer" src="<?php echo FILE_;?>notif.wav" type="audio/wav"></audio>
						<li id="notif_counter" class="dropdown hidden-xs">
							<a class="btn dropdown-toggle" data-toggle="dropdown">
								<i id="fabel" class="fa fa-bell"></i>
								<span id="count" class="count"><div id="totap" class="total_cls"></div><div id="totap2" class="totap2"></div></span>
							</a>
							<ul class="dropdown-menu notifications-list">
								<li class="pointer">
									<div class="pointer-inner">
										<div class="arrow"></div>
									</div>
								</li>
								<li class="item-header">You have <span id="totap2"></span> new pending request</li>
								<li class="item-footer">
									<a href="<?php echo ROOT?>approval_request/new_main_approval">
										View all request
									</a>
								</li>
							</ul>
						</li>
						<?php }?>
						<?php if($this->session->userdata('group_phd')=="p" or $this->session->userdata('group_phd')=="8"){?>
						<audio id="buzzer_ticket" src="<?php echo FILE_;?>notif.wav" type="audio/wav"></audio>
						<li id="notif_counter" class="dropdown hidden-xs">
							<a class="btn dropdown-toggle" data-toggle="dropdown">
								<i id="fabel" class="fa fa-bell"></i>
								<span id="count" class="count"><div id="totticket" class="total_cls"></div><div id="totap2" class="total_cls totap2"></div></span>
							</a>
							<ul class="dropdown-menu notifications-list">
								<li class="pointer">
									<div class="pointer-inner">
										<div class="arrow"></div>
									</div>
								</li>
								<li class="item-header">You have <span class="totap2"></span> new pending ticket</li>
								<li class="item-footer">
									<a href="<?php echo ROOT?>customer/index/opennpending">
										View all ticket
									</a>
								</li>
							</ul>
						</li>
						<?php }?>
						<li class="dropdown hidden-xs">
							<?php if($this->session->userdata('lang_phd')=='ID'){ ?>
								<a class="btn dropdown-toggle" data-toggle="dropdown">
								Indonesia
								<i class="fa fa-caret-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li class="item">
										<a href="<?=ROOT?>main/change_lang/EN">
											English
										</a>
									</li>
								</ul>
							<?php }else { ?>
								<a class="btn dropdown-toggle" data-toggle="dropdown">
								English
								<i class="fa fa-caret-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li class="item">
										<a href="<?=ROOT?>main/change_lang/ID">
											Indonesia
										</a>
									</li>
								</ul>
							<?php } ?>
						</li>
					</ul>
				</div>

				<div class="nav-no-collapse pull-right" id="header-nav">
					<ul class="nav navbar-nav pull-right">
						<li class="dropdown profile-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span class="hidden-xs"><?=$this->session->userdata('customername_phd') ?></span> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?=ROOT?>customer/my_profile"><i class="fa fa-user"></i>Set Another Customer</a></li>
							</ul>
						</li>
						<li class="dropdown profile-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?=CUBE_?>img/profile_picture.png" alt=""/>
								<span class="hidden-xs"><?=$this->session->userdata('name_phd') ?></span> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?=ROOT?>customer/my_profile"><i class="fa fa-user"></i>Profile</a></li>

								<li><a href="<?=ROOT?>main/logout"><i class="fa fa-power-off"></i>Logout</a></li>
							</ul>
						</li>
						<li class="hidden-xxs">
							<!--<a class="btn" href="<?=ROOT?>main/logout">-->
							<a href="<?=ROOT?>main/logout"><i class="fa fa-power-off"></i>Logout</a>
						</li>
					</ul>
				</div>
				</div>
			</div>
		</header>
		<div id="page-wrapper" class="container">
			<div class="row">
<!-- END OF TOP BAR ESERVICE-->

<?php } ?>
