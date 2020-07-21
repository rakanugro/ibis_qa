<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Administrasi</li>
			<li class="active"><span>Master Entity</span></li>
		</ol>
		
		<h1>MASTER ENTITY</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal" action="#" method="post" id="form2">
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Kode Entity</label>
											<div class="row">
												<div class="col-xs-5">
						                  			<input type="text" name="INV_ENTITY_CODE2" id="INV_ENTITY_CODE2" class="form-control" placeholder="Kode Entity">
						                		</div>
					                		</div>
					             		</div>
				             		</div>

				             		<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Nama Entity</label>
											<div class="row">
												<div class="col-xs-5">
						                  			<input type="text" name="INV_ENTITY_NAME2" id="INV_ENTITY_NAME2" class="form-control" placeholder="Nama Entity">
						                		</div>
					                		</div>
					             		</div>
				             		</div>
								</div>
							</div>

							<div class="col-md-9">
								<div class="box-body">
									<div class="form-group">
							            <div class="col-sm-offset-12 col-sm-10">
								              <button type="button" onclick="ClearSearch()"  class="btn btn-primary btn-lg" data-toggle="" data-target=""> Clear</button>
								              <button type="button" onclick="loaddata()" ac class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i> Search</a></button>
							          		<!-- </div> -->
							            </div>
			      					</div>
			  					</div>
			          		</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="box-body">
		<div class="form-group">
			<div class="text-right"> 
			    
			    <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_entity"><i class="fa fa-plus"></i></button>
			</div>
		</div>
	</div>
</div>
<!-- <button type="Clear" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add_entity" style="float: right;"><i class="fa fa-plus-square"></i></button> -->

<div class="row">
	<div class="clo-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table id="myTable" class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Entity</th>
								<th>Nama Entity</th>
								<th>NPWP</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" value="" name="ID" id="ID" class="form-control" placeholder="Kode Entity"/>
															

<div id="add_entity" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Add Entity</h4>
	        </div>
	        <div class="modal-body">
			<!-- <form id="form1" method="post" action="<?php //echo base_url('ibis_qa/index.php/einvoice/administrasi/masterentity/masterentitysave');?>"> -->
		            <div class="form-group">
	                	<div class="box-body">
							<div class="main-box-body clearfix">
								<div class="tabs-wrapper">
									<ul class="nav nav-tabs">
										<li class="active" id="tabGeneral"><a href="#tab-home" id="tabGenerala" data-toggle="tab">General</a></li>
										<li style="display: none;" id="tabMaterai"><a id="tabMateraia" href="#tab-materai" data-toggle="tab">Materai</a></li>
										<li  style="display: none;" id="tabFaktur"><a href="#tab-faktur" data-toggle="tab">Faktur Pajak</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-home">
											<form class="form-horizontal" id="formAddEntity" enctype="multipart/form-data">
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Kode Entity</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" value="" name="INV_ENTITY_CODE" id="INV_ENTITY_CODE" class="form-control" placeholder="Kode Entity"/>
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Nama Entity</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_ENTITY_NAME" id="INV_ENTITY_NAME" class="form-control" placeholder="Nama Entity">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Alamat</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_ENTITY_ALAMAT" id="INV_ENTITY_ALAMAT" class="form-control" placeholder="Alamat"></textarea>
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">NPWP</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_ENTITY_NPWP" id="INV_ENTITY_NPWP" class="form-control" placeholder="NPWP">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Logo</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="file" accept=".jpg, .jpeg, .png" name="INV_ENTITY_LOGO" id="INV_ENTITY_LOGO" placeholder="Logo" onchange="PreviewImage();">
																<div id="uploadPreviewDiv">
																<img id="uploadPreview" style="width: 150px; height: 150px;"/>
																</div>
															</div>
														</div>
													</div>
												</div>
												
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Status</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" style="width: 100%;" name="INV_ENTITY_STATUS" id="INV_ENTITY_STATUS">
																	<!--
																	<option value="Active">Active</option> -->
																	<option value="Not Active" disble selected>not active</option>

																</select>
															</div>
														</div>
													</div>
												</div> 

												<div class="box-body">
													<div class="form-group">
														<div class="text-left"> 
														   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_entity">Save</button>
														   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
															<input style="display: none;" type="submit" name="submit" id="submitAddEntity">
														</div>
													</div>
												</div> 
											</form>
										</div>
										
										<div class="row">
										</div>
											</table>
										</div>
										<!-- <div class="modal-footer">
											
											<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_entity">Save</button>
									        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

									    </div> -->
									</div>

								</div>
							</div>
						</div>
				    </div>      
	    </div>
	</div>
</div>

