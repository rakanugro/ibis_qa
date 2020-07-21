<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
<script src="<?=CUBE_?>js/hogan.js"></script>
<script src="<?=CUBE_?>js/typeahead.min.js"></script>
<script src="<?=CUBE_?>js/jquery.datetimepicker.full.js"></script>
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

.ui-autocomplete-loading { background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center }

</style>

	<script>
		$(document).ready(function() {
			$("#shipper").hide();
			//sql injection protection
			$(":input").keyup(function(event) {
				// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
				$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
			});

			 $('#start_date').datetimepicker({
			  format:'Y/m/d',
			  onShow:function( ct ){
			   this.setOptions({
				maxDate:$('#end_date').val()?$('#end_date').val():false
			   })
			  },
			  timepicker:false
			 });

			 $('#end_date').datetimepicker({
			  format:'Y/m/d',
			  onShow:function( ct ){
			   this.setOptions({
				minDate:$('#start_date').val()?$('#start_date').val():false
			   })
			  },
			  timepicker:false
			 });

			 $('#end_date2').datetimepicker({
			  format:'Y/m/d',
			  onShow:function( ct ){
				var date = new Date($('#end_date').val()?$('#end_date').val():false);
				date.setDate(date.getDate() + 1);
			    this.setOptions({
				  minDate:$('#end_date').val()?date:false
			    })
			  },
			  timepicker:false
			 });

			var table = $('#table-request').DataTable({bFilter: false, bInfo: false, paging: false});
		});
	</script>
	
	<!--  HEADER  -->
	<div class="row">
		<div class="col-lg-6 ">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2>Tariff Simulation</h2>
				</header>

				<div class="main-box-body clearfix">
					<form action="<?=ROOT;?>misc_tools" method="post" name="frmTarif" id="frmTarif">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<input type="hidden" name="txGrd" id="txGrd" />
						<div class="form-group">
							<label>Terminal</label>
							<select id="port" name="port" class="form-control" onchange="isiPort(this)">
								<option> -- Please Choose Terminal -- </option>
					<?php foreach($terminal as $term){	?>
								<option value="<?=$term["PORT"]?>-<?=$term["TERMINAL"]?>"><?=$term["TERMINAL_NAME"]?></option>
					<?php } ?>
							</select>
							<input id="portname" name="portname" type="hidden" />
						</div>
<!--
						<div class="form-group">
							<label>Request#</label>
							<input type="text" class="form-control" id="txReqNum" name="txReqNum" value="" placeholder="Please input request number"/>
						</div>
-->
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group example-twitter-oss">
									<div class="form-group col-xs-6">
										<label>Service</label>
										<select id="cboService" name="cboService" class="form-control" onchange="otherAct(this);">
											<option></option>
											<option value="receiving">Receiving</option>
											<option value="delivery">Delivery</option>
											<option value="delivery_ext">Delivery Extention</option>
											<option value="loading_cancel_before">Loading Cancel - Before</option>
											<option value="loading_cancel_after">Loading Cancel - After</option>
											<option value="loading_cancel_delivery">Loading Cancel - Delivery</option>
										</select>
									</div>
									<div class="form-group col-xs-6">
										<label>Truck Loosing</label>
										<select id="cboTL" name="cboTL" class="form-control">
											<option></option>
											<option value="Y">Yes</option>
											<option value="N">No</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<div class="form-group example-twitter-oss tanggalan">
									<div class="form-group col-xs-6">
										<label class="lbl_strtdate" for="exampleAutocomplete">Start Date</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" id="start_date" name="eta">
										</div>
									</div>
									<div class="form-group col-xs-6">
										<label class="lbl_enddate" for="exampleAutocomplete">End Date</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" id="end_date" name="etb">
										</div>
									</div>
									<div class="form-group col-xs-12 end_date2" style="display:none;">
										<label class="lbl_enddate2" for="exampleAutocomplete">End Date</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" id="end_date2" name="etb2">
										</div>
									</div>
								</div>
							</div>
						</div>
<!--
						<div class="form-group example-twitter-oss">
							<div class="form-group col-xs-6">
								<label>Start Shift Reefer</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input class="form-control" id="start_shift" name='start_shift' type="text" placeholder="Untuk Reefer Klik Disini">
								</div>
							</div>
							<div class="form-group col-xs-6">
								<label>End Shift Reefer</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input class="form-control" id="end_shift" name='end_shift' type="text" placeholder="Untuk Reefer Klik Disini">
								</div>
							</div>
						</div>
