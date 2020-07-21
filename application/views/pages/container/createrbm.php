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

</script>
					<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
									<div class="main-box-body clearfix">
										<header class="main-box-header clearfix">
									<h2>Create New RBM</h2>
								</header>

									<div class="main-box-body clearfix">
										<div class="form-group example-twitter-oss">
										<div class="form-group">
											<label for="exampleTooltip">Request Number</label>
											<input name="no_request" id="no_request" type="text" class="form-control" placeholder="-" data-toggle="tooltip" data-placement="bottom" title="Nomor Permintaan" size="20" readOnly>
										</div>
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control" onchange="cekTipeYd()">
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
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel</label>
                      <div class="form-wrapper cf">
										      <input type="text" id="vessel_autocomplete"
                          name="vessel_autocomplete" placeholder="Search here..." title="Masukkan data kapal" required>
                          <button type="submit" onclick="search_vessel()">Search</button>
                          <br>
                      </div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage In</label>
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" title="Masukkan data kapal" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage Out</label>
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" title="Masukkan data kapal" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ETA</label>
												<input type="text" class="form-control" id="eta" name="eta" placeholder="ETA" title="Masukkan data kapal" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ETD</label>
												<input type="text" class="form-control" id="etd" name="etd" placeholder="ETD" title="Masukkan data kapal" size="8" readonly>
											</div>
											<div class="form-group col-xs-12">
												<label for="exampleAutocomplete">Costumer</label>
												<input type="text" class="form-control" id="Costumer" name="Costumer">
										</div>
										<div class="form-group">
												<label>NPWP</label>
												<input type="text" class="form-control" id="NPWP" name="NPWP">

										</div>

										<div class="form-group">
												<label>Address</label>
												<input type="text" class="form-control" id="address" name="address">

										</div>
										
						
											</form>



										</div>
										<button id="submit_header" onclick="submitheader()" class="btn btn-success">Save</button>
								</div>
							</div>
						</div>
						
										</div>
								</div>
							</div>
						</div>
					</div>