<div class="container text-right">
	<div class="box-body">
		<div class="form-group">
			<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_unit"><i class="fa fa-plus"></i> Create Biller</button>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="clo-lg-12">
			<div class="main-box clearfix">
				<div class="main-box-body clearfix">
					<div class="table-responsive" style="width: 100%; margin-top:30px;">
						<table id="mastertable" class="table table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Biller</th>
									<th>Kode Biller</th>
									<th>Kode Cabang</th>
									<th>Unit</th>
									<th>Status</th>
									<th>Created Date</th>
									<th>Updated Date</th>
									<th>Action</th>
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

<?php
$role_id =  $this->session->userdata('role_id');
//remark by Derry 17 Nov 2019: variable $user_role tidak digunakan dinamapun
//$user_role = $this->auth_model->get_lastrole($role_id);
$unit_code = $this->auth_model->get_filter_role($role_id);
?>

<div id="add_unit" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" ; class="modal-title">Add Master Biller</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="box-body">
						<div class="main-box-body clearfix">

							<form class="form-horizontal">
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">KODE CABANG</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="KODE_CABANG" id="KODE_CABANG" class="form-control" placeholder="Kode cabang" required>
												</div>

											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Nama Biller</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="NAME_BILLER" id="NAME_BILLER" class="form-control" placeholder="Nama Biller" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Kode Biller</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="KODE_BILLER" id="KODE_BILLER" class="form-control" placeholder="Kode Biller" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Alamat</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="ALAMAT" id="ALAMAT" class="form-control" placeholder="Alamat" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Kota</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="KOTA" id="KOTA" class="form-control" placeholder="Kota" required>
												</div>
											</div>
										</div>
										<div class="box-body">
											<div class="form-group">
												<label for="" class="col-sm-3 control-label">Status</label>
												<div class="row">
													<div class="col-sm-8">
														<select class="form-control select2" name="STATUS" id="STATUS">
															<option value="0">Aktif</option>
															<option value="1">Tidak Aktif</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="box-body">
											<div class="form-group">
												<label for="" class="col-sm-3 control-label">Telepon</label>
												<div class="row">
													<div class="col-sm-8">
														<input type="text" name="TELEPON" id="TELEPON" class="form-control" placeholder="Telepon" required>
													</div>
												</div>
											</div>
										</div>
										<div class="box-body">
											<div class="form-group">
												<label for="" class="col-sm-3 control-label">Email</label>
												<div class="row">
													<div class="col-sm-8">
														<input type="text" name="EMAIL" id="EMAIL" class="form-control" placeholder="Email" required>
													</div>
												</div>
											</div>
										</div>
										<div class="box-body">
											<div class="form-group">
												<label for="" class="col-sm-3 control-label">NPWP</label>
												<div class="row">
													<div class="col-sm-8">
														<input type="text" name="NPWP" id="NPWP" class="form-control" placeholder="NPWP" required>

													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">UNIT</label>
											<div class="row">
												<div class="col-sm-8">
													<select class="form-control select2" name="UNIT" id="UNIT" style="width: 100%; margin-top: 8px;">
														<?php if (count($unit_code) == 1) { ?>
															<option value="<?php echo $layanan->INV_UNIT_ID ?>"><?php echo $layanan->INV_UNIT_NAME; ?></option>
														<?php } else { ?>
															<option value="ALL_UNIT">ALL UNIT</option>
															<?php foreach ($unit1 as $key => $value) { ?>
																<option value="<?php echo $value->INV_UNIT_ID; ?>"><?php echo $value->INV_UNIT_NAME; ?></option>
															<?php } ?>
														<?php } ?>
													</select>
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
			<div class="modal-footer">
				<button type="button" id="submit" name="submit" onclick="check_validation()" class="btn btn-primary btn-sm">Simpan</button>
				<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div id="edit_biller" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" ; class="modal-title">Edit Master Biller</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="box-body">
						<div class="main-box-body clearfix">

							<form class="form-horizontal">
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Nama Biller (*) :</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="NAME_BILLER1" id="NAME_BILLER1" class="form-control" placeholder="Nama Biller">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Kode Biller (*) :</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="KODE_BILLER1" id="KODE_BILLER1" class="form-control" placeholder="Kode Biller">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Alamat (*) :</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="ALAMAT1" id="ALAMAT1" class="form-control" placeholder="Alamat">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Kota (*) :</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="KOTA1" id="KOTA1" class="form-control" placeholder="Kota">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Status (*) :</label>
											<div class="row">
												<div class="col-sm-8">
													<div class="row">
														<div class="col-sm-8">
															<select class="form-control select2" name="STATUS1" id="STATUS1">
																<option value="0">Aktif</option>
																<option value="1">Tidak Aktif</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="box-body">
											<div class="form-group">
												<label for="" class="col-sm-3 control-label">Telepon (*) :</label>
												<div class="row">
													<div class="col-sm-8">
														<input type="text" name="TELEPON1" id="TELEPON1" class="form-control" placeholder="Telepon">
													</div>
												</div>
											</div>
										</div>
										<div class="box-body">
											<div class="form-group">
												<label for="" class="col-sm-3 control-label">Email (*) :</label>
												<div class="row">
													<div class="col-sm-8">
														<input type="text" name="EMAIL1" id="EMAIL1" class="form-control" placeholder="Email">
													</div>
												</div>
											</div>
										</div>
										<div class="box-body">
											<div class="form-group">
												<label for="" class="col-sm-3 control-label">NPWP (*) :</label>
												<div class="row">
													<div class="col-sm-8">
														<input type="text" name="NPWP1" id="NPWP1" class="form-control" placeholder="NPWP" required="Nomor NPWP harus 15 Digit">

													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">UNIT (*) :</label>
											<div class="row">
												<div class="col-sm-8">
													<select class="form-control select2" name="UNIT1" id="UNIT1">
														<?php foreach ($unit1 as $unit) { ?>
															<option value="<?php echo $unit->INV_UNIT_ID; ?>"><?php echo $unit->INV_UNIT_NAME; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Kode cabang (*) :</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="KODE_CABANG1" id="KODE_CABANG1" class="form-control" placeholder="Kode cabang">
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
			<div class="modal-footer">
				<button type="button" id="submit" name="submit" onclick="confirmation1()" class="btn btn-primary btn-sm">Simpan</button>
				<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
			</div>
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
				<button class=" btn btn-primary" id="" data-dismiss="modal" onclick="savebiller()">Ya</button>
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
				<h1>Data belum sesuai!</h1>
			</div>
			<div class="modal-footer">
				<button class=" btn btn-primary" data-dismiss="modal" id="">Ok</button>
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

<div class="modal fade" id="BillerUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color: white;">Update Biller</h4>
			</div>
			<div class="modal-body">
				<!--  <input type="hidden" name="kode" id="textkode" value=""> -->
				<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" id="" data-dismiss="modal" onclick="updatebiller()">Ya</button>
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
				<div>
					<h1>Apakah Anda yakin merubah data ini ?</h1>
				</div>
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
					<div>
						<h1>Apakah Anda yakin merubah data ini ?</h1>
					</div>
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

<input type="hidden" value="" name="ROWID" id="ROWID" class="form-control" /></input>
<input type="hidden" value="" name="ROWID1" id="ROWID1" class="form-control" /></input>
<input type="hidden" value="" name="ROWID2" id="ROWID2" class="form-control" /></input>
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
		oFReader.onload = function(oFREvent) {
			document.getElementById("uploadPreview").src = oFREvent.target.result;
		};
	};
