<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Administrasi</li>
			<li class="active"><span>Master User</span></li>
		</ol>

		<h1>MASTER USER</h1>
	</div>
</div>

<div class="container">
    <div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal" action="javascript:void(0)" id="formSearch">
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Nama</label>
											<div class="row">
												<div class="col-xs-5">
						                  			<input type="text" name="INV_USER_NAME2" id="INV_USER_NAME2" class="form-control" placeholder="Masukan Nama">
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
         <button class="btn btn-primary plus add_user btn-sm" data-toggle="modal" ><i class="fa fa-plus"></i></button>
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
	    <div class="clo-lg-12">
		    <div class="main-box clearfix">
			    <div class="main-box-body clearfix">
				    <div class="table-responsive">
					    <table id="table-example" class="table table-hover">
						    <thead>
							  <tr>
							  <th>#</th>
							  <th>Nama</th>
			                  <th>NIPP</th>
			                  <th>Username</th>
			                <!--   <th>Password</th> -->
			                  <th>Role</th>
			                  <th>Status</th>
			                  <th>Ket</th>
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

<div id="add_user" class="modal fade" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white" class="modal-title">Add New User</h4>
	        </div>
	        <div class="modal-body">
	        	<form id="formUserCreate">
	            <div class="form-group">
	            <div class="box-body">
	            <div class="main-box-body clearfix">
	            <div class="tabs-wrapper">
	        	<div class="tab-content">
				<div class="tab-pane fade in active" id="tab-home">

						<div class="box-body">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Nama</label>
								<div class="row">
									<div class="col-xs-5">
										<input type="text" value="" class="form-control" name="INV_USER_NAME" id="INV_USER_NAME" placeholder="Nama User" data-error="required" required />
									</div>
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>

	                	<div class="box-body">
	                		<div class="form-group">
			               		<label for="" class="col-sm-2 control-label">NIPP</label>
			                	<div class="row">
									<div class="col-xs-5">
									<input type="text" name="INV_USER_NIPP" id="INV_USER_NIPP" class="form-control" placeholder="Nipp" data-error="required" required>
									</div>
									<div class="help-block with-errors"></div>
								</div>
			            	</div>
		            	</div>

	                	<div class="box-body">
	                		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Username</label>
				                <div class="row">
									<div class="col-xs-5">
									<input type="text" name="INV_USER_USERNAME" id="INV_USER_USERNAME" class="form-control" placeholder="Username"  required>
									</div>
									 <div class="help-block"></div>
								</div>
			            	</div>
		            	</div>

	                	<div class="box-body">
	                		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Password</label>
				                <div class="row">
									<div class="col-xs-5">
									<input type="password" name="INV_USER_PASSWORD" id="INV_USER_PASSWORD" class="form-control" data-error="Minimum of 6 characters"  minlength="6" maxlength="16">
									</div>
									 <div class="help-block with-errors"></div>
								</div>
			            	</div>
		            	</div>

		            	<div class="box-body">
	                		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Confirm Password</label>
				                <div class="row">
									<div class="col-xs-5">
									<input type="password" name="CONFIRM_INV_USER_PASSWORD" id="CONFIRM_INV_USER_PASSWORD" class="form-control"  minlength="6" maxlength="16" placeholder="Enter again to validate"   data-match="#INV_USER_PASSWORD" data-match-error="Whoops, password don't match" placeholder="Confirm" required>
									</div>
									<div class="help-block with-errors"></div>
								</div>
			            	</div>
		            	</div>

		            	<div class="box-body">
		            		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Role</label>
				                <div class="row">
									<div class="col-xs-5">
										<select class="form-control select2"  name="INV_USER_ROLE1" id="INV_USER_ROLE1" style="width: 100%;">
										<?php foreach($role as $roleid) { ?>
											<option value="<?php echo $roleid->INV_ROLE_ID;?>"><?php echo $roleid->INV_ROLE_NAME;?></option>
										<?php } ?>
										</select>
									</div>
								</div>
			            	</div>
		            	</div>


		            	<div class="box-body hidden">
		            		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Entity</label>
				                <div class="row">
									<div class="col-xs-5">
										<select class="form-control select2"  name="INV_USER_ENTITY1" id="INV_USER_ENTITY1" style="width: 100%;">
										<?php foreach($entity as $entitys) { ?>
											<option value="<?php echo $entitys->INV_ENTITY_ID ?>"><?php echo $entitys->INV_ENTITY_NAME ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
			            	</div>
		            	</div>

						<div class="box-body hidden">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Status</label>
								<div class="row">
									<div class="col-xs-3">
										<select class="form-control select2" style="width: 100%;"
										name="INV_USER_STATUS" id="INV_USER_STATUS">
											<option value="Active">Active</option>
											<option value="Not Active">Not Active</option>
										</select>
									</div>
								</div>
							</div>
						</div>

				</div>
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Valid</label>
							<div class="row">
								<div class="col-xs-4">
									<input type="date" class="form-control" name="INV_USER_EFECTIVE" id="INV_USER_EFECTIVE" placeholder="Effective" required/>
								</div>
								<div class="col-xs-4">
									<input type="date" class="form-control" name="INV_USER_EXPIRED" id="INV_USER_EXPIRED" placeholder="Expired" required />
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
		<div class="modal-footer">
				<button  type="submit" id="submit" name="submit" class="btn btn-primary btn_user_save btn-sm" >Save</button>
				<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
		</div>
	    </div>

	     </form>
	</div>
</div>

<div id="update_user" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white" class="modal-title">Update User <span class="nama_x"></span></h4>
	        </div>
	        <div class="modal-body">
	        	<form id="form_update" href="javascript:void(0)">
	            <div class="form-group">
	            <div class="box-body">
	            <div class="main-box-body clearfix">
	            <div class="tabs-wrapper">
	        	<div class="tab-content">
				<div class="tab-pane fade in active" id="tab-home">
					<input type="text" class="id_x hidden" value="">
						<div class="box-body">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Nama</label>
								<div class="row">
									<div class="col-xs-5">
										<input type="text" value="" name="INV_USER_NAME1" id="INV_USER_NAME1" class="form-control" placeholder="Nama User" data-error="required" required >
									</div>
									<div class="help-block with-errors"></div>

								</div>
							</div>
						</div>

	                	<div class="box-body">
	                		<div class="form-group">
			               		<label for="" class="col-sm-2 control-label">NIPP</label>
			                	<div class="row">
									<div class="col-xs-5">
									<input type="text"  value="" name="INV_USER_NIPP1" id="INV_USER_NIPP1" class="form-control" placeholder="Nipp" data-error="required" required>
									</div>
									<div class="help-block with-errors"></div>
								</div>
			            	</div>
		            	</div>

	                	<div class="box-body">
	                		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Username</label>
				                <div class="row">
									<div class="col-xs-5">
									<input type="text" name="INV_USER_USERNAME1" id="INV_USER_USERNAME1" class="form-control" placeholder="Username" data-error="required" required>
									</div>
									<div class="help-block with-errors"></div>
								</div>
			            	</div>
		            	</div>

		            	<div class="box-body">
	                		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Update Password</label>
				                <div class="row">
									<div class="col-xs-5">
									<input type="password" name="NEW_USER_PASSWORD" id="NEW_USER_PASSWORD" class="form-control" data-error="Minimum of 6 characters"  minlength="6" maxlength="16">
									</div>
									 <div class="help-block with-errors">Isi jika ingin merubah password</div>
								</div>
			            	</div>
		            	</div>

		            	<div class="box-body">
		            		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Role</label>
				                <div class="row">
									<div class="col-xs-5">
										<select class="form-control select2"  name="INV_USER_ROLE1" id="INV_USER_ROLE2" style="width: 100%;">
										<?php foreach($role as $roleid) { ?>
											<option value="<?php echo $roleid->INV_ROLE_ID;?>"><?php echo $roleid->INV_ROLE_NAME;?></option>
										<?php } ?>
										</select>
									</div>
									<div class="help-block with-errors"></div>
								</div>
			            	</div>
		            	</div>


		            	<div class="box-body hidden">
		            		<div class="form-group">
				                <label for="" class="col-sm-2 control-label">Entity</label>
				                <div class="row">
									<div class="col-xs-5">
										<select class="form-control select2"  name="INV_USER_ENTITY1" id="INV_USER_ENTITY2" style="width: 100%;" >
										<?php foreach($entity as $entitys) { ?>
											<option value="<?php echo $entitys->INV_ENTITY_ID ?>"><?php echo $entitys->INV_ENTITY_NAME ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
			            	</div>
		            	</div>

						<div class="box-body">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Status</label>
								<div class="row">
									<div class="col-xs-3">
										<select class="form-control select2" style="width: 100%;"  value=""
										name="INV_USER_STATUS1" id="INV_USER_STATUS1">
											<option value="Active">Active</option>
											<option value="Not Active">Not Active</option>
										</select>
									</div>
								</div>
							</div>
						</div>

				</div>
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Valid</label>
							<div class="row">
								<div class="col-xs-4">
									<input type="date"   value="" class="form-control" name="INV_USER_EFECTIVE1" id="INV_USER_EFECTIVE1" placeholder="Effective" />
								</div>

								<div class="col-xs-4">
									<input type="date"  value="" class="form-control" name="INV_USER_EXPIRED1"  id="INV_USER_EXPIRED1" placeholder="Expired" />
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

		<div class="modal-footer">
				<button  type="submit" id="submit" name="submit"  class="btn btn-primary btn-sm" >Update</button>
				<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
		</div>
	    </div>
	    </form>
	</div>
</div>

<div id="add_config" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Assign Role</h4>
	        </div>
	        <div class="modal-body">
			<form id="form1">

	        <div class="form-group">
	                	<div class="box-body">
							<div class="main-box-body clearfix">
								<div class="tabs-wrapper">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-role" data-toggle="tab">Role</a></li>
										<!-- <li><a href="#tab-home" data-toggle="tab">General</a></li> -->
									</ul>
								</div>
							</div>
							<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-role">
											<form class="form-horizontal">

												<div class="table-responsive">
													<table id="table-pejabat" class="table table-hover">
														<thead>
																<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_userrole"><i class="fa fa-plus"></i></button>
																<br\>
																<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#update_notconf"><i class="fa fa-pencil-square"></i></button> -->
																<tr>
																	<th>No</th>
																	<th>Role Name</th>
																	<th>Valid From</th>
																	<th>Valid To</th>
																</tr>
														</thead>
										 				<tbody id="show_userrole">
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

<div id="add_userrole" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Add Role</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-home">

								<input type="text" name="INV_ROLE_NAME_X" class="hidden" value="" id="INV_ROLE_NAME_X">
								<form class="form-horizontal">

									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Role Name</label>
												<div class="row">
													<div class="col-xs-4">
														<select class="form-control select2 select_role"  name="INV_ROLE_NAME1" id="INV_ROLE_NAME1" style="width: 100%;">
														<?php foreach($role as $roleid) { ?>
															<option value="<?php echo $roleid->INV_ROLE_ID;?>"><?php echo $roleid->INV_ROLE_NAME;?></option>
														<?php } ?>
														</select>
													</div>
												</div>
										</div>
									</div>

									<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Valid</label>
													<div class="row">
														<div class="col-xs-4">
															<input type="Date" class="form-control" name="INV_USERROLE_EFECTIVE1" id="INV_USERROLE_EFECTIVE1" placeholder="Effective" />
														</div>
														<div class="col-xs-4">
															<input type="Date" class="form-control" name="INV_USERROLE_EXPIRED1" id="INV_USERROLE_EXPIRED1" placeholder="Expired" />
														</div>

													</div>
												</div>
											</div>
									</div>
							</form>
								</div>
									<div class="modal-footer">
										<button  type="button"  id="submit" name="submit" onclick="confirmaddrole()" class="btn btn-primary" data-dismiss="modal">Save</button>
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

<div id="update_userrole" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Update Role</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-home">
								<input type="text" name="INV_ROLE_NAME_X" class="hidden" value="" id="INV_ROLE_NAME_X2">
								<form class="form-horizontal">

								<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Role Name</label>
												<div class="row">
													<div class="col-xs-4">
														<select class="form-control select2 select_role2"  name="INV_ROLE_NAME2" id="INV_ROLE_NAME2" style="width: 100%;">
														<?php foreach($role as $roleid) { ?>
															<option value="<?php echo $roleid->INV_ROLE_ID;?>"><?php echo $roleid->INV_ROLE_NAME;?></option>
														<?php } ?>
														</select>
													</div>
												</div>
										</div>
									</div>

									<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Valid</label>
													<div class="row">
														<div class="col-xs-4">
															<input type="Date" class="form-control" name="INV_USERROLE_EFECTIVE2" id="INV_USERROLE_EFECTIVE2" placeholder="Effective" />
														</div>
														<div class="col-xs-4">
															<input type="Date" class="form-control" name="INV_USERROLE_EXPIRED2" id="INV_USERROLE_EXPIRED2" placeholder="Expired" />
														</div>

													</div>
												</div>
											</div>
									</div>
							</form>
								</div>
									<div class="modal-footer">
										<button  type="button"  id="submit" name="submit" onclick="confirmupdaterole()" class="btn btn-primary btn-sm" data-dismiss="modal">Update</button>
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


<div id="allert_add" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:black"; class="modal-title">Save user</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<button  type="button"  id="submit" name="submit"  class="btn btn-primary" data-dismiss="modal">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="allert_update" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:black"; class="modal-title">Update user</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<button  type="button"  id="submit" name="submit" onclick="updateuser()" class="btn btn-primary" data-dismiss="modal">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="allert_update" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:black"; class="modal-title">Update user</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<button  type="button"  id="submit" name="submit" onclick="updateuser()" class="btn btn-primary" data-dismiss="modal">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="confirm_add_role" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:black"; class="modal-title">Save role user</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<button  type="button"  id="submit" name="submit" onclick="saveuserrole()" class="btn btn-primary" data-dismiss="modal">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="confirm_update_role" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:black"; class="modal-title">Update role user</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<button  type="button"  id="submit" name="submit" onclick="updateuserrole()" class="btn btn-primary" data-dismiss="modal">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- setipa click table akan dimasukan nilai ROWID" /> -->
<input type="hidden" class="form-control" id="ROWID" name="ROWID"  placeholder="" />
<input type="hidden" class="form-control" id="ROWID1" name="ROWID1"  placeholder="" />

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.js"></script>




<script type="text/javascript">
// $('#INV_USER_EFECTIVE1').datepicker({
// 		autoclose: true,
// 		format: 'yyyy/mm/dd',
// 		startDate: '-3d'
// 	});
// 	$('#INV_USER_EXPIRED1').datepicker({
// 		autoclose:true,
// 		format: 'yyyy/mm/dd',
// 		startDate: '-3d'
// 	});
// 	$('#INV_USER_EFECTIVE').datepicker({
// 		autoclose: true,
// 		format: 'yyyy/mm/dd',
// 		startDate: '-3d'
// 	});
// 	$('#INV_USER_EXPIRED').datepicker({
// 		autoclose:true,
// 		format: 'yyyy/mm/dd',
// 		startDate: '-3d'
// 	});
	$('.add_user').click(function(){
	$('#form1')[0].reset();
	$('#formUserCreate')[0].reset();
	$('#add_user').modal({
		show:true,
		backdrop:'static'
	});
});
</script>

<script type="text/javascript">
function link_user(){
	window.location.href="<?php echo ROOT;?>einvoice/administrasi/adding_user";
}
</script>


<!-- <script>
	$('#myForm').validate({
    rules: {
        INV_USER_NAME: {
            minlength: 1,
            required: true
        },
    },
    highlight: function (element) {
        $('#INV_USER_NAME').removeClass('has-success').addClass('has-error');
    },
    success: function (element) {
        $('#INV_USER_NAME').removeClass('has-error').addClass('has-success');
    }
});
</script> -->

<script>
var table;
$( document ).ready(function() {
		//loaddata();
		// alert( "ready!" );
		var path = "<?php echo ROOT.'einvoice/administrasi/masterusersearch';?>";
		var INV_USER_NAME 		= $("#INV_USER_NAME2").val();
		 table = $('#table-example').DataTable({
		"processing": true, //Feature control the processing indicator.
		"order": [], //Initial no order.
		"dom" :"brtlp",
		"ajax": {
					"url": path,
					"type": "POST",
					"dom":"brtlp",
					"data":function (data){
					       data.<?php echo $this->security->get_csrf_token_name(); ?> ='<?php echo $this->security->get_csrf_hash(); ?>';
					       data.INV_USER_NAME=$("#INV_USER_NAME2").val();
					     },
		},
		//Set column definition initialisation properties.
		"columnDefs": [
				{
			        "targets": [ 0 ,6], //first column / numbering column
			        "orderable": false, //set not orderable
			    },
		],
			});
	});
// $('#INV_USER_NAME2').on( 'keyup', function () {
//     table
//         .search( this.value )
//         .draw();
// } );
function loaddata(){
	table.ajax.reload(null,true); //reload datatable ajax
}
function clearreset() {
		window.location.reload(true);
	}
	// function loaddata(){
		// var path = '';
		// path = "<?php echo ROOT.'einvoice/administrasi/masterusersearch';?>";
		// var INV_USER_NAME 		= $("#INV_USER_NAME2").val();
		// // alert(INV_NOTA_CODE);
		// $.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		// 	INV_USER_NAME:INV_USER_NAME
		// }).done(function( data ) {
		// 	var data1 = JSON.parse(data);
		// 	// alert(data1);die;
		// 	var html = '';
		// 	var i;
		// 	var $no=0;
		// 	for(i=0; i<Object.keys(data1).length; i++){
		// 		$no++;
		// 		$id = data1[i].INV_USER_ID;
		// 		html += '<tr>'+
		// 				'<td>'+$no+'</td>'+
		// 				'<td>'+data1[i].INV_USER_NAME+'</td>'+
		// 				'<td>'+data1[i].INV_USER_NIPP+'</td>'+
		// 				'<td>'+data1[i].INV_USER_USERNAME+'</td>'+
		// 				// '<td>'+data1[i].INV_USER_PASSWORD+'</td>'+
		// 				// '<td>'+data1[i].INV_USER_ROLE+'</td>'+
		// 				'<td>'+data1[i].INV_USER_STATUS+'</td>'+
		// 				// '<td>'+data1[i].INV_USER_NOTE+'</td>'+
		// 				'<td><button type="button" id="INV_NOTA_CODE3" name="INV_NOTA_CODE3" onclick="edituser(\''+$id+'\')"  value="" class="btn btn-info btn-lg" data-toggle="modal" data-target="update_user"><i class="fa fa-pencil-square"></i></button></td>'+
		// 				'<td><button type="button"  onclick="loaddata2(\''+$id+'\')"  class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_config"> Assign Role</button></td>'+
		// 				'</tr>';
		// 	}
		// 	// alert(html);die;
		// 	$('#show_data').html(html);
  //       });

  //       return false;
	// }

	function saveuser1()
	{
		$('#allert_add').modal('show');
		$('#form1').reset[0];
		$('#formUserCreate').reset[0];
	}
	$('#formUserCreate').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
		// handle the invalid form...
		} else {
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterusersave';?>";
		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var INV_USER_NAME 		= $("#INV_USER_NAME").val();
		var INV_USER_NIPP 	= $("#INV_USER_NIPP").val();
		var INV_USER_USERNAME		= $("#INV_USER_USERNAME").val();
		var INV_USER_PASSWORD 	= $("#INV_USER_PASSWORD").val();
		var INV_USER_EFECTIVE1 = $("#INV_USER_EFECTIVE").val();
		var INV_USER_EXPIRED1 = $("#INV_USER_EXPIRED").val();
		var INV_USER_STATUS = $("#INV_USER_STATUS").val();
		var INV_USER_NOTE = $("#INV_USER_NOTE").val();
		/*tambahan entity dan role*/
		var INV_USER_ROLE1 = $("#INV_USER_ROLE1").val();
		var INV_USER_ENTITY1 = $("#INV_USER_ENTITY1").val();

		INV_USER_EFECTIVE	= SetDate(INV_USER_EFECTIVE1);
		INV_USER_EXPIRED	= SetDate(INV_USER_EXPIRED1);
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_NOTA_ID:INV_NOTA_ID,
			INV_USER_NAME:INV_USER_NAME,
			INV_USER_NIPP:INV_USER_NIPP,
			INV_USER_USERNAME:INV_USER_USERNAME,
			INV_USER_PASSWORD:INV_USER_PASSWORD,
			INV_USER_EFECTIVE:INV_USER_EFECTIVE,
			INV_USER_EXPIRED:INV_USER_EXPIRED,
			INV_USER_STATUS:INV_USER_STATUS,
			INV_USER_NOTE:INV_USER_NOTE,
			INV_USER_ROLE_ID:INV_USER_ROLE1,
			INV_USER_ENTITY_ID:INV_USER_ENTITY1
		}).done(function( data ) {
			$('#allert_add').modal('show');
			var obj = jQuery.parseJSON(data);

          	var status = obj['status'];
          	if(obj['0']==409){
          		/*alert(obj['message']);*/
          	} else {
          		$('#add_user').modal('toggle');
          		/*alert(obj['message']);*/
          		loaddata();
          	}

        });

        return false;
		}
	});
