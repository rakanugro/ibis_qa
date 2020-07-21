<!DOCTYPE html>
<?php header("X-FRAME-OPTIONS: DENY"); ?>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>IPC e-Service</title>
	<link rel="icon" type="image/png" href="<?=CUBE_;?>homepage/images/iconipces.png" />
	
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/bootstrap.min.css" />
	
	<!-- RTL support - for demo only -->
	<script src="<?=CUBE_?>js/demo-rtl.js"></script>
	<!-- 
	If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="css/libs/bootstrap-rtl.min.css" />
	And add "rtl" class to <body> element - e.g. <body class="rtl"> 
	-->
	
	<!-- libraries -->
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/nanoscroller.css" />

	<!-- global styles -->
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/compiled/theme_styles.css" />
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/animate.css" />

	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery-jvectormap.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/weather-icons.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/dataTables.fixedHeader.css">
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/dataTables.tableTools.css">	
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/jquery.nouislider.css">
	<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/jquery-ui.custom_ZATIAL_SA_NEPOUZIVA.css" />

	<!-- global scripts -->
	<script src="<?=CUBE_?>js/jquery.js"></script>

	<script src="<?=CUBE_?>js/jquery.dataTables.js"></script>
	<script src="<?=CUBE_?>js/dataTables.fixedHeader.js"></script>
	<script src="<?=CUBE_?>js/dataTables.tableTools.js"></script>
	<script src="<?=CUBE_?>js/jquery.dataTables.bootstrap.js"></script>
	
	<script src="<?=CUBE_?>js/jquery-ui.custom.js"></script>
	<script src="<?=CUBE_?>js/bootstrap.js"></script>

	<script src="<?=CUBE_?>js/demo.js"></script> <!-- only for demo -->
	<!--<script src="<?=CUBE_?>js/demo-skin-changer.js"></script> <!-- only for demo -->
	<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>

	<script src="<?=CUBE_?>js/jquery.blockUI.min.js"></script>	
	<script src="<?=CUBE_?>js/jquery.fullscreen-popup.min.js"></script>	
	
	<script>
		//custom blockUI style for ibis
		$.blockUI.defaults.message = '<h2><img style="height:30px; width:auto;" src="<?=CUBE_?>img/loading-black.gif"></img> Please wait...</h2>';
		
		$.blockUI.defaults.css = { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
			color: '#fff' ,
			margin:		0,
			width:		'30%',
			top:		'40%',
			left:		'35%',
			textAlign:	'center',
			cursor:		'wait'			
        }
	</script>
	<script src="<?=CUBE_?>js/bootstrap-notify.min.js"></script>	
	<script>
		$.notifyDefaults({
			//allow_dismiss: false,
			//delay : 0,
			//showProgressbar : true,
			template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
							'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">x</button>' +
							'<i data-notify="icon"></i> ' +
							'<span data-notify="title"><strong>{1}</strong></span> ' +
							'<span data-notify="message">{2}</span>' +
							'<div class="progress" data-notify="progressbar">' +
								'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
							'</div>' +
							'<a href="{3}" target="{4}" data-notify="url"></a>' +
						'</div>' 
		});
	</script>
	
	<!-- this page specific scripts -->
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?=CUBE_?>js/flot/excanvas.min.js"></script><![endif]-->
	<script src="<?=CUBE_?>js/flot/jquery.flot.js"></script>
	<script src="<?=CUBE_?>js/flot/jquery.flot.min.js"></script>
	<script src="<?=CUBE_?>js/flot/jquery.flot.pie.min.js"></script>
	<script src="<?=CUBE_?>js/flot/jquery.flot.stack.min.js"></script>
	<script src="<?=CUBE_?>js/flot/jquery.flot.resize.min.js"></script>
	<script src="<?=CUBE_?>js/flot/jquery.flot.time.min.js"></script>
	<script src="<?=CUBE_?>js/flot/jquery.flot.orderBars.js"></script>	
	<script src="<?=CUBE_?>js/flot/jquery.flot.threshold.js"></script>
	<script src="<?=CUBE_?>js/flot/jquery.flot.axislabels.js"></script>
	<script src="<?=CUBE_?>js/moment.min.js"></script>
	<script src="<?=CUBE_?>js/jquery-jvectormap.js"></script>
	<script src="<?=CUBE_?>js/jquery-jvectormap-world-merc-en.js"></script>
	<script src="<?=CUBE_?>js/gdp-data.js"></script>
	<script src="<?=CUBE_?>js/jquery.sparkline.min.js"></script>
	<script src="<?=CUBE_?>js/skycons.js"></script>
	
	<script src="<?=CUBE_?>js/jquery.maskedinput.min.js"></script>
	<script src="<?=CUBE_?>js/bootstrap-datepicker.js"></script>
	<script src="<?=CUBE_?>js/daterangepicker.js"></script>
	<script src="<?=CUBE_?>js/bootstrap-timepicker.min.js"></script>
	<script src="<?=CUBE_?>js/select2.min.js"></script>
	<script src="<?=CUBE_?>js/jquery.pwstrength.js"></script>	
		
	<!-- theme scripts -->
	<script src="<?=CUBE_?>js/scripts.js"></script>
	<script src="<?=CUBE_?>js/pace.min.js"></script>
	
	<!-- highchart -->
	<script src="<?=CUBE_?>js/highcharts.js"></script>
	<script src="<?=CUBE_?>js/highcharts-more.js"></script>
	<script src="<?=CUBE_?>js/exporting.js"></script>
	
	<!-- WEB-->
	<script src="<?=CUBE_?>js/date-dd-MMM-yyyy.js"></script>
	<script src="<?=CUBE_?>js/date-euro.js"></script>
	
	<!-- Favicon -->
	<link type="image/x-icon" href="favicon.png" rel="shortcut icon" />

	<!-- google font libraries -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
	
	
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<!-- END OF TEMPLATE HEADER -->