<script>
<?php
log_message('debug','----------------------------main.php------------------------------------');
if($this->session->userdata('custid_phd')){?>
function load_dashboard_billing_data()
{
	$.ajaxSetup({
		type: 'POST',
		timeout: 9000,
		error: function(xhr) {
        }
    })

	var url = "<?=ROOT?>/mainpage/get_billing_summary";
	$.post(url,{}, function(data){
		//alert(data);
		var obj = jQuery.parseJSON( data );
		$("#tot_order_all").text(obj.TOT_ORDER_ALL);
		$("#tot_order_draft").text(obj.TOT_ORDER_DRAFT);
		$("#tot_order_reject").text(obj.TOT_ORDER_REJECT);
		$("#tot_order_wait").text(obj.TOT_ORDER_WAIT);
		$("#tot_order_save").text(obj.TOT_ORDER_SAVE);
		$("#tot_order_paid").text(obj.TOT_ORDER_PAID);
	});
}

$( document ).ready(function() {
	var intervalID = setInterval(function(){load_dashboard_billing_data();}, 10000);

	$('#draft_button').on('click', function(){
		window.location.href = "<?php echo ROOT."container/billing_management/draft"?>";
	});

	$('#reject_button').on('click', function(){
		window.location.href = "<?php echo ROOT."container/billing_management/reject"?>";
	});

	$('#waiting_button').on('click', function(){
		window.location.href = "<?php echo ROOT."container/billing_management/waiting"?>";
	});

	$('#notpaid_button').on('click', function(){
		window.location.href = "<?php echo ROOT."container/payment/not paid"?>";
	});

	$('#complete_button').on('click', function(){
		window.location.href = "<?php echo ROOT."container/billing_management/paid"?>";
	});
});
<?php }?>

</script>
<style>
	.linkbutton:hover{
		cursor: pointer;
	}
    div.DTTT.btn-group{
        display:none !important;
    }

    .rax {
    	position: absolute;
    	font-size: 100px;
    	text-align: center;
    	opacity: .15;
    	text-shadow: 3px 7px rgba(0,0,0,.25);
    	margin-left: 15px;
    	right: 15px;
    }

    .emerald-bg {
    background: #34babb!important;
    background: -moz-linear-gradient(-45deg,rgba(52,186,187,1) 0,rgba(0,172,172,1) 100%)!important;
    background: -webkit-linear-gradient(-45deg,rgba(52,186,187,1) 0,rgba(0,172,172,1) 100%)!important;
    background: linear-gradient(135deg,rgba(52,186,187,1) 0,rgba(0,172,172,1) 100%)!important;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#34babb', endColorstr='#00acac', GradientType=1 )!important;
    }

    .green-bg {
    background: -moz-linear-gradient(-45deg,rgba(81,136,218,1) 0,rgba(52,135,226,1) 100%)!important;
    background: -webkit-linear-gradient(-45deg,rgba(81,136,218,1) 0,rgba(52,135,226,1) 100%)!important;
    background: linear-gradient(135deg,rgba(81,136,218,1) 0,rgba(52,135,226,1) 100%)!important;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5188da', endColorstr='#3487e2', GradientType=1 )!important;
    }

    .red-bg {
    background: #8457f3!important;
    background: -moz-linear-gradient(-45deg,rgba(132,87,243,1) 0,rgba(114,124,182,1) 100%)!important;
    background: -webkit-linear-gradient(-45deg,rgba(132,87,243,1) 0,rgba(114,124,182,1) 100%)!important;
    background: linear-gradient(135deg,rgba(132,87,243,1) 0,rgba(114,124,182,1) 100%)!important;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8457f3', endColorstr='#727cb6', GradientType=1 )!important;
    }

    .bg-gradient-black {
    background: #586169!important;
    background: -moz-linear-gradient(-45deg,rgba(88,97,105,1) 0,rgba(45,53,60,1) 100%)!important;
    background: -webkit-linear-gradient(-45deg,rgba(88,97,105,1) 0,rgba(45,53,60,1) 100%)!important;
    background: linear-gradient(135deg,rgba(88,97,105,1) 0,rgba(45,53,60,1) 100%)!important;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#586169', endColorstr='#2d353c', GradientType=1 )!important;
    }

    .bg-lime {
        background: #ff39b8 !important;
        background: -moz-linear-gradient(-45deg, rgb(255, 57, 184) 0,rgba(45,53,60,1) 100%)!important;
        background: -webkit-linear-gradient(-45deg, rgb(255, 57, 184) 0,rgba(45,53,60,1) 100%)!important;
        background: linear-gradient(135deg, rgb(255, 57, 184) 0,rgba(45,53,60,1) 100%)!important;
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#586169', endColorstr='#2d353c', GradientType=1 )!important;
    }

    .stats-title {
    color: #fff;
    color: rgba(255,255,255,.7);
    position: relative;
    margin: 0 0 2px;
    font-size: 18px;
    }

    .small-graph-box .progress {
    background: #000000;
    }