$('.btn_user_update').click(function(){

})
	$('#form_update').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			return false;
		// handle the invalid form...
		} else {
			var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masteruserupdate';?>";
		var INV_USER_ID 		=  $('.id_x').val();
		var INV_USER_NAME 		= $("#INV_USER_NAME1").val();
		var INV_USER_NIPP 	= $("#INV_USER_NIPP1").val();
		var INV_USER_USERNAME		= $("#INV_USER_USERNAME1").val();
		var INV_USER_PASSWORD 	= $("#NEW_USER_PASSWORD").val();
		var INV_USER_EFECTIVE1 = $("#INV_USER_EFECTIVE1").val();
		var INV_USER_EXPIRED1 = $("#INV_USER_EXPIRED1").val();
		var INV_USER_STATUS = $("#INV_USER_STATUS1").val();
		var INV_USER_NOTE = $("#INV_USER_NOTE1").val();


		/*tambahan entity dan role*/
		var INV_USER_ROLE1 = $("#INV_USER_ROLE2").val();
		var INV_USER_ENTITY1 = $("#INV_USER_ENTITY2").val();
		INV_USER_EFECTIVE	= SetDate(INV_USER_EFECTIVE1);
		INV_USER_EXPIRED	= SetDate(INV_USER_EXPIRED1);
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_USER_ID:INV_USER_ID,
			INV_USER_NAME:INV_USER_NAME,
			INV_USER_NIPP:INV_USER_NIPP,
			INV_USER_USERNAME:INV_USER_USERNAME,
			INV_USER_PASSWORD:INV_USER_PASSWORD,
			INV_USER_EFECTIVE:INV_USER_EFECTIVE,
			INV_USER_EXPIRED:INV_USER_EXPIRED,
			INV_USER_STATUS:INV_USER_STATUS,
			INV_USER_NOTE:INV_USER_NOTE,
			INV_USER_ROLE_ID:INV_USER_ROLE1,
			INV_USER_ENTITY_ID:INV_USER_ENTITY1
		}).done(function( data ) {
			$('#update_user').modal('toggle');
			loaddata();
			 var obj = jQuery.parseJSON(data);
             var status = obj['status'];
             $('#allert_update').modal('show');
			 if(status=='success'){
			 	 /*alert('success update data');*/
			 } else {
			 	 /*alert('failed update data');*/
			 }


        });

			return false;
		}
	});
	function saveuser()
	{

	}

	function updateuser1()
	{
		$('#allert_update').modal('show');
	}

	function updateuser()
	{

	}
	// function post_update(){
	// 	alert('post uodate');
	// 	var path = '';
	// 	path = "<?php echo ROOT.'einvoice/administrasi/masteruserupdate';?>";
	// 	var INV_USER_ID 		= $('.id_x').val();
	// 	var INV_USER_NAME 		= $("#INV_USER_NAME1").val();
	// 	var INV_USER_NIPP 	= $("#INV_USER_NIPP1").val();
	// 	var INV_USER_USERNAME		= $("#INV_USER_USERNAME1").val();
	// 	var INV_USER_PASSWORD 	= $("#INV_USER_PASSWORD1").val();
	// 	var INV_USER_EFECTIVE1 = $("#INV_USER_EFECTIVE1").val();
	// 	var INV_USER_EXPIRED1 = $("#INV_USER_EXPIRED1").val();
	// 	var INV_USER_STATUS = $("#INV_USER_STATUS1").val();
	// 	var INV_USER_NOTE = $("#INV_USER_NOTE1").val();

	// 	/*tambahan entity dan role*/
	// 	var INV_USER_ROLE1 = $("#INV_USER_ROLE2").val();
	// 	var INV_USER_ENTITY1 = $("#INV_USER_ENTITY2").val();
	// 	INV_USER_EFECTIVE	= SetDate(INV_USER_EFECTIVE1);
	// 	INV_USER_EXPIRED	= SetDate(INV_USER_EXPIRED1);
	// 	$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
	// 		INV_USER_ID:INV_USER_ID,
	// 		INV_USER_NAME:INV_USER_NAME,
	// 		INV_USER_NIPP:INV_USER_NIPP,
	// 		INV_USER_USERNAME:INV_USER_USERNAME,
	// 		INV_USER_PASSWORD:INV_USER_PASSWORD,
	// 		INV_USER_EFECTIVE:INV_USER_EFECTIVE,
	// 		INV_USER_EXPIRED:INV_USER_EXPIRED,
	// 		INV_USER_STATUS:INV_USER_STATUS,
	// 		INV_USER_NOTE:INV_USER_NOTE,
	// 		INV_USER_ROLE_ID:INV_USER_ROLE1,
	// 		INV_USER_ENTITY_ID:INV_USER_ENTITY1
	// 	}).done(function( data ) {
	// 		loaddata();
 //        });


 //        return false;
	// }

	function edituser($id)
	{
			$('#form_update')[0].reset();
			// alert($id);die;
			$('.id_x').val($id);
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masteruseredit';?>";
			var INV_USER_ID 	= $id;
			$('[name="ROWID"]').val($id);
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_USER_ID:INV_USER_ID
			}).done(function( data ) {
				var data1 = JSON.parse(data);
				 //alert($data1);
			for(i=0; i<Object.keys(data1).length; i++){
				var eff = GetDate(data1[i].INV_USER_EFECTIVE);
				var exp = GetDate(data1[i].INV_USER_EXPIRED);
				// alert(eff);die;
				$('.nama_x').text(data1[i].INV_USER_NAME);
				$('[name="INV_USER_NAME1"]').val(data1[i].INV_USER_NAME);
				$('[name="INV_USER_NIPP1"]').val(data1[i].INV_USER_NIPP);
				$('[name="INV_USER_USERNAME1"]').val(data1[i].INV_USER_USERNAME);
				// $('[name="INV_USER_PASSWORD1"]').val(data1[i].INV_USER_PASSWORD);
				$('[name="INV_USER_STATUS1"]').val(data1[i].INV_USER_STATUS);
				$('[name="INV_USER_NOTE1"]').val(data1[i].INV_USER_NOTE);
				$('[name="INV_USER_EFECTIVE1"]').val(eff);
				$('[name="INV_USER_EXPIRED1"]').val(exp);
				/*entity and role*/
				$("#INV_USER_ROLE2").val(data1[i].INV_USER_ROLE_ID);
				$("#INV_USER_ENTITY2").val(data1[i].INV_USER_ENTITY_ID);
				$('#update_user').modal('show');
			}
			});

			return false;
	}
	//assign role

	function confirmaddrole()
	{
		$('#confirm_add_role').modal('show');
	}
	function confirmupdaterole()
	{
		$('#confirm_update_role').modal('show');
	}
	function loaddata2($id){
		// alert($id);
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masteruserrolesearch';?>";
		var INV_USER_ID 		= $id;
		$('[name="ROWID"]').val($id);
		// alert(INV_NOTA_CODE);
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_USER_ID:INV_USER_ID
		}).done(function( data ) {
			var data1 = JSON.parse(data);
			// alert(data1);die;
			var html = '';
			var i;
			var $no=0;
			for(i=0; i<Object.keys(data1).length; i++){
				$no++;
				$id = data1[i].INV_USERROLE_ID;
				html += '<tr>'+
						'<td>'+$no+'</td>'+
						'<td>'+data1[i].INV_ROLE_NAME+'</td>'+
						'<td>'+data1[i].INV_USERROLE_EFECTIVE+'</td>'+
						'<td>'+data1[i].INV_USERROLE_EXPIRED+'</td>'+
						// '<td>'+data1[i].INV_USER_NOTE+'</td>'+
						'<td><button type="button" id="INV_NOTA_CODE3" name="INV_NOTA_CODE3" onclick="edituserrole(\''+$id+'\')"  value="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="update_userrole"><i class="fa fa-pencil-square"></i></button></td>'+
						'</tr>';
			}
			// alert(html);die;
			$('#show_userrole').html(html);
		});
		return false;
	}
	$('.select_role').change(function(){
		var str = "";
	    $( ".select_role option:selected" ).each(function() {
	      str += $( this ).text() + " ";
	    });

	    $('#INV_ROLE_NAME_X').val(str);
	});
	$('.select_role2').change(function(){
		var str = "";
	    $( ".select_role2 option:selected" ).each(function() {
	      str += $( this ).text() + " ";
	    });

	    $('#INV_ROLE_NAME_X2').val(str);
	});
	function saveuserrole()
	{
		// alert('124');
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masteruserrolesave';?>";
		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var INV_USER_ID 		= $("#ROWID").val();
		var INV_ROLE_ID 	= $("#INV_ROLE_NAME1").val();
		var INV_USERROLE_EFECTIVE1 = $("#INV_USERROLE_EFECTIVE1").val();
		var INV_USERROLE_EXPIRED1 = $("#INV_USERROLE_EXPIRED1").val();
		var INV_ROLE_NAME_X = $("#INV_ROLE_NAME_X").val();
		INV_USERROLE_EFECTIVE	= SetDate(INV_USERROLE_EFECTIVE1);
		INV_USERROLE_EXPIRED	= SetDate(INV_USERROLE_EXPIRED1);
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_USER_ID:INV_USER_ID,
			INV_ROLE_ID:INV_ROLE_ID,
			INV_USERROLE_EFECTIVE:INV_USERROLE_EFECTIVE,
			INV_USERROLE_EXPIRED:INV_USERROLE_EXPIRED,
			INV_ROLE_NAME:INV_ROLE_NAME_X
		}).done(function( data ) {
			loaddata2(INV_USER_ID);
			loaddata();
        });

        return false;
	}
	function updateuserrole()
	{
		// alert('124');
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masteruserroleupdate';?>";
		var INV_USERROLE_ID 		= $("#ROWID1").val();
		var INV_USER_ID 		= $("#ROWID").val();
		var INV_ROLE_ID 	= $("#INV_ROLE_NAME1").val();
		var INV_ROLE_ID 	= $("#INV_ROLE_NAME2").val();
		var INV_USERROLE_EFECTIVE1 = $("#INV_USERROLE_EFECTIVE2").val();
		var INV_USERROLE_EXPIRED1 = $("#INV_USERROLE_EXPIRED2").val();
		var INV_ROLE_NAME_X = $("#INV_ROLE_NAME2 option:selected").text();

		INV_USERROLE_EFECTIVE	= SetDate(INV_USERROLE_EFECTIVE1);
		INV_USERROLE_EXPIRED	= SetDate(INV_USERROLE_EXPIRED1);
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_USERROLE_ID:INV_USERROLE_ID,
			INV_USER_ID:INV_USER_ID,
			INV_ROLE_ID:INV_ROLE_ID,
			INV_USERROLE_EFECTIVE:INV_USERROLE_EFECTIVE,
			INV_USERROLE_EXPIRED:INV_USERROLE_EXPIRED,
			INV_ROLE_NAME:INV_ROLE_NAME_X
		}).done(function( data ) {
			loaddata2(INV_USER_ID);
			loaddata();
        });

        return false;
	}

	function edituserrole($id)
	{
			// alert($id);die;
			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masteruserroleedit';?>";
			var INV_USERROLE_ID 	= $id;
			$('[name="ROWID1"]').val($id);
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_USERROLE_ID:INV_USERROLE_ID
			}).done(function( data ) {
				var data1 = JSON.parse(data);
				 //alert($data1);
			for(i=0; i<Object.keys(data1).length; i++){
				var eff = GetDate(data1[i].INV_USERROLE_EFECTIVE);
				var exp = GetDate(data1[i].INV_USERROLE_EXPIRED);
				// alert(eff);die;
				$('[name="INV_ROLE_NAME2"]').val(data1[i].INV_ROLE_ID);
				$('[name="INV_USERROLE_EFECTIVE2"]').val(eff);
				$('[name="INV_USERROLE_EXPIRED2"]').val(exp);
				$('#update_userrole').modal('show');
			}
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
