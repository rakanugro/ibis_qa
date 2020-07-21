<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
<script src="<?=CUBE_?>js/hogan.js"></script>
<script src="<?=CUBE_?>js/typeahead.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>

	<style type="text/css">
	.upload_info {
		font-size: small;
		font-style: italic;
		float: right;
	}
	.hidden_content {
		display: none;
	}
	#component_type {
		float: left;
	}
	#component_reefer {
		float: left;
		margin-left: 10px;
	}
	</style>

	<script>
	$(document).ready(function() {
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});

		var table = $('#table-request').DataTable({bFilter: false, bInfo: false, paging: false});
	});		
	</script>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<div class="pull-left">
						<h2>
							Detail Port
						</h2>
					</div>
				</header>
				<div class="pull-left" style="margin: 0 32px">
					<table>
						<tr>
							<td style="width:50%">Terminal</td>
							<td style="width:5%">:</td>
							<td><?=$port;?></td>
						</tr>
						<tr>
							<td style="width:50%">Service</td>
							<td style="width:5%">:</td>
							<td><?=ucwords($Service);?></td>
						</tr>
						<tr>
							<td style="width:50%">Truck Loosing</td>
							<td style="width:5%">:</td>
							<td><?=$TL;?></td>
						</tr>
						<tr><td colspan="3">&nbsp;</td></tr>
					</table>
				</div>
				<div class="pull-right" style="margin: 0 32px">
					<table>
<?php if($Service=='delivery ext') { ?>
						<tr>
							<td style="width:60%">Start Delivery Date</td>
							<td style="width:5%">:</td>
							<td><?=date('d F Y',strtotime($eta));?></td>
						</tr>
						<tr>
							<td style="width:60%">End Delivery Date</td>
							<td style="width:5%">:</td>
							<td><?=date('d F Y',strtotime($etb));?></td>
						</tr>
						<tr>
							<td style="width:60%">End Extention Date</td>
							<td style="width:5%">:</td>
							<td><?=date('d F Y',strtotime($etb2));?></td>
						</tr>
<?php } else if($Service=='loading cancel before') { ?>
						<tr>
							<td style="width:60%">&nbsp;</td>
							<td style="width:5%">&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td style="width:60%">&nbsp;</td>
							<td style="width:5%">&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
<?php } else { ?>
						<tr>
							<td style="width:60%">Start <?=ucwords($Service);?> Date</td>
							<td style="width:5%">:</td>
							<td><?=date('d F Y',strtotime($eta));?></td>
						</tr>
						<tr>
							<td style="width:60%">End <?=ucwords($Service);?> Date</td>
							<td style="width:5%">:</td>
							<td><?=date('d F Y',strtotime($etb));?></td>
						</tr>
<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!--  DETAILS  -->
	<div class="row" id="tabledata">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<div class="pull-left">
						<h2>
							Detail Container
						</h2>
					</div>
				</header>
				<div class="main-box-body clearfix">
					<div class="table-responsive clearfix">
						<table id="table-request" class="table table-hover">
							<thead>
								<tr class="clickableRow">
									<th>NO</th><th>Description</th><th>Size</th><th>OOG</th><th>Type</th><th>Status</th><th>HZ</th><th>Box</th><th>Hari</th><th>Tariff</th><th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?=$html;?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="pull-right" style="margin: 0 32px">
					<table style="width:500px;">
						<tr>
							<td>Discount</td>
							<td>:</td>
							<td align="right">0</td>
						</tr>
						<tr>
							<td>Administrasi</td>
							<td>:</td>
							<td align="right"><?=number_format($adm,0);?></td>
						</tr>
						<tr>
							<td>Dasar Pengenaan Pajak</td>
							<td>:</td>
							<td align="right"><?=number_format($total,0);?></td>
						</tr>
						<tr>
							<td>Jumlah PPN</td>
							<td>:</td>
							<td align="right"><?=number_format((ceil($total * 10) / 100),0);?></td>
						</tr>
						<tr>
							<td>Jumlah PPN Subsidi</td>
							<td>:</td>
							<td align="right">0</td>
						</tr>
						<tr>
							<td>Jumlah Dibayar</td>
							<td>:</td>
							<td align="right"><?=number_format(($total + ($total*0.1)),0);?></td>
						</tr>
					</table>
				</div>
				<div class="main-box-body clearfix">
					<a  class='btn btn-info' onclick='window.location.href="<?=ROOT;?>misc_tools"'>Go Back</a>
				</div>
			</div>
		</div>
	</div>

<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/bootstrap-timepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