<div id="update_entity" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Update Entity</h4>
	        </div>
	        <div class="modal-body">
			<!-- <form id="form1" method="post" action="<?php //echo base_url('ibis_qa/index.php/einvoice/administrasi/masterentity/masterentitysave');?>"> -->
		            <div class="form-group">	
	                	<div class="box-body">
							<div class="main-box-body clearfix">
								<div class="tabs-wrapper"  id="tabs">
									<ul class="nav nav-tabs">
										<li ><a href="#tab-home1" data-toggle="tab">General</a></li>
										<!-- <li><a href="#tab-home" data-toggle="tab">General</a></li> -->
										<li class="active" ><a id="tabMateraiUpdate" href="#tab-materai1" data-toggle="tab">Materai</a></li>
										<li><a href="#tab-faktur1" data-toggle="tab">Faktur Pajak</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade " id="tab-home1">
											<form action="#" class="form-horizontal" id="formUpdateEntity" enctype="multipart/form-data" >
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Kode Entity</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" value="" name="INV_ENTITY_CODEEDIT" id="INV_ENTITY_CODEEDIT" class="form-control" placeholder="Kode Entity"/>
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Nama Entity</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_ENTITY_NAME1" id="INV_ENTITY_NAME1" class="form-control" placeholder="Nama Entity">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Alamat</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_ENTITY_ALAMAT1" id="INV_ENTITY_ALAMAT1" class="form-control" placeholder="Alamat">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">NPWP</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_ENTITY_NPWP1" id="INV_ENTITY_NPWP1" class="form-control" placeholder="NPWP">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Logo</label>
														<div class="row">
															
															<div class="col-xs-5">
																<input type="file" accept=".jpg, .jpeg, .png"  name="INV_ENTITY_LOGO1" id="INV_ENTITY_LOGO1" placeholder="Logo" onchange="PreviewEdit();">
																<input type="hidden" name="INV_ENTITY_LOGO1NOTIF" id="INV_ENTITY_LOGO1NOTIF">
																
																<img id="uploadPreviewEdit" style="width: 150px; height: 150px;"/>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Status</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" style="width: 100%;" name="INV_ENTITY_STATUS1" id="INV_ENTITY_STATUS1">
																	<option value="Active">Active</option>
																	<option value="Not Active">Not Active</option>

																</select>
															</div>
														</div>
													</div>
												</div>
												<input type="hidden" value="" name="INV_ENTITY_ID1" id="INV_ENTITY_ID1" />
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>

												<input style="display: none;" type="submit" name="submitUpdateEntity" id="submitUpdateEntity">
											</form>
										</div>

										<div class="tab-pane" id="tab-faktur1">
											<table id="table-example" class="table table-hover">
												<!-- <div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">ID ENTITY</label>
														<div class="row">
															<div class="col-xs-5">
																<select class="form-control select2" style="width: 100%;">
																	<option>Tes1</option>
																	<option>Tes2</option>
																</select>
															</div>
														</div>
													</div> -->
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Faktur</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_FAKTUR_NOTE1" id="INV_FAKTUR_NOTE1" class="form-control" placeholder="Faktur Pajak"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Effective Date</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="date" name="INV_FAKTUR_EFECTIVE1" id="INV_FAKTUR_EFECTIVE1" class="form-control" placeholder="Date">
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Expired Date</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="date" name="INV_FAKTUR_EXPIRED1" id="INV_FAKTUR_EXPIRED1" class="form-control" placeholder="Date">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="box-body">
														<div class="form-group">
															<div class="text-right"> 
															   <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_faktur_update">Save</button>
															    
															</div>
														</div>
													</div>
												</div>
												<table id="table-example" class="table table-hover">
																	<thead>
																		<tr>
																			<th>Faktur</th>
																			<th>Efektive Date</th>
																			<th>Expired Date</th>
																			<th></th>
																		</tr>
																	</thead>
																	
																	<tbody id="show_faktur">
																	</tbody>
																	
																</table>

												
											</table>
										</div>

										<div class="tab-pane fade in active" id="tab-materai1">
											<form action="javascript:void(0);" class="form-horizontal" id="formAddMaterai" >
											
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Nomor Ijin E-Materai</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" name="INV_EMATERAI_NUMBER1" id="INV_EMATERAI_NUMBER1" class="form-control" placeholder="Nomor Materai">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Redaksi E-Materai</label>
														<div class="row">
															<div class="col-xs-5">
																<textarea type="text" name="INV_EMATERAI_REDAKSI1" id="INV_EMATERAI_REDAKSI1" class="form-control" placeholder="Faktur Pajak"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Effective Date</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="date" name="INV_EMATERAI_EFECTIVE1" id="INV_EMATERAI_EFECTIVE1" class="form-control" placeholder="Date">
															</div>
														</div>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Expired Date</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="date" name="INV_EMATERAI_END1" id="INV_EMATERAI_END1" class="form-control" placeholder="Date">
															</div>
														</div>
													</div>
												</div>
												<!--
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Status</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" style="width: 100%;" name="" id="INV_ENTITY_STATUS1">
																	<option value="Active">Active</option>
																	<option value="Not Active">Not Active</option>

																</select>
															</div>
														</div>
													</div>
												</div>
												-->
											</form>
												<div class="row">
													<div class="box-body">
														<div class="form-group">
															<div class="text-right"> 
															    <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_materai_update">Save</button>
															    
															</div>
														</div>
													</div>
												</div>
												<div class="row">
												<div class="clo-lg-12">
													<div class="main-box clearfix">
														<div class="main-box-body clearfix">
															<div class="table-responsive">
																<table id="table-materai" class="table table-hover">
																	<thead>
																		<tr>
																			<th>NO</th><th>No Ijin E-Materai</th>
																			<th>Redaksi E-Materai</th>
																			<th>Effective Date</th>
																			<th>Expired Date</th>
																			<th></th>
																		</tr>
																	</thead>
																</table>
															</div>
														</div>
													</div>
												</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
		        <!-- <button type="button"  id="" onclick="send()" class="btn btn-default">Save</button> -->

				<!-- <input type="submit" value="Save"  class="btn btn-primary" /> -->
											<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_entity_update">Save</button>
									        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

									    </div>
									</div>
								</div>
							</div>
						</div>
				    </div>      
	        </div>
	    </div>
	</div>
</div>
<div id="update-materai" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Update E-Materai</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<div class="tab-pane fade in active">
								<form class="form-horizontal">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">No Ijin E-Materai</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="INV_EMATERAI_NUMBER2" id="INV_EMATERAI_NUMBER2" class="form-control"/>
												</div>
											</div>
										</div>
									</div>

									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Redaksi E-Materai</label>
											<div class="row">
												<div class="col-xs-5">
													<textarea type="text" name="INV_EMATERAI_REDAKSI2" id="INV_EMATERAI_REDAKSI2" class="form-control"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="box-body">
										<div class="form-group">
												<label for="" class="col-sm-2 control-label">Effective Date</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="date" name="INV_EMATERAI_EFECTIVE2" id="INV_EMATERAI_EFECTIVE2" class="form-control" placeholder="Date">
												</div>
											</div>
										</div>
									</div>
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Expired Date</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="date" name="INV_EMATERAI_END2" id="INV_EMATERAI_END2" class="form-control" placeholder="Date">
												</div>
											</div>
										</div>
									</div>	
							</form>
						</div>
						<div class="modal-footer"><button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_materai_edit">Save</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</form>   
			</div>
		</div>
	</div>
</div>

<div id="update-faktur" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Update Faktur Pajak</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<div class="tab-pane fade in active">
								<form class="form-horizontal">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Faktur Pajak</label>
											<div class="row">
												<div class="col-xs-5">
													<textarea type="text" name="INV_FAKTUR_NOTE2" id="INV_FAKTUR_NOTE2" class="form-control"> </textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="box-body">
										<div class="form-group">
												<label for="" class="col-sm-2 control-label">Effective Date</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="date" name="INV_FAKTUR_EFECTIVE2" id="INV_FAKTUR_EFECTIVE2" class="form-control" placeholder="Date">
												</div>
											</div>
										</div>
									</div>
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Expired Date</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="date" name="INV_FAKTUR_EXPIRED2" id="INV_FAKTUR_EXPIRED2" class="form-control" placeholder="Date">
												</div>
											</div>
										</div>
									</div>	
							</form>
						</div>
						<div class="modal-footer">
							<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_faktur_edit">Save</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</form>   
			</div>
		</div>
	</div>
</div>

