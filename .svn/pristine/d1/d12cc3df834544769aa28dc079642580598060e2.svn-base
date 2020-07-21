<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Manage</li>
			<li class="active"><span>Config Biller Bank</span></li>
		</ol>
		<h1>Config Biller Bank</h1>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="main-box clearfix">
			<div class="box box-primary" style="padding-top: 10px;">
				<div class="box-body">
					<div class="row">
						<form class="form-horizontal" id="formSearch" action="javascript:void(0);">
							<div class="col-md-12">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-md-1 control-label">Filter</label>

											<div class="col-md-3">
												<select class="form-control" id="SEARCH_BY" name="SEARCH_BY">
													<option value="Nama Config">Nama Config</option>
													<option value="Nama Bank">Nama Bank</option>
													<option value="Nama Biller">Nama Biller</option>
													<option value="Acccount">Acccount</option>
													<option value="Merchant Code">Merchant Code</option>
												</select>
											</div>
											<div class="col-md-3">
												<input type="text" name="SEARCH" id="SEARCH" class="form-control" placeholder="Search">
											</div>
											<div class="col-md-3">
												<button type="button" onclick="clearreset()" class="btn btn-primary btn-sm" data-toggle="" data-target=""> Clear</button>
												<button type="submit" onclick="loaddata()" ac class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i> Search</a>
												</button>
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
	</div>
</div>

<div class="container text-right">
	<div class="box-body">
		<div class="form-group">
			<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_unit"><i class="fa fa-plus"></i> Create Config</button>
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
									<th>Nama Config</th>
									<th>Nama Bank</th>
									<th>Nama Biller</th>
									<th>Account</th>
									<th>BIN ID</th>
									<th>Status</th>
									<th>Create Date</th>
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

