<div class="container text-right">
	<div class="box-body">
		<div class="form-group">
			<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_unit"><i class="fa fa-plus"></i> Create Bank</button>
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
									<th>Bank Name</th>
									<th>Bank Code</th>
									<th>Status</th>
									<th>Create Date</th>
									<th>Update Date</th>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" ; class="modal-title">Add Master Bank</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="box-body">
						<div class="main-box-body clearfix">

							<form class="form-horizontal">
								<div class="col-md-12">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Bank Code</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" onkeypress="return Angkasaja(event)" name="KODE_BANK" id="KODE_BANK" class="form-control" placeholder="Bank Code">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Bank Name</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="NAMA_BANK" id="NAMA_BANK" class="form-control" placeholder="Bank Name">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Status</label><br>
											<div class="row">
												<div class="col-sm-8">
												  <select class="form-control" id="STATUS_BANK">
															<option value="0">Aktif</option>
															<option value="1">Tidak Aktif</option>
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


<div id="edit_bank" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" ; class="modal-title">Edit Master Bank</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="box-body">
						<div class="main-box-body clearfix">

							<form class="form-horizontal">
								<div class="col-md-12">
									<div class="box-body">
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Bank Code</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="KODE_BANK1" onkeyup="this.value=this.value.replace(/[^\d]/,'')" onkeypress="return Angkasaja(event)" id="KODE_BANK1" class="form-control" placeholder="Bank Code">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Bank Name</label>
											<div class="row">
												<div class="col-sm-8">
													<input type="text" name="NAMA_BANK1" id="NAMA_BANK1" class="form-control" placeholder="Nama Bank">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Status</label>
											<div class="row">
												<div class="col-sm-8">
													<select class="form-control" name="STATUS_BANK_EDIT" id="STATUS_BANK_EDIT">
															<option value="0">Aktif</option>
															<option value="1">Tidak Aktif</option>
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
				<h1>Are you sure?</h1>
			</div>
			<div class="modal-footer">
				<button class=" btn btn-primary" id="" data-dismiss="modal" onclick="savebiller()">Yes</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
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
				<h1>Please insert data by form</h1>
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
				<h1>Please insert data</h1>
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
				<h1>Please insert data</h1>
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
				<h1>Please insert data</h1>
			</div>
			<div class="modal-footer">
				<button class=" btn btn-primary" data-dismiss="modal" id="">Ok</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="bankupdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color: white;">Update Bank</h4>
			</div>
			<div class="modal-body">
				<!--  <input type="hidden" name="kode" id="textkode" value=""> -->
				<h1>Are You Sure?</h1>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" id="" data-dismiss="modal" onclick="updatebank()">Ok</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
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

		$("#KODE_BANK1").bind("keyup", function(e) {
			//on letter number
			if (e.which < 48 && e.which > 57) {
				alert('Kode Bank hanya boleh di isi angka');
			}
		});

		$("#KODE_BANK").bind("keyup", function(e) {
			//on letter number
			if (e.which < 48 && e.which > 57) {
				alert('Kode Bank hanya boleh di isi angka');
			}
		});

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
		$('#bankupdate').modal('show');
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
		path = "<?php echo ROOT . 'va/manage/masterbanksearch'; ?>";

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
					"data": "NAMA_BANK"
				},
				{
					"data": "KODE_BANK"
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
		path = "<?php echo ROOT . 'va/manage/save_bank'; ?>";

		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var KODE_BANK = $("#KODE_BANK").val();
		var NAMA_BANK = $("#NAMA_BANK").val();
		var STATUS = $("#STATUS_BANK").val();
		$.ajax({
			url: path, // Url to which the request is send
			type: "POST", // Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				// INV_NOTA_ID:INV_NOTA_ID,
				KODE_BANK: KODE_BANK,
				NAMA_BANK: NAMA_BANK,
				STATUS: STATUS
			},
			success: function(resp) {
				try {
					var result = JSON.parse(resp);
					if (result.status == "success") {

						alert('New Bank added!');
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

	function editbank($id) {
		// alert('123');
		$('[name="ROWID"]').val($id);
		var path = '';
		path = "<?php echo ROOT . 'va/manage/masterbankedit'; ?>";
		ID = $id;

		$.post(path, {
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
			ID: ID
		}).done(function(data) {
			var data2 = JSON.parse(data);
			// alert(data2.INV_UNIT_KAPAL);
			// alert(data2.KODE_BANK);
			$('[name="KODE_BANK1"]').val(data2.KODE_BANK);
			$('[name="NAMA_BANK1"]').val(data2.NAMA_BANK);
			$('[name="STATUS_BANK_EDIT"]').val(data2.STATUS_BANK);
			$('#edit_bank').modal('show');
		});
		// alert('');
		return false;
	}

	function updatebank() {
		var path = '';
		path = "<?php echo ROOT . 'va/manage/masterbankupdate'; ?>";

		ID = $("#ROWID").val();
		var KODE_BANK = $("#KODE_BANK1").val();
		var NAMA_BANK = $("#NAMA_BANK1").val();
		var STATUS_BANK = $("#STATUS_BANK_EDIT").val();

		$.post(path, {
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
			ID: ID,
			KODE_BANK: KODE_BANK,
			NAMA_BANK: NAMA_BANK,
			STATUS_BANK: STATUS_BANK
		}).done(function(data) {
			// alert(INV_ENTITY_CODE);	loaddata();
			try {
				var result = JSON.parse(data);
				if (result == "success") {
					alert("Update Success");
					loaddata();
					$("#edit_bank").modal('hide')


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

	function Angkasaja(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
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