-->
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--  HEADER  -->

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
					<div class="pull-right">
						<!-- <a class="btn btn-info" data-toggle="modal" data-target="#myModal" onClick="addRow();">[+] Add</a> -->
						<a class="btn btn-info" data-toggle="modal" data-target="#myModal" onClick="clearModal();">[+] Add</a>
						<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">[+] Add</button> -->
					</div>
				</header>
				<div class="main-box-body clearfix">
					<div class="table-responsive clearfix">
						<table id="table-request" class="table table-hover">
							<thead>
								<tr class="clickableRow">
									<th>NO</th><th>Size</th><th>Type</th><th>Status</th><th>OOG</th><th>HZ</th><th>Box</th><th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="main-box-body clearfix">
					<a  class='btn btn-success' onclick='kirim();'>Preview Tariff</a>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Detail Container</h4>
					</div>
					<div class="modal-body">
						<table width="100%">
							<tr>
								<td>Size</td>
								<td>:</td>
								<td>
									<select id="cboSize" style="width:80%">
										<option value="20">20"</option>
										<option value="21">21"</option>
										<option value="40">40"</option>
										<option value="45">45"</option>
									</select>
								</td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr>
								<td>Type</td>
								<td>:</td>
								<td>
									<select id="cboType" style="width:80%">
										<option value="HQ">HQ</option>
										<option value="OT">OT (Over Dimesion)</option>
										<option value="FLT">FLT</option>
										<option value="RFR">RFR</option>
										<option value="DRY" selected>DRY</option>
										<option value="TNK">TNK</option>
									</select>
								</td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr>
								<td>Status</td>
								<td>:</td>
								<td>
									<select id="cboStatus" style="width:80%">
										<option value="Full">Full</option>
										<option value="Empty">Empty</option>
									</select>
								</td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr>
								<td>OOG</td>
								<td>:</td>
								<td>
									<select id="cboOGG" style="width:80%">
										<option value="Yes">Yes</option>
										<option value="No" selected>No</option>
									</select>
								</td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr>
								<td>HZ</td>
								<td>:</td>
								<td>
									<select id="cboHZ" style="width:80%">
										<option value="Yes">Yes</option>
										<option value="No" selected>No</option>
									</select>
								</td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr>
								<td>Box</td>
								<td>:</td>
								<td><input type="text" id="txBox" size="25"/></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" onClick="addRow();">Add</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function addRow()
		{
			var cboSize = $("#cboSize").val();
			var cboOGG = $("#cboOGG").val();
			var cboType = (cboOGG === 'Yes' ? 'OT' : $("#cboType").val());
			var cboStatus = $("#cboStatus").val();
			var cboHZ = $("#cboHZ").val();
			var txBox = $("#txBox").val();

			var trFirst = $('#table-request').find('tbody tr');
			if (trFirst.text()==='No data available in table')
				trFirst.remove();

			var jml = $('#table-request').find('tbody tr').length;
			$('#table-request').find('tbody').append('<tr><td>'+(jml + 1)+'</td><td>' + cboSize + '</td><td>'+ cboType +'</td><td>' + cboStatus + '</td><td>' + cboOGG + '</td><td>' + cboHZ + '</td><td>' + txBox + '</td><td><a class="btn btn-primary" onClick="removeRow(this);">[-] Remove</a></td></tr>');

			$("#myModal").modal("toggle");
		}

		function removeRow(o)
		{
			o.closest('tr').remove();
			if ($('#table-request').find('tbody tr').length==0)
				$('#table-request').find('tbody').append('<tr><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>');
		}

		function clearModal()
		{
			var txBox = $("#txBox");
			txBox.val("");
		}

		function kirim()
		{
			var row = $('#table-request').find('tbody tr');
			var jmlRow = row.length;
			var trFirst = $('#table-request').find('tbody tr');
			
			if ((jmlRow > 0) && (trFirst.text() !='No data available in table'))
			{
				var istl, start_date, end_date, size, type, status, oog, hz, box;
				var grdContainer = [];
				$('#table-request > tbody  > tr').each(function(tr) {
					grdContainer[tr] = {
						istl: $("#cboTL").val(),
						start_date: $("#start_date").val(),
						end_date: $("#end_date").val(),
						size: $(this).find('td:eq(1)').text(),
						type: $(this).find('td:eq(2)').text(),
						status: $(this).find('td:eq(3)').text(),
						oog: $(this).find('td:eq(4)').text(),
						hz: $(this).find('td:eq(5)').text(),
						box: $(this).find('td:eq(6)').text()
					};
				});
				var out = JSON.stringify(grdContainer);
				$("#txGrd").val(out);
				frmTarif.submit();
			} else {
				alert("Please input your container detail first !");
				clearModal();
				$("#myModal").modal("toggle");
			}
		}
		
		function isiPort(port)
		{
			var portname = port.options[port.selectedIndex].text;
			$("#portname").val(portname);
		}
		
		function otherAct(cbo)
		{
			var cboText = cbo.value;
			if(cboText==='delivery_ext') 
			{
				$(".lbl_strtdate").text('Start Delivery Date');
				$(".lbl_enddate").text('End Delivery Date');
				$(".lbl_enddate2").text('End Extention Date');
				$("#start_date").val('');
				$("#end_date").val('');
				$(".tanggalan").show();
				$(".end_date2").show();
			} else if (cboText==='loading_cancel_before')
			{
				$("#start_date").val('');
				$("#end_date").val('');
				$("#end_date2").val('');
				$(".tanggalan").hide();
			} else if ((cboText === 'loading_cancel_after') || (cboText === 'loading_cancel_delivery'))
			{
				$(".lbl_strtdate").text('Start Vessel I Date');
				$(".lbl_enddate").text('End Vessel I Date');
				$(".lbl_enddate2").text('End Vessel II Date');
				$("#start_date").val('');
				$("#end_date").val('');
				$(".tanggalan").show();
				$(".end_date2").show();
			}
			else
			{
				$(".lbl_strtdate").text('Start ' + cboText.charAt(0).toUpperCase() + cboText.slice(1) + ' Date');
				$(".lbl_enddate").text('End ' + cboText.charAt(0).toUpperCase() + cboText.slice(1) + ' Date');
				$(".tanggalan").show();
				$(".end_date2").hide();
			}
		}
	</script>

	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
