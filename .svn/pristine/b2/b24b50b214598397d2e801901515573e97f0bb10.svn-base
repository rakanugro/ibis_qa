<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Administrasi</li>
			<li class="active"><span>Master Unit</span></li>
		</ol>
		<h1>MASTER UNIT</h1>
	</div>
</div>

<div class="container">
    <div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal" id="formSearch" action="javascript:void(0);">
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Nama Unit</label>
											<div class="row">
												<div class="col-xs-5">
						                  			<input type="text" name="INV_UNIT_NAME2" id="INV_UNIT_NAME2" class="form-control" placeholder="Nama Unit">
						                		</div>
					                		</div>
					             		</div>
				             		</div>
								</div>
							</div>


								<div class="box-body">
							            <div class="col-sm-12 text-right">
								              <button type="button" onclick="clearreset()"  class="btn btn-primary btn-sm" data-toggle="" data-target=""> Clear</button>
								              <button type="submit" onclick="loaddata()" ac class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i> Search</a></button>
							          		<!-- </div> -->
							            </div>
			  					</div>


						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<div class="container text-right">
	<div class="box-body">
		<div class="form-group">
         <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_unit"><i class="fa fa-plus"></i></button>
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
	    <div class="clo-lg-12">
		    <div class="main-box clearfix">
			    <div class="main-box-body clearfix">
				    <div class="table-responsive">
					    <table id="mastertable" class="table table-hover">
						    <thead>
							    <tr>
								<th>No</th>
								<th width="26%">Kode Unit</th>
								<th width="26%">Kode Org</th>
								<th width="26%">Nama Unit</th>
								<th >Ket</th>
							    </tr>
						    </thead>
						   <tbody id=show_data>
						   </tbody>

					    </table>
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
</div>

