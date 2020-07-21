<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=JSQ?>jquery-ui.theme.css" />
<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>
<!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>

<style type="text/css">
.separate_content {
	width:31%;
    height:100px;
    border:1px solid red;
    margin-right:10px;
    float:left;
}
.linkbutton:hover{
	cursor: pointer;
}
div.DTTT.btn-group{
	display:none !important;        
}
</style>

<script>

function search_vessel(){
  var vesselname = $("#vessel_autocomplete").val();
  var port       = $('#port').val();
  //var url = "<?=ROOT?>autocomplete/getVesselList";
  if(vesselname == ''){
	  $("#vessel_autocomplete").focus();
	  alert('Mohon diisi kolomnya');
  }
  else{
	$.get("<?=ROOT?>container_receiving/search_vessel_modal",{term : vesselname, port: port}, function(data){
		  $('#modalplaceholder').html(data).children().modal('show');
	  });
  }

}

$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}<>|\[\]/\\]/gi, ''));
	});
	
	$( "#consignee_autocomplete" ).autocomplete({
			minLength: 3,
			source: function(request, response) 
			{
				$.getJSON("<?=ROOT?>dashboard_activity/get_customer_list",{term: $( "#consignee_autocomplete" ).val()}, response);
			},
			focus: function( event, ui ) 
			{
				$( "#consignee_autocomplete" ).val( ui.item.NAME);
				return false;
			},
			select: function( event, ui ) 
			{
				$( "#consignee_autocomplete" ).val( ui.item.NAME);
				$( "#consignee_id" ).val( ui.item.CUSTOMER_ID);
				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item ) 
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'>" + item.NAME + "<br>" +item.CUSTOMER_ID+"</a>")
			.appendTo( ul );
		};

	//$('#trx_date').datepicker({ dateFormat: 'dd-mm-yy' });
	//$('#trx_date1').datepicker({ dateFormat: 'dd-mm-yy' });
	
	$.fn.deactivatePicker = function () {
		$(this).removeClass("calendarclass");
		$(this).removeClass("hasDatepicker");
		$(this).unbind();
	};	
	
	function ValidatePreviousDateToDateCompare(previousDate, compareDate) {
		var strEffectiveDate = previousDate;
		var arrayStrEffectiveDate = strEffectiveDate.split('-');
		var strEndDate = compareDate;
		var arrayStrEndDate = strEndDate.split('-');

		var validateEndDate = 0;

		if (compareDate != "") {
			if (arrayStrEffectiveDate[2] >= arrayStrEndDate[2]) {
				if (arrayStrEffectiveDate[2] > arrayStrEndDate[2])
					validateEndDate++;
				if (arrayStrEffectiveDate[1] >= arrayStrEndDate[1]) {
					if (arrayStrEffectiveDate[1] > arrayStrEndDate[1])
						validateEndDate++;
					if (arrayStrEffectiveDate[0] >= arrayStrEndDate[0]) {
						if (arrayStrEffectiveDate[0] > arrayStrEndDate[0])
							validateEndDate++;
					}
				}
			}

			if (validateEndDate != 0) {
				return true;
			}
		}
		return false;
	}

	function ValidateFromToDate(eleDateFrom, eleDateTo, additionalDate, oncomplete) {
		if (additionalDate == undefined || additionalDate == "" || additionalDate < 0)
			additionalDate = 0;
		MaxMinFromToDate(eleDateFrom, eleDateTo, additionalDate, oncomplete);
	}

	function ValidationFromToDateChange(eleDateFrom, eleDateTo, isChangeFrom, additionalDate, oncomplete) {
		var splitDateFrom = fixedDateChange(eleDateFrom.val()).split('-');
		var splitDateTo = fixedDateChange(eleDateTo.val()).split('-');

		var newDateFrom = new Date(parseFloat(splitDateFrom[2]), parseFloat(splitDateFrom[1]) - 1, parseFloat(splitDateFrom[0]) + additionalDate);
		var newDateTo = new Date(parseFloat(splitDateTo[2]), parseFloat(splitDateTo[1]) - 1, parseFloat(splitDateTo[0]) - additionalDate);

		var valueNewDateFrom = fixedDateChange(NewDate(newDateFrom));
		var valueNewDateTo = fixedDateChange(NewDate(newDateTo));

		if (isChangeFrom) {
			eleDateFrom.val(valueNewDateFrom);
		} else if (!isChangeFrom) {
			eleDateTo.val(valueNewDateTo);
		}
		
		if (ValidatePreviousDateToDateCompare(valueNewDateFrom, valueNewDateTo)) {
			if (isChangeFrom) {
				eleDateFrom.val(valueNewDateTo);
			} else if (!isChangeFrom) {
				eleDateTo.val(valueNewDateFrom);
			}
			else {
				eleDateTo.val(valueNewDateFrom);
			}
		}
		MaxMinFromToDate(eleDateFrom, eleDateTo, additionalDate, oncomplete);
	}

	function NewDate(dateValue) {
		if (dateValue == "Invalid Date")
			return "";
		else {
			var dateTo;
			var monthTo;

			if (dateValue.getDate() < 10)
				dateTo = "0" + dateValue.getDate();
			else
				dateTo = dateValue.getDate();
			if (parseFloat(dateValue.getMonth() + 1) < 10)
				monthTo = "0" + parseFloat(dateValue.getMonth() + 1);
			else
				monthTo = parseFloat(dateValue.getMonth() + 1);

			return dateTo + "-" + monthTo + "-" + dateValue.getFullYear();
		}
	}

	function fixedDateChange(dateStringValue) {
		if (dateStringValue != "") {
			var dateNow = dateStringValue.split('-');
			if (parseFloat(dateNow[1]) > 12) {
				dateStringValue = dateNow[0] + '-' + 12 + '-' + dateNow[2];
			}
			if (parseFloat(dateNow[2]) > 2500) {
				dateStringValue = dateNow[0] + '-' + 12 + '-' + 2500;
			}
			if (parseFloat(dateNow[2]) < 1900) {
				dateStringValue = '01' + '-' + '01' + '-' + 1900;
			}
			var dateNowNew = dateStringValue.split('-');
			var lastDay = new Date(dateNowNew[2], dateNowNew[1], 0).getDate();
			if (dateNowNew[0] > lastDay) {
				return lastDay + '-' + dateNowNew[1] + '-' + dateNowNew[2];
			}
			return dateStringValue;
		}
		return "";
	}

	function MaxMinFromToDate(eleDateFrom, eleDateTo, additionalDate, oncomplete) {
		var splitDateFrom = eleDateFrom.val().split('-');
		var splitDateTo = eleDateTo.val().split('-');

		eleDateFrom.deactivatePicker();
		eleDateFrom.datepicker({
			dateFormat: 'dd-mm-yy',			
			maxDate: new Date(parseFloat(splitDateTo[2]), parseFloat(splitDateTo[1]) - 1, parseFloat(splitDateTo[0]) - additionalDate),
		});

		eleDateTo.deactivatePicker();
		eleDateTo.datepicker({
			dateFormat: 'dd-mm-yy',
			minDate: new Date(parseFloat(splitDateFrom[2]), parseFloat(splitDateFrom[1]) - 1, parseFloat(splitDateFrom[0]) + additionalDate),
		});
		
		if (oncomplete != undefined)
			oncomplete();

		eleDateFrom.change(function () {
			ValidationFromToDateChange(eleDateFrom, eleDateTo, true, additionalDate, oncomplete);			
		});
		eleDateTo.change(function () {
			ValidationFromToDateChange(eleDateFrom, eleDateTo, false, additionalDate, oncomplete);			
		});
	}
	ValidateFromToDate($("#trx_date"), $("#trx_date1"));
});
	//search table js
	function submit_process()
	{
		//var url = "<?=ROOT?>approval_request/search_tb_svcccl";
		var port = $("#port").val();
		var service = $("#service").val();
		var trx_date = $("#trx_date").val();
		var file = $("#file").val();

			window.open("<?=ROOT?>invoice_daily/excelfiles/"+port+"/"+service+"/"+trx_date+"/"+file+"/",'_blank');

	}
	
	
  function complete($vessel,$voyin,$voyout,$eta,$etd,$ukk,$vesselcode,$callsign,$voyage,$closedoc,$close,$contlimit,$openstack){
      $( "#vessel_autocomplete" ).val( $vessel);
      $( "#voyage_in" ).val( $voyin);
      $( "#voyage_out" ).val( $voyout);
      $( "#eta" ).val( $eta);
      $( "#etd" ).val( $etd);
      $( "#end_shift" ).val( $etd);
      $( "#ukk" ).val( $ukk);
      $( "#vessel_code" ).val( $vesselcode);
      $( "#call_sign" ).val( $callsign);
      $( "#voyage" ).val( $voyage);
      $( "#closing" ).val( $close);
      $( "#openstack" ).val( $openstack);
      $( "#closingdoc" ).val( $closedoc);
      $( "#booking_limit" ).val( $contlimit);


      $('#modalplaceholder').attr('display','none');
  }
  
  function check(report_type){
	var port = $("#port").val();
	var trx_date = $("#trx_date").val();
	var trx_date1 = $("#trx_date1").val();
	var customer = $("#consignee_id").val();
	var custname = $("#consignee_autocomplete").val();
	if (port == '' && report_type != 'getReportECare' && report_type != 'getReportCustomerId') {
		alert ("Mohon pilih terminal terlebih dahulu");
	} else if ((trx_date == '' || trx_date1 == '') && report_type != 'getReportCustomerId') {
		alert ("Mohon pilih periode terlebih dahulu");
	} else {
		if (port == '') {
			port = 'NOT_DEFINE';
		}
		window.open("<?=ROOT?>dashboard_activity/excelfiles/"+report_type+"/"+port+"/"+trx_date+"/"+trx_date1+"/"+customer+"/"+custname+"/",'_blank');
	}
  }
  
  function resetCustomer()
	{
		$("#consignee_autocomplete").val("");
		$("#consignee_id").val("");
        return false;
	}


