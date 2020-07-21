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
	$.get("<?=ROOT?>container_alihkapal/search_vessel_caldl",{term : vesselname, port: port}, function(data){
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
	
});

	//search table js
	function load_table()
	{
		$.blockUI();
		var url = "<?=ROOT?>cont_inbout/search_tb_svcccl";
		var limit = $("#pagelimit").val();
		var port = $("#port").val();
		var ves = $("#vessel_autocomplete").val();
		var voyin = $("#voyage_in").val();
		var voyout = $("#voyage_out").val();
		var act = $("#act").val();
		var npe = $("#npe").val();
		var file = $("#file").val();

		$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
									page:1,
									limit:limit,
									port:port,
									ves:ves,
									voyin:voyin,
									voyout:voyout,
									act:act,
									npe:npe,
									file:file},function() {
										  $.unblockUI();
										});		
	}
	
	//search table js
	function submit_process()
	{
		//var url = "<?=ROOT?>approval_request/search_tb_svcccl";
		var port = $("#port").val();
		var ves = $("#vessel_autocomplete").val();
		var voyin = $("#voyage_in").val();
		var voyout = $("#voyage_out").val();
		var act = $("#act").val();
		var file = $("#file").val();
		var npe = $("#npe").val();
		
			window.open("<?=ROOT?>cont_inbout/excelfiles?port="+port+"&ves="+ves+"&voyin="+voyin+"&voyout="+voyout+"&act="+act+"&npe="+npe,'_blank');
		
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
											<h2>Data Status Container</h2>
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
											<!--
											<div class="form-group example-twitter-oss">
												<label for="exampleAutocomplete">Vessel</label>
												<input type="text" class="form-control" id="vessel_autocomplete" name="vessel_autocomplete" value="" placeholder="Auto Complete" style="width:80%;" />
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage In</label>
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" title="Masukkan data kapal" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage Out</label>
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" title="Masukkan data kapal" size="8" readonly>
											</div>			-->
											<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel</label>
										    <div class="form-wrapper cf">
												<input type="text" id="vessel_autocomplete"
												  name="vessel_autocomplete" placeholder="Search here..." title="Masukkan data kapal" required>
												<button type="submit" onclick="search_vessel()">Search</button>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage In</label>
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" title="Masukkan data kapal" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage Out</label>
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" title="Masukkan data kapal" readonly>
											</div>
											<input type="hidden" class="form-control" id="ukk" name="ukk" placeholder="autocomplete" title="Masukkan data kapal" readonly>
											<input type="hidden" id="vessel_code" name="vessel_code">
											<input type="hidden" id="voyage" name="voyage">
											<input type="hidden" id="call_sign" name="call_sign">
										</div>
											<div class="form-group col-xs-12">
												<label for="exampleAutocomplete">NPE</label>
												<input type="text" class="form-control" id="npe" name="npe" placeholder="NPE">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Activity</label>
												<select type="text" class="form-control" id="act" name="act" value="" placeholder="" style="width:70%;">
													<option value="INBOUND">INBOUND</option>
													<option value="OUTBOUND">OUTBOUND</option>
												</select>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">File Type</label>
												<select type="text" class="form-control" id="file" name="file" value="" placeholder="" style="width:50%;">
													<option value="EXCEL">EXCEL</option>
												</select>
											</div>							
											<div class="form-group example-twitter-oss">
												<input type="button" onclick="submit_process()" value="Process" id="search_process" name="search_process" class="btn btn-success"/>&nbsp;&nbsp;<input type="button" onclick="load_table()" value="View" id="load_table" name="load_table" class="btn btn-success"/>
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