</style>

			<div id="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12">
								<div id="content-header" class="clearfix">
									<div class="pull-left">
										<ol class="breadcrumb">
											<li><a href="#">Home</a></li>
											<li class="active"><span>Dashboard</span></li>
										</ol>

										<h1>Dashboard</h1>
									</div>


									<?php if($this->session->userdata('custid_phd')){?>
									<div class="pull-right hidden-xs">
										<div class="xs-graph pull-right">
											<div class="graph-label">
												<a href="<?php echo ROOT."container/billing_management"?>"><b><i class="fa fa-shopping-cart"></i> <span id="tot_order_all"><?=$tot_order_all?></span></b> Orders</a>
												<br>
												<?=$customer_name?>
											</div>
											<!--<div class="graph-content spark-orders"></div>-->
										</div>
										<!--<div class="xs-graph pull-left mrg-l-lg mrg-r-sm">
											<div class="graph-label">
												<b>&dollar;12.338</b> Revenues
											</div>
											<div class="graph-content spark-revenues"></div>
										</div>-->
									</div>
									<?php }?>
								</div>
							</div>
						</div>

						.: WELCOME,<b>

						<?php echo $this->session->userdata('username'); ?></b> :.

						<br>
	<!-- 					: WELCOME,<b>

						<?php echo $this->session->userdata('username'); ?></b>
						<?php echo $this->session->userdata('user_id'); ?></b>
						<br/>
						: ROLE ID USED IS <b><?php echo $this->session->userdata('role_id'); ?></b>
						<br>
						: ROLE TYPE IS <b><?php echo $this->session->userdata('role_type'); ?></b>
						<br>

						: UNIT USED IS <b><?php echo $this->session->userdata('unit_id'); ?></b>
						<br>

						: UNIT ORG IS <b><?php echo $this->session->userdata('unit_org'); ?></b>
						<br> -->

						<span class="text_help"></span>

						<?php if($this->session->userdata('custid_phd')){?>
						<div class="row">
							<div class="col-lg-3 col-sm-6 col-xs-12">
								<div id='draft_button' class="main-box infographic-box colored emerald-bg linkbutton">
									<i class="fa fa-envelope"></i>
									<span class="headline">Draft</span>
									<span class="value" id="tot_order_draft"><?=$tot_order_draft?></span>
								</div>
							</div>

							<div class="col-lg-3 col-sm-6 col-xs-12">
								<div id='reject_button' class="main-box infographic-box colored red-bg linkbutton">
									<i class="fa fa-user"></i>
									<span class="headline">Reject</span>
									<span class="value" id="tot_order_reject"><?=$tot_order_reject?></span>
								</div>
							</div>

							<div class="col-lg-3 col-sm-6 col-xs-12">
								<div id='waiting_button' class="main-box infographic-box colored yellow-bg linkbutton">
									<i class="fa fa-user"></i>
									<span class="headline">Waiting Approve</span>
									<span class="value" id="tot_order_wait"><?=$tot_order_wait?></span>
								</div>
							</div>

							<div class="col-lg-3 col-sm-6 col-xs-12">
								<div id='notpaid_button' class="main-box infographic-box colored yellow-bg linkbutton">
									<i class="fa fa-bank"></i>
									<span class="headline">Approved/Not Paid</span>
									<span class="value" id="tot_order_save"><?=$tot_order_save?></span>
								</div>
							</div>

							<div class="col-lg-3 col-sm-6 col-xs-12">
								<div id='complete_button' class="main-box infographic-box colored green-bg linkbutton">
									<i class="fa fa-globe"></i>
									<span class="headline">Complete Order</span>
									<span class="value" id="tot_order_paid"><?=$tot_order_paid?></span>
								</div>
							</div>
							<?php }?>
						</div>
						<!-- <div class="row"> -->
							<?php if($this->session->userdata('invoice')) { ?>
								<?php 
									$role_id =  $this->session->userdata('role_id');
									$auth_service = $this->auth_model->get_layanan($role_id); 
								?>
								<?php if($auth_service->INV_ROLE_KAPAL!=0) { ?>
									<div class="col-md-3 ">
										<div class="main-box small-graph-box emerald-bg" style="position: relative;cursor:pointer;min-height: 125px" onclick="window.location='einvoice/nota/kapal/kapal'">
											<i class="fa fa-flag rax"></i>
											<span class="stats-title">KAPAL</span>
											<span class="subinfo">

											</span>
											<span class="subinfo">

											</span>
											<span id="CountNotaKapal" class="headline" ></span>
											<div class="progress" id="progresskapal" style="height: 1.5px;">
												<div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">
													<span class="sr-only">84% Complete</span>
												</div>
											</div>
											<span class="subinfo">

											</span>
											<span class="subinfo">

											</span>
										</div>
									</div>
								<?php }; ?>

								<?php if($auth_service->INV_ROLE_PETIKEMAS!=0) { ?>
									<div class="col-md-3 ">
										<div class="main-box small-graph-box red-bg"style="cursor:pointer;min-height: 125px" onclick="window.location='einvoice/nota/petikemas/petikemas'">
											<i class="fa fa-archive fa-fw rax"></i>
											<span class="stats-title">PETIKEMAS</span>
											<span class="subinfo">

											</span>
											<span class="subinfo">

											</span>
											<span id="CountNotaPetikemas" class="headline"></span>
											<div class="progress" id="progresspetikemas" style="height: 1.5px;">
												<div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar">
													<span class="sr-only">60% Complete</span>
												</div>
											</div>
											<span class="subinfo">

											</span>
											<span class="subinfo">

											</span>
										</div>
									</div>
								<?php } ?>

								<?php if($auth_service->INV_ROLE_BARANG!=0) { ?>
									<div class="col-md-3 ">
										<div class="main-box small-graph-box green-bg" style="cursor:pointer;min-height: 125px" onclick="window.location='einvoice/nota/barang/barang'">
											<i class="fa fa-shopping-cart fa-fw rax"></i>
											<span class="stats-title">BARANG</span>
											<span class="subinfo">

											</span>
											<span class="subinfo">

											</span>
											<span id="CountNotaBarang" class="headline"></span>
											<div class="progress" id="progressbarang" style="height: 1.5px;">
												<div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="42" role="progressbar" class="progress-bar" id="CountBarangLunas">
													<span class="sr-only">42% Complete</span>
												</div>
											</div>
											<span class="subinfo">

											</span>
											<span class="subinfo">

											</span>
										</div>
									</div>
								<?php } ?>

								<?php if($auth_service->INV_ROLE_RUPARUPA!=0) { ?>
									<div class="col-md-3 ">
										<div class="main-box small-graph-box bg-gradient-black"style="cursor:pointer;min-height: 125px" onclick="window.location='einvoice/nota/ruparupa/ruparupa'" >
											<i class="fa fa-dropbox fa-fw rax"></i>
											<span class="stats-title">RUPA-RUPA</span>
											<span class="subinfo">

											</span>
											<span class="subinfo">

											</span>
											<span id="CountNotaRupa" class="headline"></span>
											<div class="progress" id="progressrupa" style="height: 1.5px;">
												<div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar">
													<span class="sr-only">60% Complete</span>
												</div>
											</div>
											<span class="subinfo">

											</span>
											<span class="subinfo">

											</span>
										</div>
									</div>
								<?php } ?>

                                <!--START SIGMA 23-09-2019 PALEMBANG ROLE ID : 370 USAHA TERMIAL-->
                                <?php //if($auth_service->INV_ROLE_USAHA_TERMINAL == 370) { ?>
                                <?php if($auth_service->INV_ROLE_USAHA_TERMINAL!=0) { ?>
                                    <div class="col-md-3 ">
                                        <div class="main-box small-graph-box bg-lime"style="cursor:pointer;min-height: 125px" onclick="window.location='einvoice/nota/usaha_terminal'" >
                                            <i class="fa fa-cubes fa-fw rax"></i>
                                            <span class="stats-title">USTER</span>
                                            <span class="subinfo">

											</span>
                                            <span class="subinfo">

											</span>
                                            <span id="CountNotaRupa" class="headline"></span>
                                            <div class="progress" id="progressuster" style="height: 1.5px;">
                                                <div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                            <span class="subinfo">

											</span>
                                            <span class="subinfo">

											</span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!--END SIGMA 23-09-2019 PALEMBANG ROLE ID : 370 USAHA TERMIAL-->

							<?php } ?>
<!--
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">CONTAINER THROUGHPUT</h2>
									</header>

									<div class="main-box-body clearfix">
										<div class="main-box-body clearfix">
											<div class="form-group">
												<label><?=get_content($this->user_model,"tracking","terminal")?></label>
												<select id="port" name="port" class="form-control" onchange="containerThroughputChart(this.value)">
													<option></option>
													<option value="IDJKT-T1D">Tanjung Priok - Terminal 1 Domestik</option>
													<option value="IDJKT-T2D">Tanjung Priok - Terminal 2 Domestik</option>
													<option value="IDJKT-T3D">Tanjung Priok - Terminal 3 Domestik</option>
													<option value="IDJKT-T3I">Tanjung Priok - Terminal 3 Internasional</option>
													<option value="IDJKT-009">Tanjung Priok - Terminal 009</option>
													<option value="IDJKT-VAS">Tanjung Priok - Lini 2</option>
													<option value="IDPNK-TPK">Pontianak - Terminal Petikemas</option>
												</select>
											</div><br>

											<div id="graph-flot-stacking2" style="height: 400px; padding: 0px; position: relative;"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left">Vessel Waiting Time</h2>
									</header>

									<div class="main-box-body clearfix">
										<div class="main-box-body clearfix">
											<div id="graph-flot-bullet" style="height: 300px; padding: 0px; position: relative;"></div>
										</div>
									</div>
								</div>
							</div>
						</div>-->

						<!--<div class="row">
							<div class="col-lg-6">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left"></h2>
									</header>

									<div class="main-box-body clearfix">
										<div class="main-box-body clearfix">
											<div id="container" style="width: 100%; height: auto; margin: 0 auto;float:left"></div></br>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left"></h2>
									</header>

									<div class="main-box-body clearfix">
										<div class="main-box-body clearfix">
											<div id="container2" style="width: 100%; height: auto; margin: 0 auto;float:left"></div></br>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left"></h2>
									</header>

									<div class="main-box-body clearfix">
										<div class="main-box-body clearfix">
											<div id="container3" style="width: 100%; height: auto; margin: 0 auto;float:left"></div></br>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
										<h2 class="pull-left"></h2>
									</header>

									<div class="main-box-body clearfix">
										<div class="main-box-body clearfix">
											<div id="container4" style="width: 100%; height: auto; margin: 0 auto;float:left"></div></br>
										</div>
									</div>
								</div>
							</div>
						</div>-->
					</div>
				</div>
			</div>

		<script>
			<?php if($this->session->userdata('invoice')) { ?>
		function count_nota() {
			$.ajax({
				type: 'GET',
				url: "<?=ROOT?>einvoice/nota/count_layanan_nota",
				//data: { port: portCommaSeparated, start_date: start_date, end_date: end_date},
				success: function(data) {
							//alert( "Data Loaded: " + data +"\n \n \n");
							//value = data;
							var obj = JSON.parse(data);
							for (var i = 0; i < obj.length; i++) {
								if(obj[i].HEADER_CONTEXT=="KPL"){
									if($("#CountNotaKapal").text(obj[i].COUNT) == 0)
									{
										$("#CountNotaKapal").text(0)
									}
									else
									{										
										$("#CountNotaKapal").text(obj[i].COUNT);
									}												
								}else if(obj[i].HEADER_CONTEXT=="BRG"){
									if($("#CountNotaBarang").text(obj[i].COUNT) == 0)
									{
										$("#CountNotaBarang").text(0)
									}
									else
									{										
										$("#CountNotaBarang").text(obj[i].COUNT);
									}									
								}else if(obj[i].HEADER_CONTEXT=="RUPA"){
									if($("#CountNotaRupa").text(obj[i].COUNT) == 0)
									{
										$("#CountNotaRupa").text(0)
									}
									else
									{										
										$("#CountNotaRupa").text(obj[i].COUNT);
									}
								}else if(obj[i].HEADER_CONTEXT=="PTKM"){
									if($("#CountNotaPetikemas").text(obj[i].COUNT) == 0)
									{
										$("#CountNotaPetikemas").text(0)
									}
									else
									{
										$("#CountNotaPetikemas").text(obj[i].COUNT);
									}
								}
							}
							//var obj = jQuery.parseJSON( data )
							//alert(data[0]);
						},
				//async:false
			});
			//var html = '<div style="width: 84%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">';
			var html_kapal = '';
			var html_barang = '';
			var html_petikemas = '';
			var html_rupa = '';
			var html_uster = '';

			$.ajax({
				type: 'GET',
				url: "<?=ROOT?>einvoice/nota/count_lunas_nota",
				//data: { port: portCommaSeparated, start_date: start_date, end_date: end_date},
				success: function(data) {
					//alert(data);
					var obj = JSON.parse(data);
					//kapal = obj['KPL'];
					//alert(kapal);

					//html_kapal = 'xxxxxxxxxxxxxxxxxxxxxxx';
					html_kapal += '<div style="width: '+obj['KPL']+'%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">';
					html_barang += '<div style="width: '+obj['BRG']+'%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">';
					html_petikemas += '<div style="width: '+obj['PTKM']+'%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">';
					html_rupa += '<div style="width: '+obj['RUPA']+'%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">';
                    html_uster += '<div style="width: '+obj['UST']+'%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">';

					$("#progresskapal").html(html_kapal);
					$("#progressbarang").html(html_barang);
					$("#progresspetikemas").html(html_petikemas);
					$("#progressrupa").html(html_rupa);
					$("#progressuster").html(html_uster);

						},
				//async:false
			});
			//var ;
			//html_kapal += '<div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">';
			//alert(kapal);

			//$("#progresskapal").html(html_kapal);

		}
		count_nota();
		<?php } ?>
			function getThroughput(port, start_date, end_date)
			{
				var value;
				var portCommaSeparated;

				//alert("value:"+value);

				//alert("teus:"+port+":"+start_date+":"+end_date+":"+trans_type);

				portCommaSeparated="";
				for (i = 0; i < port.length; i++) {
						if(portCommaSeparated=="")
							portCommaSeparated += port[i];
						else
							portCommaSeparated += ","+port[i];
				}
				//alert(portCommaSeparated);

				$.ajax({
				  type: 'POST',
				  url: "mainpage/get_throughput",
				  data: { port: portCommaSeparated, start_date: start_date, end_date: end_date},
				  success: function(data) {
								//alert( "Data Loaded: " + data +"\n \n \n");
								value = data;
								//alert(value);
							},
				  async:false
				});

				return value;
			}

			function getDate(minusDay)
			{
				var d = new Date(); // today!
				d.setDate(d.getDate() - minusDay-1);
				var dd = d.getDate();
				var mm = d.getMonth()+1; //January is 0!
				var yyyy = d.getFullYear();

				if(dd<10) {
					dd='0'+dd
				}

				if(mm<10) {
					mm='0'+mm
				}

				return yyyy+mm+dd;
			}

			function containerThroughputChart(terminal)
			{
				//alert(terminal);
				// stack graph
				// @enfi
				if ($('#graph-flot-stacking2').length) {
					var list_port = ["IDJKT-T3I", "IDJKT-T3D", "IDJKT-T2D", "IDJKT-T1D", "IDJKT-009"];
					var list_trans_type = ["E", "I", "T"];
					var days=4;
					var temp_date;
					var start_date;
					var end_date;
					var throughput=0;

					var Export = [];
					var Import = [];
					var Transhipment = [];
					var ticks = [];

					if(terminal!="")
					{
						list_port.length = 0;
						list_port[0] = terminal;
					}

					//alert('test');
					for (var j = days; j > 0; j--) {
						//alert(j);
						temp_date = getDate(j);
						//alert(temp_date);

						start_date=temp_date+'000000';
						end_date=temp_date+'235959';
						//alert(start_date);
						//alert(end_date);

						//var arrayLength = list_port.length;
						//alert(arrayLength);

						throughput=getThroughput(list_port, start_date, end_date);

						var throughputarr = throughput.split(",");

						Export.push([j, throughputarr[0]]);
						Import.push([j, throughputarr[1]]);
						Transhipment.push([j, throughputarr[2]]);

						ticks.push([j,start_date.substring(2,8)]);
					}

					var data = [
						{label: 'Export', data: Export},
						{label: 'Import', data: Import},
						{label: 'Transhipment', data: Transhipment},
					];

					var colors = ['#000099', '#990000', '#CC9900'];

					var stack = 0,
						bars = true,
						lines = false,
						steps = false;

					//stet
					function plotWithOptions() {
						$.plot("#graph-flot-stacking2", data, {
							series: {
								stack: stack,
								lines: {
									show: lines,
									fill: true,
									steps: steps,
									lineWidth: 1,
									fill: 1
								},
								bars: {
									show: bars,
									barWidth: 0.3,
									lineWidth: 1,
									fill: 1
								}
							},
							colors: colors,
							grid: {
								tickColor: "#ddd",
								borderWidth: 1
							},
							shadowSize: 1,
							xaxis: {
								ticks: ticks,
								axisLabelPadding: 10
							},
							yaxis: {
								axisLabel: "Total TEU",
								axisLabelUseCanvas: true,
								axisLabelFontSizePixels: 12,
								axisLabelFontFamily: 'Verdana, Arial',
								axisLabelPadding: 3,
								tickFormatter: function (v, axis) {
									return v + "TEU";
								}
							}
						});
					}
					//stet
					plotWithOptions();
				}
			}

			containerThroughputChart("");

		function getVesselWaitingTime(portCommaSeparated, start_date, end_date)
		{
			var value;

			$.ajax({
			  type: 'POST',
			  url: "mainpage/get_vessel_waiting_time",
			  data: { port: portCommaSeparated, start_date: start_date, end_date: end_date},
			  success: function(data) {
							//alert( "Data Loaded1: " + data );

							value = data;

						},
			  async:false
			});

			return value;
		}

		// graph with points - sin/cos example
		if ($('#graph-flot-bullet').length) {

			var vessel1 = [],
				vessel2 = [];
			var days=15;
			var temp_date;
			var start_date;
			var end_date;
			var portCommaSeparated;
			var data;

			portCommaSeparated="";
			start_date = getDate(days)+'000000';
			end_date=getDate(1)+'235959';

			//get data
			data = getVesselWaitingTime("", start_date, end_date);
			//alert(data);
			var obj = jQuery.parseJSON(data);
			var i;
			for(i=0;i<obj.data.info.length;i++)
			{
				vessel1.push([obj.data.info[i].tgl_mlabuh, obj.data.info[i].wtime]);
			}

			var plot = $.plot("#graph-flot-bullet", [
				{ data: vessel1, label: "JAKARTA"},
				//{ data: vessel2, label: "Vessel2"}
			], {
				series: {
					lines: {
						show: true,
						lineWidth: 2
					},
					points: {
						show: true
					}
				},
				grid: {
					hoverable: true,
					clickable: true,
					tickColor: "#ddd",
					borderWidth: 0
				},
				yaxis: {
					min: 0,
					max: 12
				},
				colors: ['#e84e40', '#8bc34a', '#ffc107', '#03a9f4', '#9c27b0', '#90a4ae'],
				shadowSize: 0
			});

			function showTooltip(x, y, contents) {
				$("<div id='tooltip'>" + contents + "</div>").css({
					position: "absolute",
					display: "none",
					top: y + 5,
					left: x + 5,
					border: "1px solid #fdd",
					padding: "2px",
					"background-color": "#fee",
					opacity: 0.80
				}).appendTo("body").fadeIn(200);
			}

			var previousPoint = null;
			$("#graph-flot-bullet").bind("plothover", function (event, pos, item) {

				if ($("#enablePosition:checked").length > 0) {
					var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
					$("#hoverdata").text(str);
				}

				if ($("#enableTooltip:checked").length > 0) {
					if (item) {
						if (previousPoint != item.dataIndex) {

							previousPoint = item.dataIndex;

							$("#tooltip").remove();
							var x = item.datapoint[0].toFixed(2),
							y = item.datapoint[1].toFixed(2);

							showTooltip(item.pageX, item.pageY,
							    item.series.label + " of " + x + " = " + y);
						}
					} else {
						$("#tooltip").remove();
						previousPoint = null;
					}
				}
			});

			$("#graph-flot-bullet").bind("plotclick", function (event, pos, item) {
				if (item) {
					$("#clickdata").text(" - click point " + item.dataIndex + " in " + item.series.label);
					plot.highlight(item.series, item.datapoint);
				}
			});
		}

		$(function () {
			$('#container').highcharts({
				chart: {
					type: 'gauge',
					plotBorderWidth: 0,
					plotBackgroundImage: null,
					height:200
				},
				title: {
					text: ' '
				},
				pane: [{
					startAngle: -90,
					endAngle: 90,
					background: null,
					center: ['40%', '100%'],
					size: 300
				}],
				yAxis: [{
					min: 0,
					max: 60,
					minorTickPosition: 'outside',
					tickPosition: 'outside',
					labels: {
						rotation: 'auto',
						distance: 20
					},
					plotBands: [{
						from: 0,
						to: 20,
						color: '#C02316',
						innerRadius: '100%',
						outerRadius: '105%'
					},{
						from: 20,
						to: 35,
						color: '#F7D358',
						innerRadius: '100%',
						outerRadius: '105%'
					},{
						from: 35,
						to: 60,
						color: '#82FA58',
						innerRadius: '100%',
						outerRadius: '105%'
					}],
					pane: 0,
					title: {
						text: 'BOX SHIP HOUR <br/><span style="font-size:8px"> NAME </span>',
					}
				}],
				plotOptions: {
					gauge: {
						dataLabels: {
							enabled: true
						},
						dial: {
							radius: '90%'
						}
					}
				},
				series: [{
					data: [{y:38, color: 'red'}],
					yAxis: 0,
							dial: {
								backgroundColor : 'red'
							}
					},{
					data: [{y:35}],
					yAxis: 0,
							dial: {
								backgroundColor : 'green'
							}
					},{
					data: [{y:45}],
					yAxis: 0,
							dial: {
								backgroundColor : 'blue'
							}
					}]
			});
		});

		$(function () {
			$('#container2').highcharts({
				chart: {
					type: 'gauge',
					plotBorderWidth: 0,
					plotBackgroundImage: null,
					height:200
				},
				title: {
					text: ' '
				},
				pane: [{
					startAngle: -90,
					endAngle: 90,
					background: null,
					center: ['40%', '100%'],
					size: 300
				}],
				yAxis: [{
					min: 0,
					max: 5,
					minorTickPosition: 'outside',
					tickPosition: 'outside',
					labels: {
						rotation: 'auto',
						distance: 20
					},
					plotBands: [{
						from: 0,
						to: 2,
						color: '#82FA58',
						innerRadius: '100%',
						outerRadius: '105%'
					},{
						from: 2,
						to: 4,
						color: '#F7D358',
						innerRadius: '100%',
						outerRadius: '105%'
					},{
						from: 4,
						to: 5,
						color: '#C02316',
						innerRadius: '100%',
						outerRadius: '105%'
					}],
					pane: 0,
					title: {
						text: 'TURNROUND TIME TRUCK <br/><span style="font-size:8px"> NAME </span>',
					}
				}],
				plotOptions: {
					gauge: {
						dataLabels: {
							enabled: true
						},
						dial: {
							radius: '90%'
						}
					}
				},
				series: [{
					data: [{y:1, color: 'red'}],
					yAxis: 0,
							dial: {
								backgroundColor : 'red'
							}
				},{
					data: [{y:3}],
					yAxis: 0,
							dial: {
								backgroundColor : 'green'
							}
				},{
					data: [{y:2}],
					yAxis: 0,
							dial: {
								backgroundColor : 'blue'
							}
				}]
			});
		});

		$(function () {
			$('#container3').highcharts({
				chart: {
					type: 'gauge',
					plotBorderWidth: 0,
					plotBackgroundImage: null,
					height:200
				},
				title: {
					text: ' '
				},
				pane: [{
					startAngle: -90,
					endAngle: 90,
					background: null,
					center: ['40%', '100%'],
					size: 300
				}],
				yAxis: [{
					min: 0,
					max: 10,
					minorTickPosition: 'outside',
					tickPosition: 'outside',
					labels: {
						rotation: 'auto',
						distance: 20
					},
					plotBands: [{
						from: 0,
						to: 2,
						color: '#C02316',
						innerRadius: '100%',
						outerRadius: '105%'
					},{
						from: 2,
						to: 5,
						color: '#F7D358',
						innerRadius: '100%',
						outerRadius: '105%'
					},{
						from: 5,
						to: 10,
						color: '#82FA58',
						innerRadius: '100%',
						outerRadius: '105%'
					}],
					pane: 0,
					title: {
						text: 'DWELLING TIME PETIKEMAS <br/><span style="font-size:8px"> NAME </span>',
					}
				}],
				plotOptions: {
					gauge: {
						dataLabels: {
							enabled: true
						},
						dial: {
							radius: '90%'
						}
					}
				},
				series: [{
					data: [{y:4, color: 'red'}],
					yAxis: 0,
							dial: {
								backgroundColor : 'red'
							}
				},{
					data: [{y:5}],
					yAxis: 0,
							dial: {
								backgroundColor : 'green'
							}
				},{
					data: [{y:3}],
					yAxis: 0,
							dial: {
								backgroundColor : 'blue'
							}
				}]
			});
		});

		$(function () {
			$('#container4').highcharts({
				chart: {
					type: 'gauge',
					plotBorderWidth: 0,
					plotBackgroundImage: null,
					height:200
				},
				title: {
					text: ' '
				},
				pane: [{
					startAngle: -90,
					endAngle: 90,
					background: null,
					center: ['40%', '100%'],
					size: 300
				}],
				yAxis: [{
					min: 0,
					max: 10000,
					minorTickPosition: 'outside',
					tickPosition: 'outside',
					labels: {
						rotation: 'auto',
						distance: 20
					},
					plotBands: [{
						from: 0,
						to: 2000,
						color: '#C02316',
						innerRadius: '100%',
						outerRadius: '105%'
					},{
						from: 2000,
						to: 5000,
						color: '#F7D358',
						innerRadius: '100%',
						outerRadius: '105%'
					},{
						from: 5000,
						to: 10000,
						color: '#82FA58',
						innerRadius: '100%',
						outerRadius: '105%'
					}],
					pane: 0,
					title: {
						text: 'THROUGHPUT PETIKEMAS <br/><span style="font-size:8px"> (INT) </span>',
					}
				}],
				plotOptions: {
					gauge: {
						dataLabels: {
							enabled: true
						},
						dial: {
							radius: '90%'
						}
					}
				},
				series: [{
					data: [{y:6800, color: 'red'}],
					yAxis: 0,
							dial: {
								backgroundColor : 'red'
							}
				},{
					data: [{y:2000}],
					yAxis: 0,
							dial: {
								backgroundColor : 'green'
							}
				},{
					data: [{y:5700}],
					yAxis: 0,
							dial: {
								backgroundColor : 'blue'
							}
				}]
			});
		});
		</script>