<div id="add_unit" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Add Unit</h4>
	        </div>
	        <div class="modal-body">
		            <div class="form-group">
	                	<div class="box-body">
							<div class="main-box-body clearfix">
								<div class="tabs-wrapper">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-home" data-toggle="tab">General</a></li>
										<!-- <li><a href="#tab-home" data-toggle="tab">General</a></li> -->
										<li><a href="#tab-materai" data-toggle="tab">Materai</a></li>
										</ul>
									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-home">
											<form class="form-horizontal">
												<!-- <div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Org Id</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" value="" name="INV_UNIT_KODE" id="INV_UNIT_KODE" class="form-control" placeholder="Org Id"/>
															</div>
														</div>
													</div>
												</div> -->



												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Org ID</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="number" name="INV_UNIT_ORGID" id="INV_UNIT_ORGID" class="form-control" value="" placeholder="Org ID" value="" data-error="required" required>
															</div>
															<div class="help-block with-errors"></div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Kode Unit</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_UNIT_CODE" id="INV_UNIT_CODE" class="form-control" placeholder="Kode Unit">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Nama Unit</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_UNIT_NAME" id="INV_UNIT_NAME" class="form-control" placeholder="Nama Unit">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Entity</label>
														<div class="row">
															<div class="col-sm-5">
																<select class="form-control select2"  name="INV_ENTITY_CODE" id="INV_ENTITY_CODE">
																	<?php foreach($entity as $entityid) { ?>
																		<option value="<?php echo $entityid->INV_ENTITY_CODE;?>"><?php echo $entityid->INV_ENTITY_NAME;?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Lokasi Unit</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_UNIT_LOCATION" id="INV_UNIT_LOCATION" class="form-control" placeholder="Lokasi Unit">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Alamat</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_UNIT_ALAMAT" id="INV_UNIT_ALAMAT" class="form-control" placeholder="Alamat"></textarea>
															</div>
														</div>
													</div>
												</div>


												<!-- <div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Status</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" style="width: 100%;"  value=""
																name="INV_UNIT_STATUS" id="INV_UNIT_STATUS">
																	<option value="Active">Active</option>
																	<option value="Not Active">Not Active</option>
																</select>
															</div>
														</div>
													</div>
												</div> -->
											</form>
										</div>

						<div class="tab-pane fade" id="tab-materai">
							<table id="table-example" class="table table-hover">
									<thead>
										<tr>

											<th>Nota Kapal</th>
											<th>Nota Petikemas</th>
											<th>Nota Barang</th>
											<th>Nota Rupa-Rupa</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<tr>
										<td><center><input type="checkbox" id="INV_UNIT_KAPAL" name="INV_UNIT_KAPAL" ></center></td>
										<td><center><input type="checkbox" id="INV_UNIT_PETIKEMAS" name="INV_UNIT_PETIKEMAS" ></center></td>
										<td><center><input type="checkbox" id="INV_UNIT_BARANG" name="INV_UNIT_BARANG" ></center></td>
										<td><center><input type="checkbox" id="INV_UNIT_RUPARUPA" name="INV_UNIT_RUPARUPA" ></center></td>
									</tr>
									</tbody>
							</table>
					</div>
				</div>

					<div class="modal-footer">
							<button  type="button"  id="submit" name="submit" onclick="check_validation()" class="btn btn-primary btn-sm">Save</button>
							<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
					</div>
			</div>
		</div>
	</div>
	</div>
	        </div>
	    </div>
	</div>
</div>

<div id="add_config" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Nota Config</h4>
	        </div>
	        <div class="modal-body" style="overflow-y: scroll;height: 300px;">
			<form id="form1">

	        <div class="form-group">
	                	<div class="box-body">
							<div class="main-box-body clearfix">
								<div class="tabs-wrapper">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-pejabat" data-toggle="tab">Pejabat</a></li>
										<!-- <li><a href="#tab-home" data-toggle="tab">General</a></li> -->
										<li><a href="#tab-redaksi" data-toggle="tab">Redaksi</a></li>
									</ul>
								</div>
							</div>
							<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-pejabat">
											<form class="form-horizontal">

												<div class="table-responsive">
													<table id="table-pejabat" class="table table-hover">
														<thead>
																<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_notconf"><i class="fa fa-plus"></i></button>
																<br\>
																<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#update_notconf"><i class="fa fa-pencil-square"></i></button> -->
																<tr>
																	<th>No</th>
																	<th>Nama pejabat</th>
																	<th>Jabatan</th>
																	<th>Valid From</th>
																	<th>Valid To</th>
																	<th>Status Cetak</th>
																</tr>
														</thead>
										 				<tbody id="show_pejabat">
														</tbody>
													</table>
												</div>

												<div class="modal-footer">
													<!-- <button  type="button"  id="submit" name="submit" onclick="saveredaksi()" class="btn btn-primary" data-dismiss="modal">Save Redaksi</button> -->
													<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
												</div>
											</form>
										</div>

										<div class="tab-pane fade" id="tab-redaksi">
											<form class="form-horizontal">

												<div class="table-responsive">
													<table id="table-redaksi" class="table table-hover">
														<thead>
																<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_redaksi"><i class="fa fa-plus"></i></button>
																<br\>
																<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#update_notconf"><i class="fa fa-pencil-square"></i></button> -->
																<tr>
																	<th>No</th>
																	<th>Nama Nota</th>
																	<th>Redaksi Body</th>
																	<th>Redaksi Footer</th>
																	<th>Redaksi Pajak</th>
																	<th>Valid From</th>
																	<th>Valid To</th>
																	<th>Action</th>
																</tr>
														</thead>
										 				<tbody id="show_redaksi">
														</tbody>
													</table>
												</div>

												<div class="modal-footer">
													<!-- <button  type="button"  id="submit" name="submit" onclick="saveredaksi()" class="btn btn-primary" data-dismiss="modal">Save Redaksi</button> -->
													<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
												</div>
											</form>
										</div>
												</div>
								</table>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="add_notconf" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Add Nota Config</h4>
	        </div>
	        	<div class="modal-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-home">
								<form class="form-horizontal" action="javascript:void(0);" id="formAddNotConf">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Nama Pejabat Nota</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" value="" name="INV_PEJABAT_NAME" id="INV_PEJABAT_NAME" class="form-control" placeholder="Pejabat Nota"/>
												</div>
											</div>
										</div>
									</div>

									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Nipp</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="INV_PEJABAT_NIPP" id="INV_PEJABAT_NIPP" class="form-control" placeholder="NIPP">
												</div>
											</div>
										</div>
									</div>
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Jabatan</label>
												<div class="row">
													<div class="col-xs-5">
														<input type="text" name="INV_PEJABAT_JABATAN" id="INV_PEJABAT_JABATAN" class="form-control" placeholder="Jabatan">
													</div>
												</div>
											</div>
										</div>
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">TTD</label>
											<div class="row">
												<div class="col-xs-5">
													<!-- <div class="col-xs-5">
																<input type="file" accept=".jpg, .jpeg, .png" name="INV_ENTITY_LOGO" id="INV_ENTITY_LOGO" placeholder="Logo" onchange="PreviewImage();">
																<div id="uploadPreviewDiv">
																<img id="uploadPreview" style="width: 150px; height: 150px;"/>
																</div>
													</div> -->
													<!-- <input type="file" name="INV_PEJABAT_TTD" id="INV_PEJABAT_TTD" placeholder="Logo" accept="image/*" onchange="PreviewImage();"> -->
													<input type="file" accept=".jpg, .jpeg, .png" name="INV_PEJABAT_TTD" id="INV_PEJABAT_TTD" placeholder="Logo" onchange="PreviewImage();">
													<div id="uploadPreviewDiv">
													<img id="uploadPreview" style="width: 150px; height: 150px;"/>
												</div>
											</div>
										</div>
									</div>


									<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Valid</label>
													<div class="row">
														<div class="col-xs-4">
															<input type="date" class="form-control" name="INV_PEJABAT_EFECTIVE" id="INV_PEJABAT_EFECTIVE" placeholder="dd/mm/yyyy" />
														</div>
														<div class="col-xs-4">
															<input type="date" class="form-control" name="INV_PEJABAT_EXPIRED" id="INV_PEJABAT_EXPIRED" placeholder="dd/mm/yyyy" />
														</div>

													</div>
												</div>
											</div>
									</div>
									<!-- style="display: none;" -->
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
									<input type="hidden" id="INV_UNIT_ID_ADD_PEJABAT" name="INV_UNIT_ID">
									<input type="hidden" name="INV_PEJABAT_STATUS" value="Tidak">
									<input type="hidden"  id="INV_PEJABAT_EFECTIVETEMP" name="INV_PEJABAT_EFECTIVETEMP">
									<input type="hidden"  id="INV_PEJABAT_EXPIREDTEMP" name="INV_PEJABAT_EXPIREDTEMP">
									<input  type="submit" style="display: none;" name="submit" id="submitAddPejabat">
									<!-- <div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Status Cetak</label>
												<div class="row">
													<div class="col-xs-3">
														<select class="form-control select2" id="INV_PEJABAT_STATUS" name="INV_PEJABAT_STATUS" style="width: 100%;">
															<option>Ya</option>
															<option>Tidak</option>
														</select>
													</div>
												</div>
										</div>
									</div> -->
								</form>
								</div>
									<div class="modal-footer">
										<button  type="button"  id="submit" name="submit" onclick="check_validation1()" class="btn btn-primary btn-sm">Save</button>
										<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
										<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_entity">Save</button>
														   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
															<input style="display: none;" type="submit" name="submit" id="submitAddEntity"> -->
									</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>


<div id="update_notaconf" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Edit Nota Config</h4>
	        </div>
	        	<div class="modal-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-home">
								<form class="form-horizontal" action="javascript:void(0);" id="formEditNotConf">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Nama Pejabat Nota</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" value="" name="INV_PEJABAT_NAME1" id="INV_PEJABAT_NAME1" class="form-control" placeholder="Pejabat Nota"/>
												</div>
											</div>
										</div>
									</div>

									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Nipp</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="INV_PEJABAT_NIPP1" id="INV_PEJABAT_NIPP1" class="form-control" placeholder="NIPP">
												</div>
											</div>
										</div>
									</div>
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Jabatan</label>
												<div class="row">
													<div class="col-xs-5">
														<input type="text" name="INV_PEJABAT_JABATAN1" id="INV_PEJABAT_JABATAN1" class="form-control" placeholder="Jabatan">
													</div>
												</div>
											</div>
										</div>
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">TTD</label>
											<div class="row">
												<div class="col-xs-5">
													<!-- <input type="file" name="INV_PEJABAT_TTD" id="INV_PEJABAT_TTD" placeholder="Logo" onchange="PreviewImage();">
													<div id="uploadPreviewDiv">
													<img id="uploadPreview" style="width: 150px; height: 150px;"/> -->
													<input type="file" name="INV_PEJABAT_TTD1" id="INV_PEJABAT_TTD1" placeholder="Logo" accept="image/*" onchange="PreviewEdit();">
													<!-- <div id="uploadPreviewDiv"> -->
													<input type="hidden" name="INV_PEJABAT_TTD_NOTIF" id="INV_PEJABAT_TTD_NOTIF">
													<img id="uploadPreviewEdit" style="width: 150px; height: 150px;"/>
												</div>
											</div>
										</div>
									</div>

									<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Valid</label>
													<div class="row">
														<div class="col-xs-4">
															<input type="date" name="INV_PEJABAT_EFECTIVE1" id="INV_PEJABAT_EFECTIVE1" class="form-control" placeholder="dd/mm/yyyy" />
														</div>
														<div class="col-xs-4">
															<input type="date" name="INV_PEJABAT_EXPIRED1" id="INV_PEJABAT_EXPIRED1" class="form-control" placeholder="dd/mm/yyyy" />
														</div>

													</div>
												</div>
											</div>
									</div>
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Status Cetak</label>
												<div class="row">
													<div class="col-xs-3">
														<select class="form-control select2" name="INV_PEJABAT_STATUS1" id="INV_PEJABAT_STATUS1" style="width: 100%;">
															<option value="Ya">Ya</option>
															<option value="Tidak">Tidak</option>
														</select>
													</div>
												</div>
										</div>
									</div>
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
									<input type="hidden" id="INV_UNIT_ID_ADD_PEJABAT_EDIT" name="INV_UNIT_ID">
									<input type="hidden"  id="INV_PEJABAT_EFECTIVETEMP_EDIT" name="INV_PEJABAT_EFECTIVETEMP">
									<input type="hidden"  id="INV_PEJABAT_ID" name="INV_PEJABAT_ID">
									<input type="hidden"  id="INV_PEJABAT_EXPIREDTEMP_EDIT" name="INV_PEJABAT_EXPIREDTEMP">
									<input style="display: none;" type="submit" name="submit" id="submitEditPejabat">
							</form>
								</div>
									<div class="modal-footer">
										<button  type="button"  id="submit" name="submit" onclick="confirmation4()" class="btn btn-primary btn-sm" data-dismiss="modal">Update</button>
										<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
									</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>


<div id="update_unit" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white" class="modal-title">Update Unit</h4>
	        </div>
	        <div class="modal-body">
			<form id="form1">
		            <div class="form-group">
	                	<div class="box-body">
							<div class="main-box-body clearfix">
								<div class="tabs-wrapper">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-gen" data-toggle="tab">General</a></li>
										<!-- <li><a href="#tab-home" data-toggle="tab">General</a></li> -->
										<li><a href="#tab-mat" data-toggle="tab">Materai</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-gen">
											<form class="form-horizontal">
												<!-- <div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Org Id</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" value="" name="INV_UNIT_CODE" id="INV_UNIT_CODE" class="form-control" placeholder="Org Id"/>
															</div>
														</div>
													</div>
												</div> -->
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Org ID</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="number" name="INV_UNIT_ORGID1" id="INV_UNIT_ORGID1" class="form-control" placeholder="Kode Unit" data-error="tes" required>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Kode Unit</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_UNIT_CODE1" id="INV_UNIT_CODE1" class="form-control" placeholder="Kode Unit">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Nama Unit</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_UNIT_NAME1" id="INV_UNIT_NAME1" class="form-control" placeholder="Nama Unit">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Entity</label>
														<div class="row">
															<div class="col-sm-5">
																<select class="form-control select2"  name="INV_ENTITY_CODE1" id="INV_ENTITY_CODE1" >
																	<?php foreach($entity as $entityid) { ?>
																		<option value="<?php echo $entityid->INV_ENTITY_CODE;?>"><?php echo $entityid->INV_ENTITY_NAME;?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
												</div>

												<!-- <div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Wilayah</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" style="width: 100%;">
																	<option>TJ PRIOK</option>
																	<option>Banten</option>
																	<option>Jambi</option>
																</select>
															</div>
														</div>
													</div>
												</div> -->


												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Lokasi Unit</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_UNIT_LOCATION1" id="INV_UNIT_LOCATION1" class="form-control" placeholder="Lokasi Unit">
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Alamat</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_UNIT_ALAMAT1" id="INV_UNIT_ALAMAT1" class="form-control" placeholder="Alamat"></textarea>
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Status</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" style="width: 100%;"
																name="INV_UNIT_STATUS1" id="INV_UNIT_STATUS1">
																	<option value="Active">Active</option>
																	<option value="Not Active">Not Active</option>
																</select>
															</div>
														</div>
													</div>
												</div>

											</form>
										</div>

						<div class="tab-pane fade" id="tab-mat">
							<table id="table-example" class="table table-hover">
									<thead>
										<tr>

											<th>Nota Kapal</th>
											<th>Nota Petikemas</th>
											<th>Nota Barang</th>
											<th>Nota Rupa-Rupa</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<tr>
									<tr>
										<td><center><input type="checkbox" id="INV_UNIT_KAPAL1" name="INV_UNIT_KAPAL1" ></center></td>
										<td><center><input type="checkbox" id="INV_UNIT_PETIKEMAS1" name="INV_UNIT_PETIKEMAS1" ></center></td>
										<td><center><input type="checkbox" id="INV_UNIT_BARANG1" name="INV_UNIT_BARANG1" ></center></td>
										<td><center><input type="checkbox" id="INV_UNIT_RUPARUPA1" name="INV_UNIT_RUPARUPA1" ></center></td>
									</tr>
									</tr>
									</tbody>
							</table>
					</div>
						<div class="modal-footer">
							<button  type="button"  id="submit" name="submit" onclick="confirmation1()" class="btn btn-primary btn-sm" data-dismiss="modal">Update</button>
							<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
						</div>
				</div>
			</div>
		</div>
	</div>
	</div>
		   </form>
	        </div>
	    </div>
	</div>
</div>


<div id="add_redaksi" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Add Redaksi Config</h4>
	        </div>
	        	<div class="modal-body">
					<form  action="javascript:void(0);" id="formAddRedaksi">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-home">
								<form class="form-horizontal">
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Layanan</label>
														<div class="row">
															<div class="col-xs-3">
																<select  onChange="refreshRedaksi()" class="form-control select2" name="INV_NOTA_LAYANAN" id="INV_NOTA_LAYANAN">
																	<option value="PETIKEMAS">PETIKEMAS</option>
																	<option value="BARANG">BARANG</option>
																	<option value="RUPA-RUPA">RUPA-RUPA</option>
																	<option value="KAPAL">KAPAL</option>
																</select>

															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Nama Nota</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" onChange="editredaksi()" id="INV_NOTA_JENIS" name="INV_NOTA_JENIS" style="width: 100%;">
																<?php foreach($nota as $jenis) { ?>
																		<option value="<?php echo $jenis->INV_NOTA_JENIS;?>"><?php echo $jenis->INV_NOTA_JENIS;?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Redaksi Body</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_REDAKSI_ATAS1" id="INV_REDAKSI_ATAS1" class="form-control" placeholder="Redaksi Body"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Redaksi Footer</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_REDAKSI_BAWAH1" id="INV_REDAKSI_BAWAH1" class="form-control" placeholder="Redaksi Footer"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Redaksi Bebas Pajak</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_REDAKSI_PAJAK1" id="INV_REDAKSI_PAJAK1" class="form-control" placeholder="Redaksi Bebas Pajak"></textarea>
															</div>
														</div>
													</div>
												</div>												
												<div class="box-body">
															<div class="form-group">
																<label for="" class="col-sm-2 control-label">Valid</label>
																<div class="row">
																	<div class="col-xs-4">
																		<input type="date" class="form-control" name="INV_REDAKSI_EFECTIVE1" id="INV_REDAKSI_EFECTIVE1" placeholder="dd/mm/yyyy" />
																	</div>
																	<div class="col-xs-4">
																		<input type="date" class="form-control" name="INV_REDAKSI_EXPIRED1" id="INV_REDAKSI_EXPIRED1" placeholder="dd/mm/yyyy" />
																	</div>

																</div>
															</div>
														</div>
												</div>

								</form>
								</div>
									<div class="modal-footer">
										<button  type="button"  id="submit" name="submit" onclick="confirmation3()" class="btn btn-primary btn-sm" data-dismiss="modal">Save</button>
										<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
									</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="update_redaksi" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Edit Redaksi Config</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1" action="javascript:void(0);">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-home">
								<form class="form-horizontal" action="javascript:void(0);">
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Nama Nota</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2"  id="INV_NOTA_JENIS2" name="INV_NOTA_JENIS2" style="width: 100%;">
																<?php foreach($nota as $jenis) { ?>
																		<option><?php echo $jenis->INV_NOTA_JENIS;?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Redaksi Body</label>
														<div class="row">
															<div class="col-xs-5">
																<!--textarea type="text" name="INV_REDAKSI_NOTE2" id="INV_REDAKSI_NOTE2" class="form-control" placeholder="Redaksi Body"></textarea-->
																<textarea type="text" name="INV_REDAKSI_ATAS2" id="INV_REDAKSI_ATAS2" class="form-control" placeholder="Redaksi Body"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Redaksi Footer</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_REDAKSI_BAWAH2" id="INV_REDAKSI_BAWAH2" class="form-control" placeholder="Redaksi Footer"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Redaksi Pajak</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_REDAKSI_PAJAK2" id="INV_REDAKSI_PAJAK2" class="form-control" placeholder="Redaksi Pajak"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
															<div class="form-group">
																<label for="" class="col-sm-2 control-label">Valid</label>
																<div class="row">
																	<div class="col-xs-4">
																		<input type="date" class="form-control" name="INV_REDAKSI_EFECTIVE2" id="INV_REDAKSI_EFECTIVE2" placeholder="Effective" />
																	</div>
																	<div class="col-xs-4">
																		<input type="date" class="form-control" name="INV_REDAKSI_EXPIRED2" id="INV_REDAKSI_EXPIRED2" placeholder="Expired" />
																	</div>

																</div>
															</div>
														</div>
												</div>

								</form>
								</div>
									<div class="modal-footer">
										<button  type="button"  id="submit" name="submit" onclick="updateredaksiconfirm()" class="btn btn-primary btn-sm" data-dismiss="modal">Update</button>
										<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
									</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>



<div class="modal fade" id="UnitSave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title" id="myModalLabel">Save Unit</h4> -->
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" name="kode" id="textkode" value=""> -->
                <h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
            </div>
            <div class="modal-footer">
            	<button class=" btn btn-primary" id=""  data-dismiss="modal" onclick="saveunit()">Ya</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="RedaksiCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title" id="myModalLabel">Save Unit</h4> -->
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" name="kode" id="textkode" value=""> -->
                <h1>Silahkan isi semua form yang ada!</h1>
            </div>
            <div class="modal-footer">
            	<button class=" btn btn-primary" data-dismiss="modal" id="">Ok</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UpdateUnitCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title" id="myModalLabel">Save Unit</h4> -->
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" name="kode" id="textkode" value=""> -->
                <h1>Silahkan isi semua form yang ada!</h1>
            </div>
            <div class="modal-footer">
            	<button class=" btn btn-primary" data-dismiss="modal" id="">Ok</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PejabatCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title" id="myModalLabel">Save Unit</h4> -->
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" name="kode" id="textkode" value=""> -->
                <h1>Silahkan isi semua form yang ada!</h1>
            </div>
            <div class="modal-footer">
            	<button class=" btn btn-primary"  data-dismiss="modal" id="">Ok</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UnitCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title" id="myModalLabel">Save Unit</h4> -->
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" name="kode" id="textkode" value=""> -->
                <h1>Silahkan isi semua form yang ada!</h1>
            </div>
            <div class="modal-footer">
            	<button class=" btn btn-primary" data-dismiss="modal" id="">Ok</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UnitUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style="color: white;">Update Unit</h4>
            </div>
           <div class="modal-body">
               <!--  <input type="hidden" name="kode" id="textkode" value=""> -->
                <h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" id="" data-dismiss="modal" onclick="updateunit()">Ya</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AddUnitPejabat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style="color: white;">Save Pejabat</h4>
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" name="kode" id="textkode" value=""> -->
                <h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
            </div>
            <div class="modal-footer">
            	<button class="btn_hapus btn btn-primary" id="" onclick="savepejabat()" data-dismiss="modal">Ya</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UpdatePejabatConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style="color: white;">Update Pejabat</h4>
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" name="kode" id="textkode" value=""> -->
                <div><h1>Apakah Anda yakin merubah data ini ?</h1></div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" id="" data-dismiss="modal" onclick="updatepejabat()">Ya</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UpdateRekasiConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Update Redaksi</h4>
            </div>
            <form class="form-horizontal" action="javascript:void(0);">
            <div class="modal-body">
                <!-- <input type="hidden" name="kode" id="textkode" value=""> -->
                <div><h1>Apakah Anda yakin merubah data ini ?</h1></div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" id="" onclick="updateredaksi()">Ya</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="AddRekasiConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Save Redaksi</h4>
            </div>
            <!-- <div class="modal-body">
                <input type="hidden" name="kode" id="textkode" value="">
                <div class="alert alert-warning"><p>Apakah Anda yakin menyimpan data ini ?</p></div>
            </div> -->
            <div class="modal-body">
                <input type="hidden" name="kode" id="textkode" value="">
                <h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" id="" data-dismiss="modal" onclick="saveredaksi()">Ya</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" value="" name="ROWID" id="ROWID" class="form-control"/></input>
<input type="hidden" value="" name="ROWID1" id="ROWID1" class="form-control"/></input>
<input type="hidden" value="" name="ROWID2" id="ROWID2" class="form-control"/></input>
<!-- <div>
<textarea type="hidden" name="ROWID" id="ROWID" class="form-control"></textarea>
<textarea type="hidden" name="ROWID1" id="ROWID1" class="form-control"></textarea>
<textarea type="hidden" name="ROWID2" id="ROWID2" class="form-control"></textarea>
</div> -->

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script> -->

<script type="text/javascript">
function PreviewImage() {
var oFReader = new FileReader();
oFReader.readAsDataURL(document.getElementById("INV_PEJABAT_TTD").files[0]);
oFReader.onload = function (oFREvent)
 {
    document.getElementById("uploadPreview").src = oFREvent.target.result;
};
};
</script>

<script type="text/javascript">
function PreviewEdit() {
var oFReader = new FileReader();
oFReader.readAsDataURL(document.getElementById("INV_PEJABAT_TTD1").files[0]);
oFReader.onload = function (oFREvent)
 {
    document.getElementById("uploadPreviewEdit").src = oFREvent.target.result;
};
};
</script>
<!-- <script>
 $('#INV_PEJABAT_EFECTIVE').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

    $('#INV_PEJABAT_EXPIRED').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });
    $('#INV_REDAKSI_EFECTIVE1').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

    $('#INV_REDAKSI_EXPIRED1').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

		$('#INV_REDAKSI_EFECTIVE2').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy',
			startDate: '-3d'
		});

		$('#INV_REDAKSI_EXPIRED2').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy',
			startDate: '-3d'
		});



    $('#INV_PEJABAT_EFECTIVE1').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

    $('#INV_PEJABAT_EXPIRED1').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });
