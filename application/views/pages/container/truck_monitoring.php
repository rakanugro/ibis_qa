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
</style>

<script>
$(document).ready(function() { 
		$('.text_noreq').addClass('hidden_content');
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});
		
		$('#port').on('change', function(){
			var port = $("#port").val();
			console.log(port);
			if (port == "--IDPNJ-PNJI" || port == "--IDPNJ-PNJD"){
				$('.text_noreq').removeClass('hidden_content');
			}else{
				$('.text_noreq').addClass('hidden_content');
			} 

		});

	});

</script>
					<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Truck Monitoring</h2>
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
													<option 
													value="<?=$term["KODE_CABANG_SIMKEU"]?>-<?=$term["ID_PORT"]?>-<?=$term["PORT"].'-'.$term["TERMINAL"]?>" <?= $term["TERMINAL"]==$terminal_code? 'selected' : '' ?>>
													<?=$term["TERMINAL_NAME"]?>
													</option>
												<?php
												}
												?>
												</select>
										</div>
										
									<div class="form-group">
									<label> Truck ID <span class="text_noreq"> / No Request</span></label>
									 <div class="form-wrapper cf">
									      <input type="text" id="truck_id"
										  name="truck_id" placeholder="Search TID here.." title="Masukkan data Truk" required>
										  <button type="submit" onclick="search_container()">Search</button>
									  </div>
									</div>	
										<!--<div class="form-group example-twitter-oss">	
											<div class="form-group">
												<label for="exampleAutocomplete">Truck ID<font color="red">*</font></label>
												<input type="text" class="form-control" id="truck_id" name="truck_id" placeholder="Truck ID (Autocomplete)" title="Masukkan Truck ID" size="8">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">No Container</label>
												<input type="text" class="form-control" id="no_container" name="no_container" placeholder="No Container 1"  size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">No Container</label>
												<input type="text" class="form-control" id="no_container_" name="no_container_" placeholder="No Container 2"  size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<font color="red">*)field is required</font>
											</div>
										</div>-->
										
								</div>
							</div>
						</div>
					</div>

<div id="modalplaceholder"></div>					
<script>

function search_container(){
      var truck_id = $("#truck_id").val();
      var port       = $('#port').val();
      //var url = "<?=ROOT?>autocomplete/getVesselList";
	  
	  if(port == ''){
          $("#port").focus();
          alert('Pilih Terminal');
      }
	  
      if(truck_id == ''){
          $("#truck_id").focus();
          alert('Mohon diisi kolomnya');
      }
      else{
        $.get("<?=ROOT?>truck_container/auto_truck_monitoring?",{truck_id : truck_id, port: port}, function(data){
              $('#modalplaceholder').html(data).children().modal('show');
          });
      }

  }

</script>

					