<div id="add_bank" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Master Bank</h4>
	        </div>
	        <div class="modal-body">
		            <div class="form-group">
		            	<!-- <div class="box-body">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">ID Bank</label>
								<div class="row">
									<div class="col-xs-5">
										<input type="text" name="INV_BANK_ID" id="INV_BANK_ID" class="form-control" placeholder="id Bank">
									</div>
								</div>
							</div>
						</div> -->
				<form action="javascript:void(0);" class="form-horizontal" id="formAddBank">
	                	<div class="box-body">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Nama Bank</label>
								<div class="row">
									<div class="col-xs-5">
										<input type="text" name="INV_BANK_NAME" id="INV_BANK_NAME" class="form-control" placeholder="Nama Bank">
									</div>
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Nomor Rekening</label>
									<div class="row">
										<div class="col-xs-5">
											<input type="text" name="INV_BANK_REKENING" id="INV_BANK_REKENING" class="form-control" placeholder="Nomor Rekening">
										</div>
									</div>
							</div>
						</div>
						<div class="box-body">
							<div class="text-right"> 	    
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_bank">Save</button>
							</div>
						</div>
		        </form>
						<div class="box-body">
							<div class="form-group">
								<div class="table-responsive">
									<table id="table-bank" class="table table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Bank</th>
												<th>Nomor Rekening</th>
												<th></th>
										
											</tr>
										</thead>
										<tbody id='show_bank'>
								
										</tbody>
									</table>
								</div>
							</div>
						</div>

	        </div>
		    <div class="modal-footer">
		        <!-- <button type="button"  id="" onclick="send()" class="btn btn-default">Save</button> -->
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button> 	 
		    </div>
	    </div>
	</div>
</div>
<div id="sigin_bank" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Assign Bank To Unit</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<div class="tab-pane fade in active">
								<form class="form-horizontal">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Unit</label>
											<div class="row">
												<div class="col-xs-5">
													<select class="form-control select2" style="width: 100%;" name="INV_UNIT_CODE" id="INV_UNIT_CODE">
													<?php foreach($unit as $unitid) { ?>
														<option><?php echo $unitid->INV_UNIT_CODE;?></option>
													<?php } ?>

													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Bank</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="INV_BANK_NAME2" id="INV_BANK_NAME2" class="form-control" placeholder="Bank" readonly="readonly">												
												</div>
											</div>
										</div>
									</div>
									<div class="box-body">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_signbank" style="float: right;">Save</button>
							<div class="form-group">
								<div class="table-responsive">
									<table id="table-example" class="table table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Unit</th>
												<th></th>
										
											</tr>
										</thead>
											 
										<tbody id="show_signbank">
										</tbody>
										
									</table>
								</div>
							</div>
						</div>
									
							</form>
						</div>
							<div class="modal-footer">
								<!-- <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_sigin_edit">Save</button> -->
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
								
							</div>
					</div>
				</form>   
			</div>
		</div>
	</div>
</div>

<div id="edit_sigin_bank" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Edit Assign Bank To Unit</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<div class="tab-pane fade in active">
								<form class="form-horizontal">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Unit</label>
											<div class="row">
												<div class="col-xs-5">
													<select class="form-control select2" style="width: 100%;" name="INV_UNIT_CODE3" id="INV_UNIT_CODE3">
													<?php foreach($unit as $unitid) { ?>
														<option><?php echo $unitid->INV_UNIT_CODE;?></option>
													<?php } ?>

													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Bank</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="INV_BANK_NAME3" id="INV_BANK_NAME3" class="form-control" placeholder="Bank" readonly="readonly">												
												</div>
											</div>
										</div>
									</div>
																		
							</form>
						</div>
							<div class="modal-footer">
								<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_sigin_update">Save</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
							</div>
					</div>
				</form>   
			</div>
		</div>
	</div>
</div>
<div id="edit_bank" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Edit Bank</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<div class="tab-pane fade in active">
								<form action="javascript:void(0);" class="form-horizontal" id="formUpdateBank">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Nama Bank</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="INV_BANK_NAME1" id="INV_BANK_NAME1" class="form-control"/>
												</div>
											</div>
										</div>
									</div>

									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">No Rekening</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="INV_BANK_REKENING1" id="INV_BANK_REKENING1" class="form-control">
												</div>
											</div>
										</div>
									</div>		
							</form>
						</div>
							<div class="modal-footer">
								<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#allert_bank_update" data-dismiss="modal">Update</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
							</div>
					</div>
				</form>   
			</div>
		</div>
	</div>
</div>

<div id="allert_entity" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        	<div class="modal-body">
				<div class="tab-content">
					<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
					<div class="modal-footer">
    					<button class="btn_hapus btn btn-primary" id=""  data-dismiss="modal" onclick="saveallnew()">Ya</button>
        				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
    				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="allert_entity_update" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        	<div class="modal-body">
					<div class="tab-content">
						<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
						<div class="modal-footer">
        					<button class="btn_hapus btn btn-primary" data-dismiss="modal" id="" onclick="updateall()">Ya</button>
            				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
        				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="allert_materai_update" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
            					<button class="btn_hapus btn btn-primary" data-dismiss="modal" id="" onclick="savematerai1()">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>   
			</div>
		</div>
	</div>
</div>
<div id="allert_faktur_update" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        	<div class="modal-body">
				<div class="tab-content">
					<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
					<div class="modal-footer">
    					<button class="btn_hapus btn btn-primary" data-dismiss="modal" id="" onclick="savefaktur1()">Ya</button>
        				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
    				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="allert_materai_edit" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        	<div class="modal-body">
				<div class="tab-content">
					<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
					<div class="modal-footer">
    					<button class="btn_hapus btn btn-primary" data-dismiss="modal" id="" onclick="updatematerai()">Ya</button>
        				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
    				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="allert_faktur_edit" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        	<div class="modal-body">
				<div class="tab-content">
					<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
					<div class="modal-footer">
    					<button class="btn_hapus btn btn-primary" data-dismiss="modal" id="" onclick="updatefaktur()">Ya</button>
        				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
    				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="allert_bank" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
				<div class="tab-content">
					<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
					<div class="modal-footer">
    					<button class="btn_hapus btn btn-primary" data-dismiss="modal" id="" onclick="savebank()">Ya</button>
        				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
        				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="allert_sigin_edit" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<!-- <button  type="button"  id="submit" name="submit" onclick="saveassign()" class="btn btn-primary" data-dismiss="modal">Ya</button> -->
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>   
			</div>
		</div>
	</div>