</script> -->

<script>
var INV_UNIT_ID ;
var INV_PEJABAT_ID ;
$( document ).ready(function() {

	loaddata();
	refreshRedaksi();

	$("#formAddNotConf").on('submit',(function(e) {
		e.preventDefault();

		$('#INV_UNIT_ID_ADD_PEJABAT').val(INV_UNIT_ID);
		$('#INV_PEJABAT_EFECTIVETEMP').val(SetDate($('#INV_PEJABAT_EFECTIVE').val())) ;
		$('#INV_PEJABAT_EXPIREDTEMP').val(SetDate($('#INV_PEJABAT_EXPIRED').val())) ;
		path = "<?php echo ROOT.'einvoice/administrasi/masterpejabatsave';?>";
		$.ajax({
			// url: self.baseUrl+"ajaxAddQuotes", // Url to which the request is send
			url: path, // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(resp)   // A function to be called if request succeeds
			{
				try {
					var result = JSON.parse(resp);
					if (result.status == "success") {
						location.reload();
						$('#uploadPreviewDiv').html('<img id="uploadPreview" style="width: 150px; height: 150px;"/>')

					} else {
						alert("data gagal disimpan");
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}
			}
		});
	}));

	$("#formEditNotConf").on('submit',(function(e) {
		e.preventDefault();

		$('#INV_UNIT_ID_ADD_PEJABAT_EDIT').val(INV_UNIT_ID);
		$('#INV_PEJABAT_EFECTIVETEMP_EDIT').val(SetDate($('#INV_PEJABAT_EFECTIVE1').val())) ;
		$('#INV_PEJABAT_EXPIREDTEMP_EDIT').val(SetDate($('#INV_PEJABAT_EXPIRED1').val())) ;
		path = "<?php echo ROOT.'einvoice/administrasi/masterpejabatupdate';?>";
		$.ajax({
			// url: self.baseUrl+"ajaxAddQuotes", // Url to which the request is send
			url: path, // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(resp)   // A function to be called if request succeeds
			{
				try {
					var result = JSON.parse(resp);
					if (result.status == "success") {
						location.reload();
						$('#uploadPreviewDiv').html('<img id="uploadPreview" style="width: 150px; height: 150px;"/>')

					} else {
						alert("data gagal disimpan");
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}
			}
		});
	}));


		//table-materai

	/*$('#table-materai').dataTable({
		"responsive": true,
		"bPaginate": true,
		"bLengthChange": false,
		"bFilter": false,
		"bInfo": false,
		"pageLength": 5,
		"iDisplayLength": 5,
		"bAutoWidth": false });*/

	});
    $("#formSearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

	function clearreset(){
		window.location.reload(true);
	}

	function confirmation(){
		$('#UnitSave').modal('show');
	}

	function confirmation1(){
		$('#UnitUpdate').modal('show');
		// alert('insert data sukses!');
	}

	function check_validation() {
		var INV_UNIT_ORGID = document.getElementById('INV_UNIT_ORGID').value;
		var INV_UNIT_CODE = document.getElementById('INV_UNIT_CODE').value;
		var INV_UNIT_NAME = document.getElementById('INV_UNIT_NAME').value;
		var INV_UNIT_LOCATION = document.getElementById('INV_UNIT_LOCATION').value;
		var INV_UNIT_ALAMAT = document.getElementById('INV_UNIT_ALAMAT').value;
		
		if(INV_UNIT_ORGID == "" || INV_UNIT_CODE == "" || INV_UNIT_NAME == "" || INV_UNIT_NAME == "" || INV_UNIT_LOCATION == "") {
			$('#UnitCheck').modal('show');
		} else {
			$('#UnitSave').modal('show');
			$('#add_unit').modal('hide');

		}

	}

	function check_validation1() {
		var INV_PEJABAT_NAME = document.getElementById('INV_PEJABAT_NAME').value;
		var INV_PEJABAT_NIPP = document.getElementById('INV_PEJABAT_NIPP').value;
		var INV_PEJABAT_JABATAN = document.getElementById('INV_PEJABAT_JABATAN').value;
		var INV_PEJABAT_EFECTIVE = document.getElementById('INV_PEJABAT_EFECTIVE').value;
		var INV_PEJABAT_EXPIRED = document.getElementById('INV_PEJABAT_EXPIRED').value;

		if(INV_PEJABAT_NAME == "" || INV_PEJABAT_NIPP == "" || INV_PEJABAT_JABATAN == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED == "") {
			$('#UnitCheck').modal('show');
		} else {
			confirmation2();
		}

	}

	function confirmation2(){

		var INV_PEJABAT_NAME = document.getElementById('INV_PEJABAT_NAME').value;
		var INV_PEJABAT_NIPP = document.getElementById('INV_PEJABAT_NIPP').value;
		var INV_PEJABAT_JABATAN = document.getElementById('INV_PEJABAT_JABATAN').value;
		var INV_PEJABAT_EFECTIVE = document.getElementById('INV_PEJABAT_EFECTIVE').value;
		var INV_PEJABAT_EXPIRED = document.getElementById('INV_PEJABAT_EXPIRED').value;

		if(INV_PEJABAT_NAME == "" || INV_PEJABAT_NIPP == "" || INV_PEJABAT_JABATAN == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED ==""){
			$('#PejabatCheck').modal('show');

		}else{

		$('#AddUnitPejabat').modal('show');
		// alert('insert data sukses!');
		}
	}

	function confirmation3(){
		var INV_REDAKSI_ATAS = document.getElementById('INV_REDAKSI_ATAS1').value;
		var INV_REDAKSI_BAWAH = document.getElementById('INV_REDAKSI_BAWAH1').value;
		var INV_PEJABAT_EFECTIVE = document.getElementById('INV_REDAKSI_EFECTIVE1').value;
		var INV_PEJABAT_EXPIRED = document.getElementById('INV_REDAKSI_EXPIRED1').value;

		if(INV_REDAKSI_ATAS == "" || INV_REDAKSI_BAWAH == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED == ""){
			$('#RedaksiCheck').modal('show');
		}else{
			$('#AddRekasiConfirm').modal('show');
		// alert('insert data sukses!');
		}
	}

	function confirmation4(){
		var INV_PEJABAT_NAME		= document.getElementById('INV_PEJABAT_NAME1').value;
		var INV_PEJABAT_NIPP 		= document.getElementById('INV_PEJABAT_NIPP1').value;
		var INV_PEJABAT_JABATAN 	= document.getElementById('INV_PEJABAT_JABATAN1').value;
		var INV_PEJABAT_EFECTIVE	= document.getElementById('INV_PEJABAT_EFECTIVE1').value;
		var INV_PEJABAT_EXPIRED	= document.getElementById('INV_PEJABAT_EXPIRED1').value;

		if(INV_PEJABAT_NAME == "" || INV_PEJABAT_NIPP == "" || INV_PEJABAT_JABATAN == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED == ""){
			$('#UpdateUnitCheck').modal('show');
		}else{

			$('#UpdatePejabatConfirm').modal('show');
			// alert('insert data sukses!');
		}
	}


	function loaddata(){
		// alert('1234');
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterunitsearch';?>";

		var INV_UNIT_NAME 	= $("#INV_UNIT_NAME2").val();

		$('#mastertable').DataTable( {
				"pageLength": 10,
				"destroy": true,
				"dom" : "brtlp",
				"ajax": {
			    "url": path,
			    data : function ( d ) {
	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
	          		d.INV_UNIT_NAME = INV_UNIT_NAME;
								<?php
								if($this->session->userdata('role_type') != 'Super Admin') {
									$unit_code = $this->session->userdata('entity_code');
									echo "d.INV_ENTITY_CODE = '$unit_code';";
								}
								?>
		        },
			    "type": "POST"
			  },
				"columns": [
										{ "data": "num" },
										{ "data": "INV_UNIT_CODE" },
										{ "data": "INV_UNIT_ORGID" },
										{ "data": "INV_UNIT_NAME" },
										// { "data": "INV_UNIT_LOCATION" },
										{"data": "action"},
				],} );
	}
	function isHTML(str) {
		var a = document.createElement('div');
		a.innerHTML = str;

		for (var c = a.childNodes, i = c.length; i--; ) {
			if (c[i].nodeType == 1) return true;
		}

		return false;
	}
	function saveunit()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterunitsave';?>";

		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var INV_UNIT_CODE 	= $("#INV_UNIT_CODE").val();
		var INV_UNIT_ORGID 	= $("#INV_UNIT_ORGID").val();
		var INV_UNIT_NAME 	= $("#INV_UNIT_NAME").val();
		var INV_UNIT_LOCATION 	= $("#INV_UNIT_LOCATION").val();
		var INV_UNIT_ALAMAT = $("#INV_UNIT_ALAMAT").val();
		var INV_ENTITY_CODE = $("#INV_ENTITY_CODE").val();
		var INV_UNIT_STATUS = 'Not Active';
		var INV_UNIT_NOTE = $("#INV_UNIT_NOTE").val();
		var INV_UNIT_KAPAL = '0';
		var INV_UNIT_PETIKEMAS = '0';
		var INV_UNIT_BARANG = '0';
		var INV_UNIT_RUPARUPA = '0';

		if($("#INV_UNIT_KAPAL").is(":checked")) INV_UNIT_KAPAL='1';
		if($("#INV_UNIT_PETIKEMAS").is(":checked")) INV_UNIT_PETIKEMAS='1';
		if($("#INV_UNIT_BARANG").is(":checked")) INV_UNIT_BARANG='1';
		if($("#INV_UNIT_RUPARUPA").is(":checked")) INV_UNIT_RUPARUPA='1';

		$.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				// INV_NOTA_ID:INV_NOTA_ID,
				INV_UNIT_CODE:INV_UNIT_CODE,
				INV_UNIT_ORGID:INV_UNIT_ORGID,
				INV_UNIT_NAME:INV_UNIT_NAME,
				INV_UNIT_LOCATION:INV_UNIT_LOCATION,
				INV_UNIT_ALAMAT:INV_UNIT_ALAMAT,
				INV_UNIT_STATUS:INV_UNIT_STATUS,
				INV_UNIT_NOTE:INV_UNIT_NOTE,
				INV_UNIT_KAPAL:INV_UNIT_KAPAL,
				INV_UNIT_PETIKEMAS:INV_UNIT_PETIKEMAS,
				INV_UNIT_BARANG:INV_UNIT_BARANG,
				INV_UNIT_RUPARUPA:INV_UNIT_RUPARUPA,
				INV_ENTITY_CODE:INV_ENTITY_CODE
			},
			success: function(resp)
			{
				try {
					var result = JSON.parse(resp);
					if (result.status == "success") {
						//alert('insert data sukses!');
						$("#INV_UNIT_CODE").val("");
						$("#INV_UNIT_ORGID").val("");
						$("#INV_UNIT_LOCATION").val("");
						$("#INV_UNIT_NAME").val("");
						$("#INV_UNIT_ALAMAT").val("");
						$("#INV_ENTITY_CODE").val("");
						$("#INV_UNIT_NOTE").val("");
					} else {
						console.log(result);
						alert("data gagal disimpan");
						//$('#add_unit').modal('show');
					}
				} catch(e) {
					console.log(e);
					/*alert("data gagal disimpan");*/
				}
				loaddata();
			}
		});

        return false;

		/*$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_NOTA_ID:INV_NOTA_ID,
			INV_UNIT_CODE:INV_UNIT_CODE,
			INV_UNIT_ORGID:INV_UNIT_ORGID,
			INV_UNIT_NAME:INV_UNIT_NAME,
			INV_UNIT_ALAMAT:INV_UNIT_ALAMAT,
			INV_UNIT_STATUS:INV_UNIT_STATUS,
			INV_UNIT_NOTE:INV_UNIT_NOTE,
			INV_UNIT_KAPAL:INV_UNIT_KAPAL,
			INV_UNIT_PETIKEMAS:INV_UNIT_PETIKEMAS,
			INV_UNIT_BARANG:INV_UNIT_BARANG,
			INV_UNIT_RUPARUPA:INV_UNIT_RUPARUPA,
			INV_ENTITY_CODE:INV_ENTITY_CODE
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						//alert('insert data sukses!');
						loaddata();
					} else {
						console.log(result);
						alert("data gagal disimpan");
						//$('#add_unit').modal('show');
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}

        });

        return false;*/
	}

	function editunit($id)
	{
			// alert('123');
			$('[name="ROWID"]').val($id);
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterunitedit';?>";
			INV_UNIT_ID 	= $id;

			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_UNIT_ID:INV_UNIT_ID
			}).done(function( data ) {
				var data2 = JSON.parse(data);
				// alert(data2.INV_UNIT_KAPAL);
				$('[name="INV_UNIT_CODE1"]').val(data2.INV_UNIT_CODE);
				$('[name="INV_UNIT_ORGID1"]').val(data2.INV_UNIT_ORGID);
				$('[name="INV_UNIT_LOCATION1"]').val(data2.INV_UNIT_LOCATION);
				$('[name="INV_UNIT_NAME1"]').val(data2.INV_UNIT_NAME);
				$('[name="INV_UNIT_ALAMAT1"]').val(data2.INV_UNIT_ALAMAT);
				$('[name="INV_ENTITY_CODE1"]').val(data2.INV_ENTITY_CODE);
				$('[name="INV_UNIT_STATUS1"]').val(data2.INV_UNIT_STATUS);
				if(data2.INV_UNIT_KAPAL==1)$("#INV_UNIT_KAPAL1").attr("checked","checked");
				if(data2.INV_UNIT_PETIKEMAS==1)$("#INV_UNIT_PETIKEMAS1").attr("checked","checked");
				if(data2.INV_UNIT_BARANG==1)$("#INV_UNIT_BARANG1").attr("checked","checked");
				if(data2.INV_UNIT_RUPARUPA==1)$("#INV_UNIT_RUPARUPA1").attr("checked","checked");
				$('#update_unit').modal('show');
			});
			// alert('');
			return false;
	}

	function updateunit()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterunitupdate';?>";

		INV_UNIT_ID 	= $("#ROWID").val();
		var INV_UNIT_CODE 		= $("#INV_UNIT_CODE1").val();
		var INV_UNIT_ORGID 	= $("#INV_UNIT_ORGID1").val();
		var INV_UNIT_NAME 	= $("#INV_UNIT_NAME1").val();
		var INV_UNIT_LOCATION 	= $("#INV_UNIT_LOCATION1").val();
		var INV_UNIT_ALAMAT 	= $("#INV_UNIT_ALAMAT1").val();
		var INV_UNIT_STATUS	 	= $("#INV_UNIT_STATUS1").val();
		var INV_ENTITY_CODE 	= $("#INV_ENTITY_CODE1").val();
		var INV_UNIT_KAPAL = '0';
		var INV_UNIT_PETIKEMAS = '0';
		var INV_UNIT_BARANG = '0';
		var INV_UNIT_RUPARUPA = '0';

		if($("#INV_UNIT_KAPAL1").is(":checked")) INV_UNIT_KAPAL='1';
		if($("#INV_UNIT_PETIKEMAS1").is(":checked")) INV_UNIT_PETIKEMAS='1';
		if($("#INV_UNIT_BARANG1").is(":checked")) INV_UNIT_BARANG='1';
		if($("#INV_UNIT_RUPARUPA1").is(":checked")) INV_UNIT_RUPARUPA='1';

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_UNIT_ID:INV_UNIT_ID,
			INV_UNIT_CODE:INV_UNIT_CODE,
			INV_UNIT_ORGID:INV_UNIT_ORGID,
			INV_UNIT_NAME:INV_UNIT_NAME,
			INV_UNIT_LOCATION:INV_UNIT_LOCATION,
			INV_UNIT_ALAMAT:INV_UNIT_ALAMAT,
			INV_UNIT_STATUS:INV_UNIT_STATUS,
			INV_UNIT_KAPAL:INV_UNIT_KAPAL,
			INV_UNIT_PETIKEMAS:INV_UNIT_PETIKEMAS,
			INV_UNIT_BARANG:INV_UNIT_BARANG,
			INV_UNIT_RUPARUPA:INV_UNIT_RUPARUPA,
			INV_ENTITY_CODE:INV_ENTITY_CODE
		}).done(function( data ) {
		// alert(INV_ENTITY_CODE);	loaddata();
				try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						loaddata();


					} else {
						console.log(result);
						alert("data gagal disimpan");
						//$('#add_unit').modal('show');
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}
			});
        return false;
	}

	function savepejabat()
	{
		$("#submitAddPejabat").click();
	}

	function editconfig($id){
		$('[name="ROWID"]').val($id);
		INV_UNIT_ID = $id;
		// alert($id);
		loaddatapejabat($id);
		loaddataredaksi($id);
	}

	function loaddatapejabat($id){
		// alert('1234');
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterpejabatsearch';?>";

		INV_UNIT_ID 	= $id;

		// alert(INV_UNIT_ID);

		// alert(INV_ENTITY_CODE);
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_UNIT_ID:INV_UNIT_ID
		}).done(function( data ) {
			var data1 = JSON.parse(data);
			//  alert(data1);die;
			var html = '';
			var i;
			var $no=0;
			for(i=0; i<Object.keys(data1).length; i++){
				// alert(data1[i].INV_PEJABAT_NAME);die;
				$no++;
				html += '<tr>'+
						'<td>'+$no+'</td>'+
						'<td>'+data1[i].INV_PEJABAT_NAME+'</td>'+
						'<td>'+data1[i].INV_PEJABAT_JABATAN+'</td>'+
						'<td>'+data1[i].INV_PEJABAT_EFECTIVE+'</td>'+
						'<td>'+data1[i].INV_PEJABAT_EXPIRED+'</td>'+
						'<td>'+data1[i].INV_PEJABAT_STATUS+'</td>'+
						'<td><button type="button"  onclick="editpejabat(\''+data1[i].INV_PEJABAT_ID+'\')"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update_notaconf"><i class="fa fa-pencil-square"></i></button></td>'+
						'</tr>';
			}
			// alert(html);die;
			$('#show_pejabat').html(html);
        });

        return false;
	}


	function editpejabat($id)
	{
			 // alert($id);
			$('[name="ROWID1"]').val($id);
			INV_PEJABAT_ID = $id;
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterpejabatedit';?>";
			var INV_PEJABAT_ID 	= $id;

			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_PEJABAT_ID:INV_PEJABAT_ID
			}).done(function( data ) {
				var data2 = JSON.parse(data);
				// alert(data2.INV_UNIT_KAPAL);
				$('[name="INV_PEJABAT_NAME1"]').val(data2.INV_PEJABAT_NAME);
				$('[name="INV_PEJABAT_NIPP1"]').val(data2.INV_PEJABAT_NIPP);
				$('[name="INV_PEJABAT_JABATAN1"]').val(data2.INV_PEJABAT_JABATAN);
				// $('[name="INV_PEJABAT_TTD1"]').val(data2.INV_PEJABAT_TTD);
				$('[name="INV_PEJABAT_STATUS1"]').val(data2.INV_PEJABAT_STATUS);
				$('[name="INV_PEJABAT_NOTE1"]').val(data2.INV_PEJABAT_NOTE);
				$('[name="INV_PEJABAT_TTD_NOTIF"]').val(data2.INV_PEJABAT_TTD);
				$('[name="INV_PEJABAT_EFECTIVE1"]').val(GetDate(data2.INV_PEJABAT_EFECTIVE));
				$('[name="INV_PEJABAT_EXPIRED1"]').val(GetDate(data2.INV_PEJABAT_EXPIRED));
				$('#INV_PEJABAT_ID').val($id);
				// alert(INV_PEJABAT_EFECTIVE1);
    			document.getElementById("uploadPreviewEdit").src = "<?php echo IMAGES_TTD_;?>"+data2.INV_PEJABAT_TTD;
				$('#update_notaconf').modal('show');
			});

			return false;
	}

	function updatepejabat()
	{
		$("#submitEditPejabat").click();


	}

	function addredaksiconfirm(){
		$('#AddRedaksiConfirm').modal('show');
		// alert('insert data sukses!');
	}

	function updateredaksiconfirm(){

		$('#UpdateRekasiConfirm').modal('show');
		// alert('insert data sukses!');
	}

	function saveredaksi()
	{

		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterredaksisave';?>";

		var INV_UNIT_ID 		  = $("#ROWID").val();
		var INV_NOTA_LAYANAN      = $("#INV_NOTA_LAYANAN").val();
		var INV_NOTA_JENIS 		  = $("#INV_NOTA_JENIS").val();
		//var INV_REDAKSI_NOTE 	  = $("#INV_REDAKSI_NOTE1").val();
		var INV_REDAKSI_ATAS 	  = $("#INV_REDAKSI_ATAS1").val();
		var INV_REDAKSI_BAWAH 	  = $("#INV_REDAKSI_BAWAH1").val();
		var INV_REDAKSI_PAJAK 	  = $("#INV_REDAKSI_PAJAK1").val();
		var INV_REDAKSI_EFECTIVE1 = $("#INV_REDAKSI_EFECTIVE1").val();
		var INV_REDAKSI_EXPIRED1  = $("#INV_REDAKSI_EXPIRED1").val();

		INV_REDAKSI_EFECTIVE	= SetDate(INV_REDAKSI_EFECTIVE1);
		INV_REDAKSI_EXPIRED		= SetDate(INV_REDAKSI_EXPIRED1);

		//alert();

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_UNIT_ID 			:INV_UNIT_ID,
			INV_NOTA_LAYANAN 		:INV_NOTA_LAYANAN,
			INV_NOTA_JENIS 			:INV_NOTA_JENIS,
			INV_REDAKSI_NOTE 		:INV_NOTA_JENIS,
			INV_REDAKSI_ATAS 		:INV_REDAKSI_ATAS,
			INV_REDAKSI_BAWAH 		:INV_REDAKSI_BAWAH,
			INV_REDAKSI_EFECTIVE 	:INV_REDAKSI_EFECTIVE,
			INV_REDAKSI_EXPIRED 	:INV_REDAKSI_EXPIRED,
			INV_REDAKSI_PAJAK		:INV_REDAKSI_PAJAK
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						location.reload();


					} else {
						console.log(result);
						alert("data gagal disimpan");
						//$('#add_unit').modal('show');
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}

        });
        return false;
	}

	function updateredaksi()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterredaksiupdate';?>";
		var INV_UNIT_ID 	= $("#ROWID").val();
		var INV_REDAKSI_ID 	= $("#ROWID2").val();
		var INV_NOTA_JENIS 		= $("#INV_NOTA_JENIS2").val();
		//var INV_REDAKSI_NOTE 	= $("#INV_REDAKSI_NOTE2").val();
		var INV_REDAKSI_ATAS 	= $("#INV_REDAKSI_ATAS2").val();
		var INV_REDAKSI_BAWAH 	= $("#INV_REDAKSI_BAWAH2").val();
		var INV_REDAKSI_PAJAK 	= $("#INV_REDAKSI_PAJAK2").val();
		var INV_REDAKSI_EFECTIVE1 	= $("#INV_REDAKSI_EFECTIVE2").val();
		var INV_REDAKSI_EXPIRED1	 	= $("#INV_REDAKSI_EXPIRED2").val();

		INV_REDAKSI_EFECTIVE	= SetDate(INV_REDAKSI_EFECTIVE1);
		INV_REDAKSI_EXPIRED		= SetDate(INV_REDAKSI_EXPIRED1);

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_UNIT_ID:INV_UNIT_ID,
			INV_REDAKSI_ID:INV_REDAKSI_ID,
			INV_REDAKSI_NOTE:INV_NOTA_JENIS,
			INV_NOTA_JENIS:INV_NOTA_JENIS,
			INV_REDAKSI_ATAS:INV_REDAKSI_ATAS,
			INV_REDAKSI_BAWAH:INV_REDAKSI_BAWAH,
			INV_REDAKSI_EFECTIVE:INV_REDAKSI_EFECTIVE,
			INV_REDAKSI_EXPIRED:INV_REDAKSI_EXPIRED,
			INV_REDAKSI_PAJAK:INV_REDAKSI_PAJAK
		}).done(function( data ) {

			location.reload();
        });

        return false;
	}

	function refreshRedaksi()
	{
			// alert('123');
			var path = '';
			path = "<?php echo ROOT.'einvoice/unit/getNota';?>";
			// var INV_NOTA_LAYANAN = 'KAPAL';

			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_NOTA_LAYANAN:$("#INV_NOTA_LAYANAN").val()
			}).done(function( data ) {
				// INV_NOTA_JENIS
				var parse = JSON.parse(data);
				var html = "";
				$.each( parse, function( key, value ) {
					console.log(value);
				  html += "<option>"+value.INV_NOTA_JENIS+"</option>"
				  // alert( key + ": " + value );
				});
				$("#INV_NOTA_JENIS").html(html);
				console.log(data);
				// $('#update_unit').modal('show');
			});

			return false;
	}
	function editredaksi($id)
	{
			// alert('123');
			$('[name="ROWID2"]').val($id);
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterredaksiedit';?>";
			var INV_REDAKSI_ID 	= $id;
			// var INV_NOTA_LAYANAN = 'KAPAL';

			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_REDAKSI_ID:INV_REDAKSI_ID
			}).done(function( data ) {
				var data2 = JSON.parse(data);
				//$('[name="INV_NOTA_LAYANAN2"]').val(data2.INV_NOTA_JENIS);
				//$('[name="INV_REDAKSI_NOTE2"]').val(data2.INV_REDAKSI_NOTE);
				$('[name="INV_NOTA_JENIS2"]').val(data2.INV_NOTA_JENIS);
				$('[name="INV_REDAKSI_ATAS2"]').val(data2.INV_REDAKSI_ATAS);
				$('[name="INV_REDAKSI_BAWAH2"]').val(data2.INV_REDAKSI_BAWAH);
				$('[name="INV_REDAKSI_PAJAK2"]').val(data2.INV_REDAKSI_PAJAK);
				//alert(GetDate(data2.INV_REDAKSI_EFECTIVE));
				$('[name="INV_REDAKSI_EFECTIVE2"]').val(GetDate(data2.INV_REDAKSI_EFECTIVE));
				$('[name="INV_REDAKSI_EXPIRED2"]').val(GetDate(data2.INV_REDAKSI_EXPIRED));
				// $('#update_unit').modal('show');
				//alert(GetDate(data2.INV_REDAKSI_EFECTIVE));
			});

			return false;
	}

	function loaddataredaksi($id){
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterredaksisearch';?>";

		var INV_UNIT_ID 	= $id;

		$('#table-redaksi').DataTable( {
				"pageLength": 10,
				"destroy": true,
				"dom" : "brtlp",
				"ajax": {
			    "url": path,
			    data : function ( d ) {
	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
	          		d.INV_UNIT_ID = INV_UNIT_ID;
		        },
			    "type": "POST"
			  },
				"columns": [
										{ "data": "num" },
										{ "data": "INV_NOTA_JENIS" },
										{ "data": "INV_REDAKSI_ATAS" },
										{ "data": "INV_REDAKSI_BAWAH" },
										{ "data": "INV_REDAKSI_PAJAK" },
										{ "data": "INV_REDAKSI_EFECTIVE"},
										{ "data": "INV_REDAKSI_EXPIRED"},
										{ "data": "action"},
				],} );
	}
	function isHTML(str) {
		var a = document.createElement('div');
		a.innerHTML = str;

		for (var c = a.childNodes, i = c.length; i--; ) {
			if (c[i].nodeType == 1) return true;
		}

		return false;
	}

	function SetDate($date){
		var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
							"Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var dt1;
		var formattedDate1 = new Date($date);
		var d1 = formattedDate1.getDate();
		var m1 = monthNames[formattedDate1.getMonth()];
		var y1 = formattedDate1.getFullYear();
		dt1  = d1+'-'+m1+'-'+y1;

		return dt1;
	}

	function GetDate(str)
	{
		var arr = str.split("-");
		var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

		var month = (1+months.indexOf(arr[1].toLowerCase())).toString();
		if(month.length==1) month='0'+month;
		var year = '20' + parseInt(arr[2]);
		var day = parseInt(arr[0]);
		var result = year + '-' + month + '-' + ((day < 10 ) ? "0"+day : day);
		return result;
	}
	function GetDateCustom(str)
	{
		var arr = str.split("-");
		var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

		var month = (1+months.indexOf(arr[1].toLowerCase())).toString();
		if(month.length==1) month='0'+month;
		var year = '20' + parseInt(arr[2]);
		var result = month + '/' + parseInt(arr[0]) + '/' + year ;
		return result;
	}


</script>