</script>
<div class="row">
	<div class="col-lg-6">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix">
				<h2>Summary Report</h2>
			</header>
			<div class="main-box-body clearfix">
				<div class="form-group">
					<label>Terminal</label>
					<select id="port" name="port" class="form-control">
					<option value=""> -- Please Choose Terminal -- </option>
					<?php
					foreach($terminal as $term)
					{
					?>
						<option value="<?=$term["PORT"]?>-<?=$term["TERMINAL"]?>"><?=$term["TERMINAL_NAME"]?></option>
					<?php
					}
					?>
					</select>
				<!--</div>
				<div class="form-group">-->
						<label>Periode</label>
						<div class="input-group">
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input class="form-control" id="trx_date" name='trx_date' type="text">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input class="form-control" id="trx_date1" name='trx_date1' type="text">
								</div>
							</div>
						</div>
				<!--</div>
				<div class="form-group">-->
					<label>Customer</label>
					<div>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="consignee_autocomplete" name="consignee_name" value="<?=$consignee_name?>" placeholder="autocomplete" title="Masukkan Consignee">
						</div>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="consignee_id" name="consignee_id" value="<?=$consignee_id?>" data-toggle="tooltip" data-placement="bottom" title="consignee id" size="5" readonly>
						</div>
						<div class="col-sm-2">
							<input type="button" class="btn btn-success" value="Reset" onclick="resetCustomer();">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div id='draft_button' class="main-box infographic-box colored green-bg linkbutton" onclick="check('getReportRequest')">
			<span class="headline">Request</span>
		</div>
	</div>
	
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div id='reject_button' class="main-box infographic-box colored yellow-bg linkbutton" onclick="check('getReportRevenue')">
			<span class="headline">Revenue</span>
		</div>
	</div>							

	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div id='waiting_button' class="main-box infographic-box colored green-bg linkbutton" onclick="check('getReportTroughput')">
			<span class="headline">Troughput</span>
		</div>
	</div>

	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div id='notpaid_button' class="main-box infographic-box colored yellow-bg linkbutton" onclick="check('getReportResponseTime')">
			<span class="headline">Response Time</span>
		</div>
	</div>
	
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div id='complete_button' class="main-box infographic-box colored green-bg linkbutton" onclick="check('getReportCustomerId')">
			<span class="headline">Customer ID</span>
		</div>
	</div>

	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div id='complete_button' class="main-box infographic-box colored yellow-bg linkbutton" onclick="check('getReportECare')">
			<span class="headline">E-Care</span>
		</div>
	</div>	
	
	<div class="col-lg-3 col-sm-6 col-xs-12">
		<div id='complete_button' class="main-box infographic-box colored green-bg linkbutton" onclick="check('getReportResponseTimeRequest')">
			<span class="headline">Response Time Request</span>
		</div>
	</div>	
</div>


<div class="row" id="tabledata"></div>
<div id="modalplaceholder"></div>
<div id="dialogDoc1" style="display:none">
	<div>
		<iframe id="frameDoc1" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
	</div>
</div>
<div id="dialogDoc2" style="display:none">
	<div>
		<iframe id="frameDoc2" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
	</div>
</div>
<div id="dialogDoc3" style="display:none">
	<div>
		<iframe id="frameDoc3" style="position: absolute; width:100%;height: 100%; border: none"></iframe>
	</div>
</div>
<div id="dialogMultiDoc" style="display:none">
	<div class='separate_content'>
		<iframe id="frameDoc11" style="position: absolute; width:30%;height: 100%; border: none"></iframe>
	</div>
	<div class='separate_content'>
		<iframe id="frameDoc12" style="position: absolute; width:30%;height: 100%; border: none"></iframe>
	</div>
	<div class='separate_content'>
		<iframe id="frameDoc13" style="position: absolute; width:30%;height: 100%; border: none"></iframe>
	</div>
</div>
<div id="dialogViewReq"></div>