</div>
<div id="allert_sigin_update" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<button  type="button"  id="submit" name="submit" onclick="updatesignbank()" class="btn btn-primary" data-dismiss="modal">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>   
			</div>
		</div>
	</div>
</div>
<div id="allert_bank_update" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        	<div class="modal-body">
					<div class="tab-content">
						<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
						<div class="modal-footer">
							<button  type="button"  id="submit" name="submit" onclick="updatebank()" class="btn btn-primary" data-dismiss="modal">Ya</button>
            				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
        				</div>
					</div>
			</div>
		</div>
	</div>
</div>
<div id="allert_signbank" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        	<div class="modal-body">
					<div class="tab-content">
					<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
					<div class="modal-footer">
    					<button class="btn_hapus btn btn-primary"  data-dismiss="modal" id="" onclick="savesignbank()">Ya</button>
        				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
    				</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!--
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                <h4 class="modal-title" id="myModalLabel">Hapus Data Entity</h4>
            </div>
            <form class="form-horizontal">
            <div class="modal-body">                
                <input type="hidden" name="kode" id="textkode" value="">
                <div class="alert alert-warning"><p>Apakah Anda yakin akan menghapus data ini ?</p></div>
            </div>
            <div class="modal-footer">
            	<button class="btn_hapus btn btn-primary" id="btn_hapus" onclick="hapusentity()">Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
            </form>
        </div>
    </div>
</div>

-->

<input type="hidden" value="" name="ROWID" id="ROWID" class="form-control" placeholder="Kode Entity"/>
<input type="hidden" value="" name="ROWID1" id="ROWID1" class="form-control" placeholder="Kode Entity"/>
<input type="hidden" value="" name="ROWID2" id="ROWID2" class="form-control" placeholder="Kode Entity"/>
<input type="hidden" value="" name="ROWID3" id="ROWID3" class="form-control" placeholder="Kode Entity"/>
<input type="hidden" value="" name="ROWID4" id="ROWID4" class="form-control" placeholder="Kode BANK"/>
<input type="hidden" value="" name="ROWID5" id="ROWID5" class="form-control" placeholder="Kode SIGNBANK"/>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript">
function PreviewImage() {
var oFReader = new FileReader();
oFReader.readAsDataURL(document.getElementById("INV_ENTITY_LOGO").files[0]);
oFReader.onload = function (oFREvent)
 {
    document.getElementById("uploadPreview").src = oFREvent.target.result;
};
};
</script>

<script type="text/javascript">
function PreviewEdit() {
var oFReader = new FileReader();
oFReader.readAsDataURL(document.getElementById("INV_ENTITY_LOGO1").files[0]);
oFReader.onload = function (oFREvent)
 {
    document.getElementById("uploadPreviewEdit").src = oFREvent.target.result;
};
};
</script>


<script type="text/javascript">
    //Date picker
    $('#tgl_nota').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

    $('#keluar_nota').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });
</script>

<script>

var tableEntity;
var entityID;
var bankID;
$( document ).ready(function() {
	path = "<?php echo ROOT.'einvoice/administrasi/masterentitysearch';?>";
		
	// var tableEntity = $('#myTable').dataTable({
	// 	"ajax": {
	// 	    "url": path,
	// 	    "type": "GET"
	// 	  },
	// 	  "dom" : "brtlp",
	// 	  "columns": [
 //                        { "data": "num" },
 //                        { "data": "INV_ENTITY_CODE" },
 //                        { "data": "INV_ENTITY_NAME" },
 //                        { "data": "INV_ENTITY_NPWP" },
 //                        { "data": "INV_ENTITY_STATUS" },
 //                        { "data": "action" },
 //                    ],
	// 	});

	tableEntity = $('#myTable').DataTable({
			"columnDefs": [
			    { 
			    	"searchable": false, 
			    	"targets": [0,1,2,3,4,5] 
			    }
			  ],
		  	"dom" : "brtlp",
			"ajax": {
			    "url": path,
			    data : function ( d ) {
	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
	          		d.INV_ENTITY_CODE = $("#INV_ENTITY_CODE2").val();;
	          		d.INV_ENTITY_NAME = $("#INV_ENTITY_NAME2").val();;
		        },
			    "type": "GET"
			  },
			  "columns": [
	                        { "data": "num" },
	                        { "data": "INV_ENTITY_CODE" },
	                        { "data": "INV_ENTITY_NAME" },
	                        { "data": "INV_ENTITY_NPWP" },
	                        { "data": "INV_ENTITY_STATUS" },
	                        { "data": "action" },
	                    ],
		});
	$("#btnAddEntity").click(function(){
		$("#tabGeneral").show();
		$("#tabMaterai").hide();
		$("#tabFaktur").hide();
		$("#tabGenerala").click();
	});

	

	$("#formAddEntity").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			// url: self.baseUrl+"ajaxAddQuotes", // Url to which the request is send
			url: "<?php echo ROOT.'einvoice/administrasi/masterentitysave';?>", // Url to which the request is send
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
						loaddata();
						editall(result.lastId);
						$('#update_entity').modal('show');
						$('#tabMateraiUpdate').click();
						document.getElementById("formAddEntity").reset();
    					// document.getElementById("uploadPreview").src = "";
						$('#uploadPreviewDiv').html('<img id="uploadPreview" style="width: 150px; height: 150px;"/>')
					} else {
						alert("data gagal disimpan");
					}
					$('#add_entity').modal('hide');
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}
			}
		});
	}));

	$("#formUpdateEntity").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			// url: self.baseUrl+"ajaxAddQuotes", // Url to which the request is send
			url: "<?php echo ROOT.'einvoice/administrasi/masterentityupdate';?>", // Url to which the request is send
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
						loaddata();
						document.getElementById("formUpdateEntity").reset();
					} else {

					}
					$('#update_entity').modal('hide');
				} catch(e) {
					console.log(e);
					alert("Terjadi kesalahan")
				}
			}
		});
	}));
		
			
	});

	function editall($id)
	{		
		$('[name="ROWID"]').val($id);
		// $('[name="INV_ENTITY_NAME2"]').val($id);
		editentity($id);
		loaddatafaktur($id);
		loaddatamaterai($id);		
		// $('#update_entity').modal('show');
	}

	function saveallnew()
	{		
		$("#submitAddEntity").click();

		// saveentity();
		// savematerai();		
		// savefaktur();
		// $('#update_entity').modal('show');
	}
	
	function updateall($id)
	{		
		$("#submitUpdateEntity").click();
		// updateentity($id);
		if($("#INV_EMATERAI_NUMBER1").val() != "" && $("#INV_EMATERAI_REDAKSI1").val() != "") {
			savematerai1($id);		
		}
		if($("#INV_FAKTUR_NOTE1").val() != "") {
			savefaktur1($id);
		}
		// $('#update_entity').modal('show');
	}

	function loaddata(){
		path = "<?php echo ROOT.'einvoice/administrasi/masterentitysearch';?>";

		var INV_ENTITY_CODE 	= $("#INV_ENTITY_CODE2").val();
		var INV_ENTITY_NAME 		= $("#INV_ENTITY_NAME2").val();
		// tableEntity.draw();

		$('#myTable').dataTable({
			"destroy": true,
		  	"dom" : "brtlp",
			"ajax": {
			    "url": path,
			    data : function ( d ) {
	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
	          		d.INV_ENTITY_CODE = INV_ENTITY_CODE;
	          		d.INV_ENTITY_NAME = INV_ENTITY_NAME;
		        },
			    "type": "POST"
			  },
			  "columns": [
	                        { "data": "num" },
	                        { "data": "INV_ENTITY_CODE" },
	                        { "data": "INV_ENTITY_NAME" },
	                        { "data": "INV_ENTITY_NPWP" },
	                        { "data": "INV_ENTITY_STATUS" },
	                        { "data": "action" },
	                    ],
		});

        return false;
	}

	function ClearAddNew(){
		$('[name="INV_ENTITY_CODE"]').val('');
		$('[name="INV_ENTITY_NAME"]').val('');
		$('[name="INV_ENTITY_ALAMAT"]').val('');
		$('[name="INV_ENTITY_NAME"]').val('');
		$('[name="INV_ENTITY_STATUS"]').val('');
		
	}