<div id="add_unit" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" ; class="modal-title">Add Config Biller Bank</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="box-body">
						<div class="main-box-body clearfix">

							<form class="form-horizontal">
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Nama Biller</label>
											<div class="row">
												<div class="col-sm-8">
													<select class="form-control select2" name="ID_BILLER" id="ID_BILLER">
														<?php foreach ($biller as $biller) { ?>
															<option value="<?php echo $biller->ID; ?>"><?php echo $biller->NAMA_BILLER; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Nama Bank</label>
											<div class="row">
												<div class="col-sm-8">
													<select class="form-control select2" name="ID_BANK" id="ID_BANK">
														<?php foreach ($bank as $bank) { ?>
															<option value="<?php echo $bank->ID; ?>"><?php echo $bank->NAMA_BANK; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Nama Config</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="NAMA_CONFIG" id="NAMA_CONFIG" class="form-control" placeholder="Nama Config">
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Nomer Account</label>
										<div class="row">
											<div class="col-sm-8">
												<input type="text" name="NO_ACCOUNT" id="NO_ACCOUNT" class="form-control" placeholder="Nama Config">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Merchant CODE</label>
										<div class="row">
											<div class="col-sm-8">
												<input type="text" name="MERCHANT_CODE" id="MERCHANT_CODE" class="form-control" placeholder="Kode">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">BIN ID</label>
										<div class="row">
											<div class="col-sm-8">
												<input type="text" name="PAYMENT_CODE" id="PAYMENT_CODE" class="form-control" placeholder="Payment Code">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Status</label>
										<div class="row">
											<div class="col-sm-8">
												<select name="STATUS" name="STATUS" class="form-control status">
													<option value="0">Aktif</option>
													<option value="1">Tidak Aktif</option>
												</select>
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
<div id="update_bb" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" ; class="modal-title">Edit Config Biller Bank</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="box-body">
						<div class="main-box-body clearfix">

							<form class="form-horizontal">
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Nama Biller</label>
											<div class="row">
												<div class="col-sm-8">
													<select class="form-control select2" name="ID_BILLER" id="ID_BILLER">
														<?php foreach ($biller1 as $biller) { ?>
															<option value="<?php echo $biller->ID; ?>"><?php echo $biller->NAMA_BILLER; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Nama Bank</label>
											<div class="row">
												<div class="col-sm-8">
													<select class="form-control select2" name="ID_BANK" id="ID_BANK">
														<?php foreach ($bank1 as $bank) { ?>
															<option value="<?php echo $bank->ID; ?>"><?php echo $bank->NAMA_BANK; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Nama Config</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="NAMA_CONFIG" id="NAMA_CONFIG" class="form-control" placeholder="Nama Config">
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Nomer Account</label>
										<div class="row">
											<div class="col-sm-8">
												<input type="text" name="NO_ACCOUNT" id="NO_ACCOUNT" class="form-control" placeholder="Nama Config">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Merchant CODE</label>
										<div class="row">
											<div class="col-sm-8">
												<input type="text" name="MERCHANT_CODE" id="MERCHANT_CODE" class="form-control" placeholder="Kode">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">BIN ID</label>
										<div class="row">
											<div class="col-sm-8">
												<input type="text" name="PAYMENT_CODE" id="BIN_ID" class="form-control" placeholder="Payment Code">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label ">Status</label>

										<div class="row">
											<div class="col-sm-8">
												<select name="STATUS" id="STATUS" class="form-control status_edit1">
													<option value="0">Aktif</option>
													<option value="1">Tidak Aktif</option>
												</select>
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
				<h1>Silahkan isi semua form yang ada!</h1>
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

<div class="modal fade" id="billerbankUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color: white;">Update Bank Biller</h4>
			</div>
			<div class="modal-body">
				<!--  <input type="hidden" name="kode" id="textkode" value=""> -->
				<h1>Are you sure?</h1>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" id="" data-dismiss="modal" onclick="updatebb()">Yes</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
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
		$('#billerbankUpdate').modal('show');
		$('#update_bb').modal('hide');
		// alert('insert data sukses!');
	}

	function check_validation() {

		$('#UnitSave').modal('show');
		$('#add_unit').modal('hide');


	}

	function check_validation1() {
		var INV_PEJABAT_NAME = document.getElementById('INV_PEJABAT_NAME').value;
		var INV_PEJABAT_NIPP = document.getElementById('INV_PEJABAT_NIPP').value;
		var INV_PEJABAT_JABATAN = document.getElementById('INV_PEJABAT_JABATAN').value;
		var INV_PEJABAT_EFECTIVE = document.getElementById('INV_PEJABAT_EFECTIVE').value;
		var INV_PEJABAT_EXPIRED = document.getElementById('INV_PEJABAT_EXPIRED').value;

		if (INV_PEJABAT_NAME == "" || INV_PEJABAT_NIPP == "" || INV_PEJABAT_JABATAN == "" || INV_PEJABAT_EFECTIVE == "" || INV_PEJABAT_EXPIRED == "") {
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
		path = "<?php echo ROOT . 'va/manage/masterconfigbanksearch'; ?>";

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
					"data": "NAMA_CONFIG"
				},
				{
					"data": "NAMA_BANK"
				},
				{
					"data": "NAMA_BILLER"
				},
				{
					"data": "NO_ACCOUNT"
				},
				{
					"data": "PAYMENT_CODE"
				},
				{
					"data": "STATUS"
				},
				{
					"data": "CREATED_DATE"
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

	function editbillerbank($id) {
		// alert('123');
		$('[name="ROWID"]').val($id);
		var path = '';
		path = "<?php echo ROOT . 'va/manage/masterbillerbankedit'; ?>";
		ID = $id;

		$.post(path, {
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
			ID: ID
		}).done(function(data) {
			var data2 = JSON.parse(data);
			$('[name="ID_BANK"]').val(data2.ID_BANK);
			$('[name="ID_BILLER"]').val(data2.ID_BILLER);
			$('[name="NAMA_CONFIG"]').val(data2.NAMA_CONFIG);
			$('[name="NO_ACCOUNT"]').val(data2.NO_ACCOUNT);
			$('[name="MERCHANT_CODE"]').val(data2.MERCHANT_CODE);
			$('[name="PAYMENT_CODE"]').val(data2.PAYMENT_CODE);
			$(".status_edit1").val(data2.STATUS);
			$('#update_bb').modal('show');
		});
		// alert('');
		return false;
	}

	function savebiller() {
		var path = '';
		path = "<?php echo ROOT . 'va/manage/save_config_biller_bank'; ?>";

		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var ID_BANK = $("#ID_BANK").val();
		var ID_BILLER = $("#ID_BILLER").val();
		var NAMA_CONFIG = $("#NAMA_CONFIG").val();
		var NO_ACCOUNT = $("#NO_ACCOUNT").val();
		var MERCHANT_CODE = $("#MERCHANT_CODE").val();
		var PAYMENT_CODE = $("#PAYMENT_CODE").val();
		var STATUS = $(".status").val();

		$.ajax({
			url: path, // Url to which the request is send
			type: "POST", // Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				// INV_NOTA_ID:INV_NOTA_ID,
				ID_BANK: ID_BANK,
				ID_BILLER: ID_BILLER,
				NAMA_CONFIG: NAMA_CONFIG,
				NO_ACCOUNT: NO_ACCOUNT,
				MERCHANT_CODE: MERCHANT_CODE,
				PAYMENT_CODE: PAYMENT_CODE,
				STATUS: STATUS
			},
			success: function(resp) {
				try {
					var result = JSON.parse(resp);
					if (result.status == "success") {

						alert('New Config Bank added!');
					} else {
						console.log(result);
						alert("Data not saved");
						//$('#add_unit').modal('show');
					}
				} catch (e) {
					console.log(e);
					/*alert("data gagal disimpan");*/
				}
				loaddata();
			},
			error: function(resp) {
				alert('Bank code has already exist!');
			}
		});

		return false;
	}



	function updatebb() {
		var path = '';
		path = "<?php echo ROOT . 'va/manage/update_config_biller_bank'; ?>";

		ID = $("#ROWID").val();
		var ID_BANK = $("#ID_BANK").val();
		var ID_BILLER = $("#ID_BILLER").val();
		var NAMA_CONFIG = $("#NAMA_CONFIG").val();
		var NO_ACCOUNT = $("#NO_ACCOUNT").val();
		var MERCHANT_CODE = $("#MERCHANT_CODE").val();
		var PAYMENT_CODE = $("#BIN_ID").val();
		var STATUS = $("#STATUS").val();

		$.post(path, {
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
			ID: ID,
			ID_BANK: ID_BANK,
			ID_BILLER: ID_BILLER,
			NAMA_CONFIG: NAMA_CONFIG,
			NO_ACCOUNT: NO_ACCOUNT,
			MERCHANT_CODE: MERCHANT_CODE,
			PAYMENT_CODE: PAYMENT_CODE,
			STATUS: STATUS
		}).done(function(data) {
			// alert(INV_ENTITY_CODE);	loaddata();
			try {
				var result = JSON.parse(data);

				if (result == "success") {
					alert("Update Success");
					loaddata();
					$("#update_bb").modal('hide');


				} else {
					console.log(result);
					alert("Update Failed!");
					//$('#add_unit').modal('show');
				}
			} catch (e) {
				console.log(e);
				alert("Update Failed!");
			}
		});
		return false;
	}


	function editconfig($id) {
		$('[name="ROWID"]').val($id);
		INV_UNIT_ID = $id;
		// alert($id);
		loaddatapejabat($id);
		loaddataredaksi($id);
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
