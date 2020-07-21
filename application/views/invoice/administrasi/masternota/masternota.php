<style type="text/css">
	.sc-modal {
 	overflow-y: scroll;
 	position: relative;
 	padding: 20px;
 	height: 400px;
 }
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Administrasi</li>
			<li class="active"><span>Master Nota</span></li>
		</ol>

		<h1>MASTER NOTA</h1>
	</div>
</div>

<div class="container">
<div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal" action="#" method="post" id="formSearch">
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Layanan</label>
											<div class="row">
												<div class="col-xs-5">
													<select class="form-control select2" name="INV_NOTA_LAYANAN2" id="INV_NOTA_LAYANAN2">
														<option value="" disabled selected></option>
														<option value="PETIKEMAS">PETIKEMAS</option>
														<option value="BARANG">BARANG</option>
														<option value="RUPA-RUPA">RUPA-RUPA</option>
														<option value="KAPAL">KAPAL</option>
													</select>
						                        </div>
					                        </div>
					                    </div>
					                </div>

				             		<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Jenis Nota</label>
											<div class="row">
												<div class="col-xs-5">
						                  			<input type="text" name="INV_NOTA_JENIS2" id="INV_NOTA_JENIS2" class="form-control" placeholder="Jenis Nota">
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
         <button class="btn btn-primary" data-toggle="modal" data-target="#add_nota"><i class="fa fa-plus"></i></button>
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
								<th>Layanan</th>
								<th>Kode</th>
								<th>Jenis Nota</th>
								<th>Status</th>
								<th>Ket</th>
							</tr>
						</thead>
						<?php
							$no=1;
							 foreach($prods as $test) { ?>
						<tbody id=show_data>
						</tbody>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div id="add_nota" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Add Nota</h4>
	        </div>
	        <div class="modal-body">
			<form id="form1">
	            <div class="form-group">
                	<div class="box-body">
						<div class="main-box-body clearfix">
							<div class="tabs-wrapper">
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab-home">
										<form class="form-horizontal">
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Layanan</label>
													<div class="row">
														<div class="col-xs-3">
															<select class="form-control select2" style="width: 100%;" name="INV_NOTA_LAYANAN" id="INV_NOTA_LAYANAN">
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
													<label for="" class="col-sm-2 control-label">Kode Nota</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_NOTA_CODE" id="INV_NOTA_CODE" class="form-control" placeholder="Kode Nota">
														</div>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Jenis Nota</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_NOTA_JENIS" id="INV_NOTA_JENIS" class="form-control" placeholder="Jenis Nota">
														</div>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Status</label>
													<div class="row">
														<div class="col-xs-3">
															<select class="form-control select2" style="width: 100%;" name="INV_NOTA_STATUS" id="INV_NOTA_STATUS">
																<option value="Active">Active</option>
																<option value="Not Active">Not Active</option>

															</select>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
				 					<div class="modal-footer">
										<button  type="button"  id="submit" name="submit" onclick="check_validation()" class="btn btn-primary btn-sm" data-dismiss="modal">Save</button>
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

<div id="update_nota" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Update Nota</h4>
	        </div>
	        <div class="modal-body">
			<form id="form1" method="post">
				    <div class="form-group">
	                	<div class="box-body">
							<div class="main-box-body clearfix">
								<div class="tabs-wrapper">

									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-home">
										<table id="table-example3" class="table table-hover">
												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Layanan</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" style="width: 100%;" name="INV_NOTA_LAYANAN1" id="INV_NOTA_LAYANAN1">
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
														<label for="" class="col-sm-2 control-label">Kode Nota</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" value="" name="INV_NOTA_CODE1" id="INV_NOTA_CODE1" class="form-control" placeholder="Code Nota">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Jenis Nota</label>
														<div class="row">
															<div class="col-xs-5">
																<input type="text" value="" name="INV_NOTA_JENIS1" id="INV_NOTA_JENIS1" class="form-control" placeholder="Jenis Nota">
															</div>
														</div>
													</div>
												</div>

												<div class="box-body">
													<div class="form-group">
														<label for="" class="col-sm-2 control-label">Status</label>
														<div class="row">
															<div class="col-xs-3">
																<select class="form-control select2" style="width: 100%;" name="INV_NOTA_STATUS1" id="INV_NOTA_STATUS1">
																	<option value="Active">Active</option>
																	<option value="Not Active">Not Active</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
				    </div>
			    <div class="modal-footer">
					<button  type="button"  id="submit" name="submit" onclick="confirmation1()" class="btn btn-primary btn-sm" data-dismiss="modal">Update</button>
			        <button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
			    </div>
		   	</form>
	        </div>
	    </div>
	</div>
</div>


<div class="modal fade" id="NotaSave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Save master nota</h4>
	        </div>
            <form class="form-horizontal">
            <div class="modal-body">
                <div><h1>Apakah Anda Yakin Menyimpan Data Ini?</h1></div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" id="submit" data-dismiss="modal" onclick="savenota()">Ya</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="NotaUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Update master nota</h4>
	        </div>
            <form class="form-horizontal">
            <div class="modal-body">
                <div><h1>Apakah Anda yakin akan mengupdate data ini ?</h1></div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" id="submit" data-dismiss="modal" onclick="updatenota()">Ya</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" value="" name="ROWID" id="ROWID" class="form-control"/></input>

<div id="Nota_Blank" class="modal fade top-modal" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        	<div class="modal-body">
				<div class="tab-content">
					<h1>Silahkan isi semua form yang ada!</h1>
					<div class="modal-footer">
        				<button type="close" class="btn btn-primary" data-dismiss="modal">Ok</button>
    				</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>



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

<script type="text/javascript">
function check_validation() {
  //var kode_entity = document.forms['form_add_entity']['INV_ENTITY_CODE'];
  var kode_nota = document.getElementById('INV_NOTA_CODE').value;
  var nota_jenis = document.getElementById('INV_NOTA_JENIS').value;

  if(kode_nota == "" || nota_jenis == "") {
    //alert('gak boleh kosong cok');
    $("#Nota_Blank").modal();
  } else {
    //alert(kode_entity);
    $("#NotaSave").modal();
  }
}
</script>

<script>

// function ClearAddNew(){
// 		$('[name="INV_NOTA_LAYANAN"]').val('');
// 		$('[name="INV_NOTA_CODE"]').val('');
// 		$('[name="INV_NOTA_JENIS"]').val('');
// 		$('[name="INV_NOTA_STATUS"]').val('');
// }


$( document ).ready(function() {
		$("form").attr('action', 'javascript:void(0)');
		loaddata();
		// alert( "ready!" );
	});

	function clearreset(){
		window.location.reload(true);
	}
	function confirmation(){
		$('#NotaSave').modal('show');
		}
	function confirmation1(){
		$('#NotaUpdate').modal('show');
	}

$("#formSearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

	function loaddata(){
		// alert('1234');
		// alert(1234);
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masternotasearch';?>";
		var INV_NOTA_JENIS 		= $("#INV_NOTA_JENIS2").val();
		var INV_NOTA_LAYANAN 		= $("#INV_NOTA_LAYANAN2").val();
		var INV_NOTA_CODE 		= '';

		$('#mastertable').DataTable( {
				"destroy": true,
				"dom" : "brtlp",
				"ajax": {
					"url": path,
					data : function ( d ) {
								d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
								d.INV_NOTA_JENIS = INV_NOTA_JENIS;
								d.INV_NOTA_LAYANAN = INV_NOTA_LAYANAN;
						},
					"type": "POST"
				},
				"columns": [
										{ "data": "num" },
										{ "data": "INV_NOTA_LAYANAN" },
										{ "data": "INV_NOTA_CODE" },
										{ "data": "INV_NOTA_JENIS"},
										{ "data": "INV_NOTA_STATUS"},
										{"data": "action"},
				],} );

	}

	function savenota()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masternotasave';?>";

		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var INV_NOTA_CODE 		= $("#INV_NOTA_CODE").val();
		var INV_NOTA_LAYANAN 	= $("#INV_NOTA_LAYANAN").val();
		var INV_NOTA_JENIS		= $("#INV_NOTA_JENIS").val();
		var INV_NOTA_STATUS = $("#INV_NOTA_STATUS").val();;

		/*$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_NOTA_ID:INV_NOTA_ID,
			INV_NOTA_CODE:INV_NOTA_CODE,
			INV_NOTA_LAYANAN:INV_NOTA_LAYANAN,
			INV_NOTA_JENIS:INV_NOTA_JENIS,

			INV_NOTA_STATUS:INV_NOTA_STATUS
		}).done(function( data ) {
			//alert('insert data sukses!');
			loaddata()
        });*/

        $.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				// INV_NOTA_ID:INV_NOTA_ID,
				INV_NOTA_CODE:INV_NOTA_CODE,
				INV_NOTA_LAYANAN:INV_NOTA_LAYANAN,
				INV_NOTA_JENIS:INV_NOTA_JENIS,
				INV_NOTA_STATUS:INV_NOTA_STATUS
			},
			success: function( data )
			{
			//	alert(123);
				loaddata()
			}
		});

        return false;
	}

	function savenota()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masternotasave';?>";

		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var INV_NOTA_CODE 		= $("#INV_NOTA_CODE").val();
		var INV_NOTA_LAYANAN 	= $("#INV_NOTA_LAYANAN").val();
		var INV_NOTA_JENIS		= $("#INV_NOTA_JENIS").val();
		var INV_NOTA_STATUS = $("#INV_NOTA_STATUS").val();;

		/*$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_NOTA_ID:INV_NOTA_ID,
			INV_NOTA_CODE:INV_NOTA_CODE,
			INV_NOTA_LAYANAN:INV_NOTA_LAYANAN,
			INV_NOTA_JENIS:INV_NOTA_JENIS,

			INV_NOTA_STATUS:INV_NOTA_STATUS
		}).done(function( data ) {
			//alert('insert data sukses!');
			loaddata()
        });*/

        $.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				// INV_NOTA_ID:INV_NOTA_ID,
				INV_NOTA_CODE:INV_NOTA_CODE,
				INV_NOTA_LAYANAN:INV_NOTA_LAYANAN,
				INV_NOTA_JENIS:INV_NOTA_JENIS,
				INV_NOTA_STATUS:INV_NOTA_STATUS
			},
			success: function( data )
			{
				var result = JSON.parse(data);
				if(result.status == "failure") {
					alert('data gagal disimpan');
				}
				loaddata()
			}
		});

        return false;
	}
	function updatenota()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masternotaupdate';?>";

		//alert($("#ROWID").val());
		//var INV_NOTA_ID 	= $("#INV_NOTA_CODE1").val();
		var INV_NOTA_ID = $("#ROWID").val();
		var INV_NOTA_CODE 	= $("#INV_NOTA_CODE1").val();
		var INV_NOTA_LAYANAN = $("#INV_NOTA_LAYANAN1").val();
		var INV_NOTA_JENIS 	= $("#INV_NOTA_JENIS1").val();
		var INV_NOTA_STATUS = $("#INV_NOTA_STATUS1").val();

		/*$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		// INV_NOTA_ID:INV_NOTA_ID,
		INV_NOTA_CODE:INV_NOTA_CODE,
		INV_NOTA_LAYANAN:INV_NOTA_LAYANAN,
		INV_NOTA_JENIS:INV_NOTA_JENIS,
		INV_NOTA_STATUS:INV_NOTA_STATUS
		}).done(function( data ) {
			alert('update data sukses!');
			loaddata()
        });*/

        $.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				INV_NOTA_ID:INV_NOTA_ID,
				INV_NOTA_CODE:INV_NOTA_CODE,
				INV_NOTA_LAYANAN:INV_NOTA_LAYANAN,
				INV_NOTA_JENIS:INV_NOTA_JENIS,
				INV_NOTA_STATUS:INV_NOTA_STATUS
			},
			success: function( data )
			{
				var result = JSON.parse(data);
				//alert(result.status);
				if(result.status == "failure") {
					alert('gagal menyimpan data');
				}
				loaddata()
			}
		});

        return false;
	}

	function editnota($id)
	{
			// alert($id);die;
			$('[name="ROWID"]').val($id);
			//alert($("#ROWID").val());

			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masternotaedit';?>";
			var INV_NOTA_ID 	= $id;
			var INV_NOTA_JENIS 	= '';

			/*$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_NOTA_CODE:INV_NOTA_CODE
			,INV_NOTA_JENIS:INV_NOTA_JENIS
			}).done(function( data ) {
				var data1 = JSON.parse(data);

			for(i=0; i<Object.keys(data1).length; i++){
				$('[name="INV_NOTA_CODE1"]').val(data1[i].INV_NOTA_CODE);
				$('[name="INV_NOTA_LAYANAN1"]').val(data1[i].INV_NOTA_LAYANAN);
				$('[name="INV_NOTA_JENIS1"]').val(data1[i].INV_NOTA_JENIS);
				$('[name="INV_NOTA_STATUS1"]').val(data1[i].INV_NOTA_STATUS);
				$('#update_nota').modal('show');
			}
			});*/

		$.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				,INV_NOTA_ID:INV_NOTA_ID
				,INV_NOTA_JENIS:INV_NOTA_JENIS
			},
			success: function(data)
			{
				var data1 = JSON.parse(data);
				for(i=0; i<Object.keys(data1).length; i++){
					$('[name="INV_NOTA_CODE1"]').val(data1[i].INV_NOTA_CODE);
					$('[name="INV_NOTA_LAYANAN1"]').val(data1[i].INV_NOTA_LAYANAN);
					$('[name="INV_NOTA_JENIS1"]').val(data1[i].INV_NOTA_JENIS);
					$('[name="INV_NOTA_STATUS1"]').val(data1[i].INV_NOTA_STATUS);
					$('#update_nota').modal('show');
				}
			}
		});

			return false;
	}


	function hapusshow($id)
	{
            // var id=$(this).attr('data');
            $('#ModalHapus').modal('show');
            $('[name="kode"]').val($id);
	}

	function hapusnota()
	{
		// alert('123'); die;
		var path = '';
		path = "<?php echo base_url('ibis_qa/index.php/einvoice/administrasi/masternotahapus');?>";

		var INV_NOTA_ID 	= $('[name="kode"]').val();

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
		,INV_NOTA_ID:INV_NOTA_ID
		}).done(function( data ) {
        });

        return false;
	}



</script>