</script>

<script type="text/javascript">
	function PreviewEdit() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("INV_PEJABAT_TTD1").files[0]);
		oFReader.onload = function(oFREvent) {
			document.getElementById("uploadPreviewEdit").src = oFREvent.target.result;
		};
	};
</script>


<script>
	var INV_UNIT_ID;
	var INV_PEJABAT_ID;
	$(document).ready(function() {

		loaddata();

	});
	$("#formSearch").on('submit', (function(e) {
		e.preventDefault();
		loaddata();
	}));

	function clearreset() {
		window.location.reload(true);
	}

	function confirmation() {
		$('#UnitSave').modal('show');
	}

	function confirmation1() {
		$('#BillerUpdate').modal('show');
		// alert('insert data sukses!');
	}

	function check_validation() {
		var KODE_CABANG = $('input[id="KODE_CABANG"]').val(),
			intRegex = /[0-9 -()+]+$/;
		var NAME_BILLER = $('input[id="NAME_BILLER"]').val();
		var KODE_BILLER = $('input[id="KODE_BILLER"]').val();
		var ALAMAT = $('input[id="ALAMAT"]').val();
		var KOTA = $('input[id="KOTA"]').val();
		var TELEPON = $('input[id="TELEPON"]').val(),
			intRegex = /[0-9 -()+]+$/;
		var EMAIL = $('input[id="EMAIL"]').val(),
			emailReg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var NPWP = $('input[id="NPWP"]').val();
		var UNIT = document.getElementById('UNIT').value;

		if ((KODE_CABANG.length <= 2) || (!intRegex.test(KODE_CABANG))) {
			alert('Please enter a kode cabang 2 characters or more.');
			return false;
		}

		if (NAME_BILLER.length < 3) {
			alert('Please enter a nama biller 3 characters or more.');
			return false;
		}

		if (KODE_BILLER.length < 3) {
			alert('Please enter a kode biller 3 characters or more.');
			return false;
		}

		if (ALAMAT.length < 3) {
			alert('Please enter a alamat 3 characters or more.');
			return false;
		}

		if (KOTA.length < 3) {
			alert('Please enter a kota 3 characters or more.');
			return false;
		}
		//validate phone

		if ((TELEPON.length < 6) || (!intRegex.test(TELEPON))) {
			alert('Please enter a valid phone number.');
			return false;
		}
		//validate email

		if (!emailReg.test(EMAIL) || EMAIL == '') {
			alert('Please enter a valid email address.');
			return false;
		}

		if (NPWP.length != 15) {
			alert('Please enter a npwp 15 characters.');
			return false;
		}

		if(UNIT == 'ALL_UNIT') {
			alert('Please choose a unit.');
			return false;
		}
		///	console.log(NPWP.length);
		/*if (NPWP.length > 15) {
			alert('Please enter a npwp 15 characters.');
			return false;

		}*/


		$('#UnitSave').modal('show');
		$('#add_unit').modal('hide');


	}

	function check_validation1() {
		var INV_PEJABAT_NAME = document.getElementById('INV_PEJABAT_NAME').value;
		var INV_PEJABAT_NIPP = document.getElementById('INV_PEJABAT_NIPP').value;
		var INV_PEJABAT_JABATAN = document.getElementById('INV_PEJABAT_JABATAN').value;
		var INV_PEJABAT_EFECTIVE = document.getElementById('INV_PEJABAT_EFECTIVE').value;
		var INV_PEJABAT_EXPIRED = document.getElementById('INV_PEJABAT_EXPIRED').value;
		var INV_UNIT = document.getElementById('UNIT').value;

		if (INV_PEJABAT_NAME == "" || INV_PEJABAT_NIPP == "" || INV_PEJABAT_JABATAN == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED == "" || INV_UNIT == "ALL_UNIT") {
			$('#UnitCheck').modal('show');
		} else {
			confirmation2();
		}

	}

	function confirmation2() {

		var INV_PEJABAT_NAME = document.getElementById('INV_PEJABAT_NAME').value;
		var INV_PEJABAT_NIPP = document.getElementById('INV_PEJABAT_NIPP').value;
		var INV_PEJABAT_JABATAN = document.getElementById('INV_PEJABAT_JABATAN').value;
		var INV_PEJABAT_EFECTIVE = document.getElementById('INV_PEJABAT_EFECTIVE').value;
		var INV_PEJABAT_EXPIRED = document.getElementById('INV_PEJABAT_EXPIRED').value;

		if (INV_PEJABAT_NAME == "" || INV_PEJABAT_NIPP == "" || INV_PEJABAT_JABATAN == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED == "") {
			$('#PejabatCheck').modal('show');

		} else {

			$('#AddUnitPejabat').modal('show');
			// alert('insert data sukses!');
		}
	}

	function confirmation3() {
		var INV_REDAKSI_ATAS = document.getElementById('INV_REDAKSI_ATAS1').value;
		var INV_REDAKSI_BAWAH = document.getElementById('INV_REDAKSI_BAWAH1').value;
		var INV_PEJABAT_EFECTIVE = document.getElementById('INV_REDAKSI_EFECTIVE1').value;
		var INV_PEJABAT_EXPIRED = document.getElementById('INV_REDAKSI_EXPIRED1').value;

		if (INV_REDAKSI_ATAS == "" || INV_REDAKSI_BAWAH == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED == "") {
			$('#RedaksiCheck').modal('show');
		} else {
			$('#AddRekasiConfirm').modal('show');
			// alert('insert data sukses!');
		}
	}

	function confirmation4() {
		var INV_PEJABAT_NAME = document.getElementById('INV_PEJABAT_NAME1').value;
		var INV_PEJABAT_NIPP = document.getElementById('INV_PEJABAT_NIPP1').value;
		var INV_PEJABAT_JABATAN = document.getElementById('INV_PEJABAT_JABATAN1').value;
		var INV_PEJABAT_EFECTIVE = document.getElementById('INV_PEJABAT_EFECTIVE1').value;
		var INV_PEJABAT_EXPIRED = document.getElementById('INV_PEJABAT_EXPIRED1').value;

		if (INV_PEJABAT_NAME == "" || INV_PEJABAT_NIPP == "" || INV_PEJABAT_JABATAN == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED == "") {
			$('#UpdateUnitCheck').modal('show');
		} else {

			$('#UpdatePejabatConfirm').modal('show');
			// alert('insert data sukses!');
		}
	}


	function loaddata() {
		// alert('1234');
		var path = '';
		path = "<?php echo ROOT . 'va/manage/masterbillersearch'; ?>";

		var SEARCH_BY = $("#SEARCH_BY").val();
		var SEARCH = $("#SEARCH").val();

		$('#mastertable').DataTable({
			"pageLength": 10,
			"destroy": true,
			"dom": "lftipr",
			"ajax": {
				"url": path,
				data: function(d) {
					d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
					d.SEARCH = SEARCH;
					d.SEARCH_BY = SEARCH_BY;
				},
				"type": "POST"
			},
			"columns": [{
					"data": "num"
				},
				{
					"data": "NAMA_BILLER"
				},
				{
					"data": "KODE_BILLER"
				},
				{
					"data": "KODE_CABANG"
				},
				{
					"data": "INV_UNIT_NAME"
				},
				{
					"data": "STATUSTEXT"
				},
				{
					"data": "CREATED_DATE"
				},
				{
					"data": "UPDATED_DATE"
				},
				{
					"data": "action"
				},
			],
		});
	}

	function isHTML(str) {
		var a = document.createElement('div');
		a.innerHTML = str;

		for (var c = a.childNodes, i = c.length; i--;) {
			if (c[i].nodeType == 1) return true;
		}

		return false;
	}

	function savebiller() {
		var path = '';
		path = "<?php echo ROOT . 'va/manage/savebiller'; ?>";

		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var NAME_BILLER = $("#NAME_BILLER").val();
		var KODE_BILLER = $("#KODE_BILLER").val();
		var ALAMAT = $("#ALAMAT").val();
		var KOTA = $("#KOTA").val();
		var TELEPON = $("#TELEPON").val();
		var EMAIL = $("#EMAIL").val();
		var NPWP = $("#NPWP").val();
		var UNIT = $("#UNIT").val();
		var STATUS = $("#STATUS").val();
		var KODE_CABANG = $("#KODE_CABANG").val();

		$.ajax({
			url: path, // Url to which the request is send
			type: "POST", // Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				// INV_NOTA_ID:INV_NOTA_ID,
				NAME_BILLER: NAME_BILLER,
				KODE_BILLER: KODE_BILLER,
				ALAMAT: ALAMAT,
				KOTA: KOTA,
				TELEPON: TELEPON,
				EMAIL: EMAIL,
				NPWP: NPWP,
				UNIT: UNIT,
				STATUS: STATUS,
				KODE_CABANG: KODE_CABANG
			},
			success: function(resp) {
				try {
					var result = JSON.parse(resp);
					if (result.status == "success") {

						alert('insert data sukses!');
					} else {
						console.log(result);
						alert("data gagal disimpan!");
						///$('#PejabatCheck').modal('show');
					}
				} catch (e) {
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

	function validateText(id) {
		//validate name

	}

	function editbiller($id) {
		// alert('123');
		$('[name="ROWID"]').val($id);
		var path = '';
		path = "<?php echo ROOT . 'va/manage/masterbilleredit'; ?>";
		ID = $id;

		$.post(path, {
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
			ID: ID
		}).done(function(data) {
			var data2 = JSON.parse(data);
			$('[name="NAME_BILLER1"]').val(data2.NAMA_BILLER);
			$('[name="TELEPON1"]').val(data2.TELEPON);
			$('[name="KODE_BILLER1"]').val(data2.KODE_BILLER);
			$('[name="EMAIL1"]').val(data2.EMAIL);
			$('[name="NPWP1"]').val(data2.NPWP);
			$('[name="UNIT1"]').val(data2.INV_ID_UNIT);
			$('[name="ALAMAT1"]').val(data2.ALAMAT);
			$('[name="KOTA1"]').val(data2.KOTA);
			$('[name="STATUS1"]').val(data2.STATUS);
			$('[name="KODE_CABANG1"]').val(data2.KODE_CABANG);
		});
		// alert('');
		return false;
	}


	function updatebiller() {
		var path = '';
		path = "<?php echo ROOT . 'va/manage/masterbillerupdate'; ?>";

		ID = $("#ROWID").val();
		var NAMA_BILLER = $("#NAME_BILLER1").val();
		var TELEPON = $("#TELEPON1").val();
		var KODE_BILLER = $("#KODE_BILLER1").val();
		var EMAIL = $("#EMAIL1").val();
		var NPWP = $("#NPWP1").val();
		var INV_ID_UNIT = $("#UNIT1").val();
		var ALAMAT = $("#ALAMAT1").val();
		var KOTA = $("#KOTA1").val();
		var STATUS = $("#STATUS1").val();
		var KODE_CABANG = $("#KODE_CABANG1").val();

		$.post(path, {
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
			ID: ID,
			NAMA_BILLER: NAMA_BILLER,
			TELEPON: TELEPON,
			KODE_BILLER: KODE_BILLER,
			EMAIL: EMAIL,
			NPWP: NPWP,
			UNIT: INV_ID_UNIT,
			ALAMAT: ALAMAT,
			KOTA: KOTA,
			STATUS: STATUS,
			KODE_CABANG: KODE_CABANG
		}).done(function(data) {
			// alert(INV_ENTITY_CODE);	loaddata();
			try {
				var result = JSON.parse(data);
				if (result == "success") {
					alert("data berhasil diupdate");
					loaddata();
					$("#edit_biller").modal('hide')
				} else {
					console.log(result);
					alert(result.msg);
					//$('#add_unit').modal('show');
				}
			} catch (e) {
				console.log(e);
				alert("data gagal disimpan");
			}
		});
		return false;
	}


	function isHTML(str) {
		var a = document.createElement('div');
		a.innerHTML = str;

		for (var c = a.childNodes, i = c.length; i--;) {
			if (c[i].nodeType == 1) return true;
		}

		return false;
	}

	function SetDate($date) {
		var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
			"Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
		];
		var dt1;
		var formattedDate1 = new Date($date);
		var d1 = formattedDate1.getDate();
		var m1 = monthNames[formattedDate1.getMonth()];
		var y1 = formattedDate1.getFullYear();
		dt1 = d1 + '-' + m1 + '-' + y1;

		return dt1;
	}

	function GetDate(str) {
		var arr = str.split("-");
		var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

		var month = (1 + months.indexOf(arr[1].toLowerCase())).toString();
		if (month.length == 1) month = '0' + month;
		var year = '20' + parseInt(arr[2]);
		var day = parseInt(arr[0]);
		var result = year + '-' + month + '-' + ((day < 10) ? "0" + day : day);
		return result;
	}

	function GetDateCustom(str) {
		var arr = str.split("-");
		var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

		var month = (1 + months.indexOf(arr[1].toLowerCase())).toString();
		if (month.length == 1) month = '0' + month;
		var year = '20' + parseInt(arr[2]);
		var result = month + '/' + parseInt(arr[0]) + '/' + year;
		return result;
	}
</script>

<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('form-horizontal');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>
