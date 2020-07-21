	<!-- Standard Bootstrap Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pendaftaran User Login</h4>
				</div>
				<div class="modal-body">
					<form role="form" name="userpassform">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="input" class="form-control" id="username" name="username" placeholder="Enter username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						<div class="form-group">
							<label for="password_retype">Retype Password</label>
							<input type="password" class="form-control" id="password_retype" placeholder="Password">
						</div>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					</form>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="passwordSaveButton" disabled >Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
