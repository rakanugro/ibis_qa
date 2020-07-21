<script>
$( document ).ready(function() {
	var url = "<?=ROOT?>container/get_detail_delivery/view/<?=$request_data[0]['ID_REQ']?>/<?=$request_data[0]['ID_PORT']?>-<?=$request_data[0]['ID_TERMINAL']?>";
	$("#detail_container").load(url);
});

</script>

			<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Container</a></li>
										<li><a href="<?=ROOT?>/container/main_delivery">Delivery Booking</a></li>
										<li class="active"><span>View Booking</span></li>
									</ol>
									
									<h1>View Booking</h1>
								</div>
							</div>
							
					<div class="row">
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Booking Data</h2>
								</header>
								
									<div class="main-box-body clearfix">
										<div class="form-group">
											<label for="exampleTooltip">Request Number</label>
											<input name="no_request" id="no_request" type="text" class="form-control" placeholder="-" data-toggle="tooltip" data-placement="bottom" title="Nomor Permintaan" size="20" value="<?=$request_data[0]['ID_REQ']?>" readOnly>
										</div>
										<div class="form-group">
												<label>Terminal</label>
												<select class="form-control" id="terminal" name="terminal" disabled>
													<option></option>
													<?if($request_data[0]['ID_PORT']."-".$request_data[0]['ID_TERMINAL']=="IDJKT-T1D"){ ?>
														<option value="IDJKT-T1D" selected>Tanjung Priok - Terminal 1 Domestik</option>
													<? } else { ?>
														<option value="IDJKT-T1D">Tanjung Priok - Terminal 1 Domestik</option>
													<? } ?>
													<?if($request_data[0]['ID_PORT']."-".$request_data[0]['ID_TERMINAL']=="IDJKT-T2D"){ ?>
														<option value="IDJKT-T2D" selected>Tanjung Priok - Terminal 2 Domestik</option>
													<? } else { ?>
														<option value="IDJKT-T2D">Tanjung Priok - Terminal 2 Domestik</option>
													<? } ?>
													<?if($request_data[0]['ID_PORT']."-".$request_data[0]['ID_TERMINAL']=="IDJKT-T3D"){ ?>
														<option value="IDJKT-T3D" selected>Tanjung Priok - Terminal 3 Domestik</option>
													<? } else { ?>
														<option value="IDJKT-T3D">Tanjung Priok - Terminal 3 Domestik</option>
													<? } ?>
													<?if($request_data[0]['ID_PORT']."-".$request_data[0]['ID_TERMINAL']=="IDJKT-T3I"){ ?>
														<option value="IDJKT-T3I" selected>Tanjung Priok - Terminal 3 Internasional</option>
													<? } else { ?>
														<option value="IDJKT-T3I">Tanjung Priok - Terminal 3 Internasional</option>
													<? } ?>
													<?if($request_data[0]['ID_PORT']."-".$request_data[0]['ID_TERMINAL']=="IDJKT-L2"){ ?>
														<option value="IDJKT-T1D" selected>Tanjung Priok -Lini 2</option>
													<? } else { ?>
														<option value="IDJKT-T1D">Tanjung Priok - Lini 2</option>
													<? } ?>
													<?if($request_data[0]['ID_PORT']."-".$request_data[0]['ID_TERMINAL']=="IDJKT-L2"){ ?>
														<option value="IDPNK-TPK" selected>Pontianak - Terminal Petikemas</option>
													<? } else { ?>
														<option value="IDPNK-TPK">Pontianak - Terminal Petikemas</option>
													<? } ?>
													<?if($request_data[0]['ID_PORT']."-".$request_data[0]['ID_TERMINAL']=="IDJKT-ITOST"){ ?>
														<option value="IDPNK-ITOST" selected>Tanjung Priok - ITOS Tes Server</option>
													<? } else { ?>
														<option value="IDPNK-ITOST">Tanjung Priok - ITOS Tes Server</option>
													<? } ?>
												</select>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel / Voyage In - Voyage Out</label>
											<input type="text" class="form-control" id="vessel" name="vessel" placeholder="Auto Complete" title="Entry Vessel Data" value="<?=$request_data[0]['VESSEL']?>" Readonly>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage In</label>
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" title="Masukkan data kapal" size="8" value="<?=$request_data[0]['VOYAGE_IN']?>" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage Out</label>
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" title="Masukkan data kapal" size="8" value="<?=$request_data[0]['VOYAGE_OUT']?>" readonly>
											</div>
											<input type="hidden" id="id_vsb_voyage" name="id_vsb_voyage">
											<input type="hidden" id="vessel_code" name="vessel_code">
											<input type="hidden" id="voyage" name="voyage">
											<input type="hidden" id="call_sign" name="call_sign">
											<input type="hidden" id="date_discharge" name="date_discharge">
										</div>
										<div class="form-group">
												<label>Delivery Type</label>
												<select name="delivery_type" id="delivery_type" class="form-control" disabled>
													<?if($request_data[0]['TL_FLAG']=='N'){?></option>
														<option value="LAP" selected>Yard</option>
														<option value="TL">Truck Loosing</option>
													<?} else { ?>
														<option value="LAP">Yard</option>
														<option value="TL" selected>Truck Loosing</option>
													<?}?>
												</select>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">Delivery Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="delivery_date" name="delivery_date" type="text" class="form-control" id="datepickerDate" value="<?=$request_data[0]['DATE_DELIVERY']?>" Readonly>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">No BL</label>
											<input name="no_bl" id="no_bl" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor BL" size="10" value="<?=$request_data[0]['NO_BL']?>" Readonly>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Delivery Order Number</label>
											<input name="no_do" id="no_do" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor Delivery Order" size="10" value="<?=$request_data[0]['NO_DO']?>" Readonly>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">Delivery Order Maximum Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="do_date" name="do_date" type="text" class="form-control" id="datepickerDate" value="<?=$request_data[0]['DATE_DO']?>" Readonly>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">Delivery Order Upload</label>
											<input type="file" class="form-control" name="file_do" id="file_do" data-toggle="tooltip" data-placement="bottom" title="Upload Delivery Order" size="10">
										</div>
								</div>								
							</div>
						</div>	
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>*International Only</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<form role="form">
										<div class="form-group">
											<label for="exampleTooltip">SPPB Number</label>
											<input id="no_sppb" name="no_sppb" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor SPPB" value="<?=$request_data[0]['NO_SPPB']?>" Readonly>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">SPPB Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sppb_date" name="sppb_date" type="text" class="form-control" id="datepickerDate" value="<?=$request_data[0]['DATE_SPPB']?>" Readonly>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SPPB Upload</label>
											<input id="file_sppb" name="file_sppb"type="file" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload SPPB">
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SP Custom Number</label>
											<input id="no_sp_custom" name="no_sp_custom"type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Nomor SP Custom" size="10" value="<?=$request_data[0]['NO_SP_CUSTOM']?>" Readonly>
										</div>
										<div class="form-group col-md-12">
											<label for="datepickerDate">SP Custom Date</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input id="sp_custom_date" name="sp_custom_date" type="text" class="form-control" id="datepickerDate" value="<?=$request_data[0]['DATE_SP_CUSTOM']?>" Readonly>
											</div>
											<span class="help-block">format dd-mm-yyyy</span>
										</div>
										<div class="form-group">
											<label for="exampleTooltip">SP Custom Upload</label>
											<input id="file_sp_custom" name="file_sp_custom" type="file" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="Upload SP Custom" size="10">
										</div>
									</form>
								</div>		
							</div>
						</div>	
					</div>
					<div id="detail_container" class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Container List</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><span>Container Number</span></a></th>
													<th><span>Size</span></a></th>
													<th><span>Type</span></a></th>
													<th><span>Status</span></a></th>
													<th><span>Height</span></a></th>
													<th><span>Hazard</span></a></th>
													<th><span>Carrier</span></a></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<a href="#">-</a>
													</td>
													<td>
														-
													</td>
													<td>
														<a href="#">-</a>
													</td>
													<td>
														<a href="#">-</a>
													</td>
													<td>
														-
													</td>
													<td>
														<a href="#">-</a>
													</td>
													<td>
														<a href="#">-</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<button onclick="save_req()" class="btn btn-success" name="button_add_detail" id="button_add_detail">Save</button>
									<button type="submit" onclick="window.open('<?=ROOT.'container/main_delivery'?>','_self')" class="btn btn-success">Next</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
					