$( document ).ready(function() {
		//loaddata();
	});

	function ClearSearch(){
		$('[name="INV_ENTITY_CODE2"]').val('');
		$('[name="INV_ENTITY_NAME2"]').val('');
		$('[name="INV_ENTITY_ALAMAT"]').val('');
		$('[name="INV_ENTITY_NAME"]').val('');
		$('[name="INV_ENTITY_STATUS"]').val('');

		
	}		


	function updateentity()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterentityupdate';?>";

		var INV_ENTITY_ID = $("#ROWID").val();
		// var INV_ENTITY_CODE = $("#INV_ENTITY_CODEEDIT").val();
		// var INV_ENTITY_CODE = $('[name="INV_ENTITY_CODEEDIT"]').val();
		var INV_ENTITY_CODE = $("#INV_ENTITY_CODEEDIT").val();
		var INV_ENTITY_NAME = $("#INV_ENTITY_NAME1").val();
		var INV_ENTITY_ALAMAT = $("#INV_ENTITY_ALAMAT1").val();
		var INV_ENTITY_NPWP = $("#INV_ENTITY_NPWP1").val();
		var INV_ENTITY_LOGO = $("#INV_ENTITY_LOGO1").val();
		var INV_ENTITY_LOGO1NOTIF = $("#INV_ENTITY_LOGO1NOTIF").val();
		var INV_ENTITY_STATUS = $("#INV_ENTITY_STATUS1").val();
		$.post( path, {
		'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		INV_ENTITY_ID:INV_ENTITY_ID, 
		INV_ENTITY_CODE:INV_ENTITY_CODE, 
		INV_ENTITY_NAME:INV_ENTITY_NAME,
		INV_ENTITY_ALAMAT:INV_ENTITY_ALAMAT, 
		INV_ENTITY_NPWP:INV_ENTITY_NPWP,
		INV_ENTITY_LOGO:INV_ENTITY_LOGO, 
		// INV_ENTITY_LOGO1NOTIF:INV_ENTITY_LOGO1NOTIF, 
		INV_ENTITY_STATUS:INV_ENTITY_STATUS
		}).done(function( data ) {
			loaddata();
        });
		
        return false;
	}
	
	
	function editentity($id)
	{		
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterentityedit';?>";
			var INV_ENTITY_ID 	= $id;
			
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_ENTITY_ID:INV_ENTITY_ID
			}).done(function( data ) {	
				var data1 = JSON.parse(data);
				$('[name="INV_ENTITY_ID1"]').val(data1.INV_ENTITY_ID);
				$('[name="INV_ENTITY_CODEEDIT"]').val(data1.INV_ENTITY_CODE);
				$('[name="INV_ENTITY_NAME1"]').val(data1.INV_ENTITY_NAME);
				$('[name="INV_ENTITY_ALAMAT1"]').val(data1.INV_ENTITY_ALAMAT);
				$('[name="INV_ENTITY_NPWP1"]').val(data1.INV_ENTITY_NPWP);
				//$('[name="INV_ENTITY_FAKTUR_PAJAK1"]').val(data1.INV_ENTITY_FAKTUR_PAJAK);
    			document.getElementById("uploadPreviewEdit").src = "<?php echo IMAGES_ENTITY_;?>"+data1.INV_ENTITY_LOGO;
    			console.log("<?php echo IMAGES_ENTITY_;?>"+data1.INV_ENTITY_LOGO);
				// $('[name="INV_ENTITY_LOGO1"]').val(data1.INV_ENTITY_LOGO);
				$('[name="INV_ENTITY_STATUS1"]').val(data1.INV_ENTITY_STATUS);
				$('[name="INV_ENTITY_LOGO1NOTIF"]').val(data1.INV_ENTITY_LOGO);
				//$('[name="INV_ENTITY_MATERAI1"]').val(data1.INV_ENTITY_MATERAI);
				//$('[name="INV_ENTITY_RDK_MATERAI1"]').val(data1.INV_ENTITY_RDK_MATERAI);
				$('#update_entity').modal('show');
			});
			return false;
	}

	function loaddatamaterai($id){
		var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/mastermateraisearch';?>";
		var INV_ENTITY_ID 	= $id;
		$('#table-materai').DataTable({
				"destroy": true,
			  	"dom" : "brtlp",
				"ajax": {
				    "url": path,
				    data : function ( d ) {
		          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
		          		d.INV_ENTITY_ID = INV_ENTITY_ID;
			        },
				    "type": "POST"
				  },
				  "columns": [
		                        { "data": "num" },
		                        { "data": "INV_EMATERAI_NUMBER" },
		                        { "data": "INV_EMATERAI_REDAKSI" },
		                        { "data": "INV_EMATERAI_EFECTIVE" },
		                        { "data": "INV_EMATERAI_END" },
		                        { "data": "action" },
		                    ],
			});

/*
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_ENTITY_ID:INV_ENTITY_ID
		}).done(function( data ) {
			var data2 = JSON.parse(data);	
			var html = '';
			var i;
			var $no=0;
			for(i=0; i<Object.keys(data2).length; i++){
				$no++;
				html += '<tr>'+
						'<td>'+data2[i].INV_EMATERAI_NUMBER+'</td>'+
						'<td>'+data2[i].INV_EMATERAI_REDAKSI+'</td>'+
						'<td>'+data2[i].INV_EMATERAI_EFECTIVE+'</td>'+
						'<td>'+data2[i].INV_EMATERAI_END+'</td>'+
						'<td><button type="button" id="btnmaterai1"  onclick="editmaterai(\''+data2[i].INV_EMATERAI_ID+'\')"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#update-materai"><i class="fa fa-pencil-square"></i></button></td>'+
						'</tr>';
			}
			$('#show_materai').html(html);
        });*/
		
        return false;
	}

	function savematerai()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/mastermateraisave';?>";
		// var INV_EMATERAI_ID 		= $("#INV_EMATERAI_NUMBER2").val();
		var INV_EMATERAI_NUMBER 	= $("#INV_EMATERAI_NUMBER").val();
		var INV_EMATERAI_REDAKSI 	= $("#INV_EMATERAI_REDAKSI").val();
		var INV_EMATERAI_EFECTIVE1	= $("#INV_EMATERAI_EFECTIVE").val();
		var INV_EMATERAI_END1 		= $("#INV_EMATERAI_END").val();
		var INV_ENTITY_CODE 		= $("#INV_ENTITY_CODE").val();
		
		INV_EMATERAI_EFECTIVE	= SetDate(INV_EMATERAI_EFECTIVE1);
		INV_EMATERAI_END		= SetDate(INV_EMATERAI_END1);

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_EMATERAI_ID:INV_EMATERAI_ID, 
			INV_EMATERAI_NUMBER:INV_EMATERAI_NUMBER, 
			INV_EMATERAI_REDAKSI:INV_EMATERAI_REDAKSI, 
			INV_EMATERAI_EFECTIVE:INV_EMATERAI_EFECTIVE, 
			INV_EMATERAI_END:INV_EMATERAI_END, 
			INV_ENTITY_ID:INV_ENTITY_CODE 
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						loaddatamaterai($('[name="ROWID"]').val());		
						document.getElementById("formAddMaterai").reset();
					} else {
						console.log(result);
						alert("data gagal disimpan");
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}

        });
		
        return false;
	}

	function savematerai1()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/mastermateraisave';?>";
		// var INV_EMATERAI_ID 		= $("#INV_EMATERAI_NUMBER2").val();
		var INV_EMATERAI_NUMBER 	= $("#INV_EMATERAI_NUMBER1").val();
		var INV_EMATERAI_REDAKSI 	= $("#INV_EMATERAI_REDAKSI1").val();
		var INV_EMATERAI_EFECTIVE1	= $("#INV_EMATERAI_EFECTIVE1").val();
		var INV_EMATERAI_END1 		= $("#INV_EMATERAI_END1").val();
		var INV_ENTITY_CODE 			= $("#INV_ENTITY_CODEEDIT").val();
		
		INV_EMATERAI_EFECTIVE	= SetDate(INV_EMATERAI_EFECTIVE1);
		INV_EMATERAI_END		= SetDate(INV_EMATERAI_END1);

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_EMATERAI_ID:INV_EMATERAI_ID, 
			INV_EMATERAI_NUMBER:INV_EMATERAI_NUMBER, 
			INV_EMATERAI_REDAKSI:INV_EMATERAI_REDAKSI, 
			INV_EMATERAI_EFECTIVE:INV_EMATERAI_EFECTIVE, 
			INV_EMATERAI_END:INV_EMATERAI_END, 
			INV_ENTITY_ID:INV_ENTITY_CODE 
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						loaddatamaterai($('[name="ROWID"]').val());		
						document.getElementById("formAddMaterai").reset();
					} else {
						console.log(result);
						alert("data gagal disimpan");
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}
        });
		
        return false;
	}

	function updatematerai()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/mastermateraiupdate';?>";

		//var INV_ENTITY_ID 	= $("#INV_ENTITY_ID").val();
		var INV_EMATERAI_ID 		= $("#ROWID1").val();
		var INV_EMATERAI_NUMBER 	= $("#INV_EMATERAI_NUMBER2").val();
		var INV_EMATERAI_REDAKSI 	= $("#INV_EMATERAI_REDAKSI2").val();
		var INV_EMATERAI_EFECTIVE1 	= $("#INV_EMATERAI_EFECTIVE2").val();
		var INV_EMATERAI_END1	 	= $("#INV_EMATERAI_END2").val();
		
		INV_EMATERAI_EFECTIVE 	= SetDate(INV_EMATERAI_EFECTIVE1);
		INV_EMATERAI_END	 	= SetDate(INV_EMATERAI_END1);

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		INV_EMATERAI_ID:INV_EMATERAI_ID, 
		INV_EMATERAI_NUMBER:INV_EMATERAI_NUMBER, 
		INV_EMATERAI_REDAKSI:INV_EMATERAI_REDAKSI,
		INV_EMATERAI_EFECTIVE:INV_EMATERAI_EFECTIVE, 
		INV_EMATERAI_END:INV_EMATERAI_END 
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						loaddatamaterai($('[name="ROWID"]').val());		
					} else {
						console.log(result);
						alert("data gagal disimpan");
					}
					$('#update-materai').modal('hide');
				} catch(e) {
					alert("data gagal disimpan");
					console.log(e);
				}
        });
		
        return false;
	}
	
	function editmaterai($id)
	{		
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/mastermateraiedit';?>";
			var INV_EMATERAI_ID 	= $id;
			$('[name="ROWID1"]').val($id);
			
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_EMATERAI_ID:INV_EMATERAI_ID
			}).done(function( data ) {	
				var data2 = JSON.parse(data);
				$('[name="INV_EMATERAI_NUMBER2"]').val(data2.INV_EMATERAI_NUMBER);
				$('[name="INV_EMATERAI_REDAKSI2"]').val(data2.INV_EMATERAI_REDAKSI);
				$('[name="INV_EMATERAI_EFECTIVE2"]').val(GetDate(data2.INV_EMATERAI_EFECTIVE));
				$('[name="INV_EMATERAI_END2"]').val(GetDate(data2.INV_EMATERAI_END));
				$('#update-materai').modal('show');
			});
			
			return false;
	}


	function loaddatafaktur($id){
		var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterfaktursearch';?>";

		var INV_ENTITY_ID 	= $id;

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_ENTITY_ID:INV_ENTITY_ID
		}).done(function( data ) {
			var data2 = JSON.parse(data);	
			var html = '';
			var i;
			var $no=0;
			for(i=0; i<Object.keys(data2).length; i++){
				$no++;
				html += '<tr>'+
						'<td>'+data2[i].INV_FAKTUR_NOTE+'</td>'+
						'<td>'+data2[i].INV_FAKTUR_EFECTIVE+'</td>'+
						'<td>'+data2[i].INV_FAKTUR_EXPIRED+'</td>'+
						'<td><button type="button" id="" name="" onclick="editfaktur(\''+data2[i].INV_FAKTUR_ID+'\')" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#update-faktur"><i class="fa fa-pencil-square"></i></button></td>'+
						'</tr>';
			}
			$('#show_faktur').html(html);
        });
		
        return false;
	}

	function savefaktur()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterfaktursave';?>";
		var INV_ENTITY_CODE 			= $("#INV_ENTITY_CODE").val();
		var INV_FAKTUR_NOTE 		= $("#INV_FAKTUR_NOTE").val();
		var INV_FAKTUR_EFECTIVE1 	= $("#INV_FAKTUR_EFECTIVE").val();
		var INV_FAKTUR_EXPIRED1		= $("#INV_FAKTUR_EXPIRED").val();
		var INV_FAKTUR_STATUS 		= 'Active';
		
		INV_FAKTUR_EFECTIVE	= SetDate(INV_FAKTUR_EFECTIVE1);
		INV_FAKTUR_EXPIRED	= SetDate(INV_FAKTUR_EXPIRED1);

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_FAKTUR_ID:INV_FAKTUR_ID,
			INV_FAKTUR_NOTE:INV_FAKTUR_NOTE, 
			INV_FAKTUR_EFECTIVE:INV_FAKTUR_EFECTIVE, 
			INV_FAKTUR_EXPIRED:INV_FAKTUR_EXPIRED, 
			INV_FAKTUR_STATUS:INV_FAKTUR_STATUS,
			INV_ENTITY_ID:INV_ENTITY_CODE 
			 
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						loaddatafaktur($('[name="ROWID"]').val());
					} else {
						console.log(result);
						alert("data gagal disimpan");
					}
					$('#update-materai').modal('hide');
				} catch(e) {
					alert("data gagal disimpan");
					console.log(e);
				}		
        });
		
        return false;
	}

	function savefaktur1()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterfaktursave';?>";
		var INV_ENTITY_CODE 			= $("#INV_ENTITY_CODEEDIT").val();
		var INV_FAKTUR_NOTE 		= $("#INV_FAKTUR_NOTE1").val();
		var INV_FAKTUR_EFECTIVE1 	= $("#INV_FAKTUR_EFECTIVE1").val();
		var INV_FAKTUR_EXPIRED1		= $("#INV_FAKTUR_EXPIRED1").val();
		var INV_FAKTUR_STATUS 		= 'Active';
		
		INV_FAKTUR_EFECTIVE	= SetDate(INV_FAKTUR_EFECTIVE1);
		INV_FAKTUR_EXPIRED	= SetDate(INV_FAKTUR_EXPIRED1);

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_FAKTUR_ID:INV_FAKTUR_ID,
			INV_FAKTUR_NOTE:INV_FAKTUR_NOTE, 
			INV_FAKTUR_EFECTIVE:INV_FAKTUR_EFECTIVE, 
			INV_FAKTUR_EXPIRED:INV_FAKTUR_EXPIRED, 
			INV_FAKTUR_STATUS:INV_FAKTUR_STATUS,
			INV_ENTITY_ID:INV_ENTITY_CODE 
			 
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
				if (result.status == "success") {
					loaddatafaktur($('[name="ROWID"]').val());
				} else {
					console.log(result);
					alert("data gagal disimpan");
				}
				$('#update-materai').modal('hide');
			} catch(e) {
				alert("data gagal disimpan");
				console.log(e);
			}		
        });
		
        return false;
	}

	function updatefaktur()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterfakturupdate';?>";

		//var INV_ENTITY_ID 	= $("#INV_ENTITY_ID").val();
		var INV_FAKTUR_ID 		= $("#ROWID2").val();
		var INV_FAKTUR_NOTE 	= $("#INV_FAKTUR_NOTE2").val();
		var INV_FAKTUR_EFECTIVE1 = $("#INV_FAKTUR_EFECTIVE2").val();
		var INV_FAKTUR_EXPIRED1 	= $("#INV_FAKTUR_EXPIRED2").val();
		// var INV_FAKTUR_STATUS 	= $("#INV_FAKTUR_STATUS2").val();

		INV_FAKTUR_EFECTIVE = SetDate(INV_FAKTUR_EFECTIVE1);
		INV_FAKTUR_EXPIRED = SetDate(INV_FAKTUR_EXPIRED1);
		
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		INV_FAKTUR_ID:INV_FAKTUR_ID, 
		INV_FAKTUR_NOTE:INV_FAKTUR_NOTE, 
		INV_FAKTUR_EFECTIVE:INV_FAKTUR_EFECTIVE,
		INV_FAKTUR_EXPIRED:INV_FAKTUR_EXPIRED 
		// INV_FAKTUR_STATUS:INV_FAKTUR_STATUS 
		}).done(function( data ) {
        });
		
        return false;
	}
	
	function editfaktur($id)
	{		
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterfakturedit';?>";
			var INV_FAKTUR_ID 	= $id;
			$('[name="ROWID2"]').val($id);

			
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_FAKTUR_ID:INV_FAKTUR_ID
			}).done(function( data ) {	
				var data2 = JSON.parse(data);
				$('[name="INV_FAKTUR_NOTE2"]').val(data2.INV_FAKTUR_NOTE);
				$('[name="INV_FAKTUR_EFECTIVE2"]').val(GetDate(data2.INV_FAKTUR_EFECTIVE));
				$('[name="INV_FAKTUR_EXPIRED2"]').val(GetDate(data2.INV_FAKTUR_EXPIRED));
				// $('#update_faktur').modal('show');
			});
			
			return false;
	}

	function loaddatabank($id){
		var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterbanksearch';?>";
		entityID = $id;
		var INV_SOURCE_ID 	= $id;
		$('[name="ROWID"]').val($id);

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_SOURCE_ID:INV_SOURCE_ID
		}).done(function( data ) {
			var data1 = JSON.parse(data);	
			var html = '';
			var i;
			var $no=0;
			for(i=0; i<Object.keys(data1).length; i++){
				$no++;
				html += '<tr>'+
						'<td>'+$no+'</td>'+
						'<td>'+data1[i].INV_BANK_NAME+'</td>'+
						'<td>'+data1[i].INV_BANK_REKENING+'</td>'+
						'<td><button type="button" id="" name="" onclick="editsignall(\''+data1[i].INV_BANK_ID+'\')" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#sigin_bank">Assign Bank</button></td>'+
						'<td><button type="button" id="" name="" onclick="editbank(\''+data1[i].INV_BANK_ID+'\')" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#edit_bank"><i class="fa fa-pencil-square"></i></button></td>'+
						'</tr>';
			}
			$('#show_bank').html(html);
        });
		
        return false;
	}

	function savebank()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterbanksave';?>";
		var INV_SOURCE_ID 			= $("#ROWID").val();
		var INV_BANK_REKENING 		= $("#INV_BANK_REKENING").val();
		var INV_BANK_NAME		 	= $("#INV_BANK_NAME").val();
		var INV_BANK_STATUS 		= 'Active';
		
		
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_SOURCE_ID:INV_SOURCE_ID,
			INV_BANK_REKENING:INV_BANK_REKENING, 
			INV_BANK_NAME:INV_BANK_NAME
			//INV_ENTITY_ID:INV_ENTITY_ID 
			 
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						loaddatabank(entityID);
						document.getElementById("formAddBank").reset();
					} else {
						alert("data gagal disimpan");
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}
        });
		
        return false;
	}

	function updatebank()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterbankupdate';?>";

		var INV_ENTITY_ID 		= $("#INV_ENTITY_ID").val();
		var INV_BANK_ID 		= $("#ROWID2").val();
		var INV_BANK_REKENING 	= $("#INV_BANK_REKENING1").val();
		var INV_BANK_NAME 		= $("#INV_BANK_NAME1").val();
		// var INV_BANK_STATUS 	= $("#INV_BANK_STATUS1").val();
		
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		INV_BANK_ID:INV_BANK_ID, 
		INV_BANK_REKENING:INV_BANK_REKENING, 
		INV_BANK_NAME:INV_BANK_NAME
		// INV_BANK_STATUS:INV_BANK_STATUS 
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						document.getElementById("formUpdateBank").reset();
						loaddatabank(entityID);
					} else {
						console.log(result);
						alert("data gagal disimpan");
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}
        });
		
        return false;
	}
	
	function editbank($id)
	{		
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterbankedit';?>";
			var INV_BANK_ID 	= $id;
			$('[name="ROWID2"]').val($id);
			
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_BANK_ID:INV_BANK_ID
			}).done(function( data ) {	
				var data2 = JSON.parse(data);
				$('[name="INV_BANK_ID1"]').val(data2.INV_BANK_ID);
				$('[name="INV_BANK_REKENING1"]').val(data2.INV_BANK_REKENING);
				$('[name="INV_BANK_NAME1"]').val(data2.INV_BANK_NAME);
				// $('[name="INV_BANK_STATUS1"]').val(data2.INV_BANK_STATUS);
				// $('#update_bank').modal('show');
			});
			
			return false;
	}
	
	function editsignall($id)
	{
		bankID = $id;
		editsignbank1($id);
		loaddatasignbank1($id)
	}
	function editsignbank1($id)
	{		
			// alert('123')
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterbankedit';?>";
			var INV_BANK_ID 	= $id;
			$('[name="ROWID4"]').val($id);
			
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_BANK_ID:INV_BANK_ID
			}).done(function( data ) {	
				var data2 = JSON.parse(data);
				$('[name="INV_BANK_NAME2"]').val(data2.INV_BANK_NAME);
				// $('#update_bank').modal('show');
			});
			
			return false;
	}
	
	function savesignbank()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/mastersignbanksave';?>";
		var INV_BANK_ID 			= $("#ROWID4").val();
		var INV_UNIT_CODE 		= $("#INV_UNIT_CODE").val();
		var INV_BANK_NAME		 	= $("#INV_BANK_NAME2").val();
		
		
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_BANK_ID:INV_BANK_ID,
			INV_UNIT_CODE:INV_UNIT_CODE, 
			INV_BANK_NAME:INV_BANK_NAME
			 
		}).done(function( data ) {
			try {
					var result = JSON.parse(data);
					if (result.status == "success") {
						loaddatasignbank1(bankID);
					} else {
						console.log(result);
						alert("data gagal disimpan");
					}
				} catch(e) {
					console.log(e);
					alert("data gagal disimpan");
				}
        });
		
        return false;
	}

	function loaddatasignbank1($id){
		//  alert($id);
		var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/mastersignbanksearch';?>";

		var INV_BANK_ID 	= $id;

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_BANK_ID:INV_BANK_ID
		}).done(function( data ) {
			var data1 = JSON.parse(data);	
			// alert(data1);die();
			var html = '';
			var i;
			var $no=0;
			for(i=0; i<Object.keys(data1).length; i++){
				$no++;
				html += '<tr>'+
						'<td>'+$no+'</td>'+
						'<td>'+data1[i].INV_UNIT_CODE+'</td>'+
						// '<td><button type="button" id="" name="" onclick="editsignbank2(\''+data1[i].INV_SIGNBANK_ID+'\')" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#edit_sigin_bank"><i class="fa fa-pencil-square"></i></button></td>'+
						'</tr>';
			}
			$('#show_signbank').html(html);
        });
		
        return false;
	}

	function editsignbank2($id)
	{		
			// alert('123')
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/mastersignbankedit';?>";
			var INV_SIGNBANK_ID 	= $id;
			$('[name="ROWID5"]').val($id);
			
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_SIGNBANK_ID:INV_SIGNBANK_ID
			}).done(function( data ) {	
				var data2 = JSON.parse(data);
				$('[name="INV_UNIT_CODE3"]').val(data2.INV_UNIT_CODE);
				$('[name="INV_BANK_NAME3"]').val(data2.INV_BANK_NAME);
				// $('#update_bank').modal('show');
			});
			
			return false;
	}
	
	function updatesignbank()
	{		
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/mastersignbankupdate';?>";
		var INV_SIGNBANK_ID 			= $("#ROWID5").val();
		var INV_UNIT_CODE 		= $("#INV_UNIT_CODE3").val();
		var INV_BANK_NAME		 	= $("#INV_BANK_NAME3").val();
		
		
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_SIGNBANK_ID:INV_SIGNBANK_ID,
			INV_UNIT_CODE:INV_UNIT_CODE, 
			INV_BANK_NAME:INV_BANK_NAME
			 
		}).done(function( data ) {
			//belum ke pake
        });
		
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


