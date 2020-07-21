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
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}<>|\[\]/\\]/gi, ''));
	});

	$('#trx_date').datepicker({ dateFormat: 'dd-mm-yy' });

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
/*
      $.post("<?=ROOT?>container_receiving/auto_pod_new",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                                                                    term: $( "#pod_autocomplete" ).val(),
                                                                    vessel: $("#vessel_autocomplete").val(),
                                                                    voyin: $("#voyage_in").val(),
                                                                    voyout: $("#voyage_out").val(),
                                                                    port: $('#port').val()
                                                                  },function(data){
          $("#comboPOD").html(data);
          $("#comboFPOD").html(data);
      });
	  */
  }


</script>
							<div class="row">
								<div class="col-lg-6">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Daily Report Invoice</h2>
											<?if($messages!='Ok')
											{?>
												<p><?=$messages;?></p></header>
												<?
											}
											else
											{?>
										</header>

											<div class="main-box-body clearfix">
											<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control">
												<option> -- Please Choose Terminal -- </option>
												<?php
												foreach($terminal as $term)
												{
												?>
													<option value="<?=$term["PORT"]?>-<?=$term["TERMINAL"]?>"><?=$term["TERMINAL_NAME"]?></option>
												<?php
												}
												?>
												</select>
										    </div>
                      <div class="form-group">
  											<label>Service </label>
  											<select id="service" name="service" class="form-control">
  											<option value=""> -- Please Choose Modul -- </option>
  											<option value="all"> All </option>
  											<option value="PTKM00"> Receiving </option>
  											<option value="PTKM01"> Delivery </option>
  											<option value="PTKM07"> Perpanjangan Delivery </option>
  											<option value="PTKM08"> Loading Cancel </option>
  											</select>
									    </div>
											<div class="form-group">
												<div class="form-group example-twitter-oss">
													<label>Transaction Date</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
														<input class="form-control" id="trx_date" name='trx_date' type="text">
													</div>
												</div>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">File Type</label>
												<select type="text" class="form-control" id="file" name="file" value="" placeholder="" style="width:50%;">
													<option value="EXCEL">EXCEL</option>
												</select>
											</div>
											<div class="form-group example-twitter-oss">
												<input type="button" onclick="submit_process()" value="Process" id="search_process" name="search_process" class="btn btn-success"/>
											</div>
											</div>
										<?}?>
									</div>
								</div>

							</div>

			<div class="row" id="tabledata"></div>
		</div>
	</div>
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
