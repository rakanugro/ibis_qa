<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Administrasi</li>
			<li class="active"><span>Master Wilayah</span></li>
		</ol>

		<h1>MASTER Wilayah</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal">
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Kode Wilayah</label>
											<div class="row">
												<div class="col-xs-5">
						                  			<input type="text" name="INV_WILAYAH_CODE" id="INV_WILAYAH_CODE" class="form-control" placeholder="Kode Wilayah">
						                		</div>
					                		</div>
					             		</div>
				             		</div>

				             		<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Nama Wilayah</label>
											<div class="row">
												<div class="col-xs-5">
						                  			<input type="text" name="INV_WILAYAH_NAME" id="INV_WILAYAH_NAME" class="form-control" placeholder="Nama Wilayah">
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
								              <button type="Clear" class="btn btn-primary btn-lg" data-toggle="" data-target=""> Clear</button>
								              <button type="button" class="btn btn-primary btn-lg" data-toggle="" data-target=""><i class="fa fa-search"></i> Search</button>
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
			    <button class="btn-btn plus" data-toggle="modal" data-target="#add_wilayah"><i class="fa fa-plus"></i></button>
			</div>
		</div>
	</div>
</div>
<!-- <button type="Clear" class="btn btn-lg" data-toggle="modal" data-target="#add_wilayah" style="float: right;"><i class="fa fa-plus-square"></i></button> -->
<div class="row">
	<div class="clo-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table id="table-example" class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Wilayah</th>
								<th>Nama Wilayah</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							 $no=1;
							 foreach($prods as $mstWilayah) { ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $mstWilayah->INV_WILAYAH_CODE;?></td>
								<td><?php echo $mstWilayah->INV_WILAYAH_NAME;?></td>
								<td>Aktif</td>
								<td>
									<button type="Clear" data-toggle="" data-target=""><i class="fa fa-pencil"></i></button>
									<button type="Clear" data-toggle="modal" data-target="ModalHapus" onclick="hapustampil(<?php echo $masterWilayah->INV_WILAYAH_CODE;?>)"><i class="fa fa-trash-o"></i></button>
								</td>

							</tr>
						</tbody>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
 <div class="modal fade" id="add_wilayah" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div style="background-color:#B22222;" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:white"; class="modal-title">Wilayah</h4>
        </div>
        <form action="" id="form">
	     	<div class="modal-body">
	     		<!-- <div class="form-group"> -->
	        	<label for="" class="col-sm-3 control-label">Kode Wilayah</label>
				<div class="row">
					<div class="col-xs-5">
						<input type="text" name="INV_WILAYAH_CODE" id="INV_WILAYAH_CODE" class="form-control" placeholder="Kode Wilayah">
					</div>
	          	</div>
	          	<!-- </div> -->
	     	</div>

	     	<div class="modal-body">
	        	<label for="" class="col-sm-3 control-label">Nama Wilayah</label>
				<div class="row">
					<div class="col-xs-5">
						<input type="text" name="INV_WILAYAH_NAME" id="INV_WILAYAH_NAME" class="form-control" placeholder="Nama Wilayah">
					</div>
	          	</div>
	     	</div>

	     	<div class="modal-body">
	        	<label for="" class="col-sm-3 control-label">Wilayah Cabang</label>
				<div class="row">
					<div class="col-xs-5">
						<input type="text" name="INV_WILAYAH_CABANG" id="INV_WILAYAH_CABANG" class="form-control" placeholder="Cabang Wilayah">
					</div>
	          	</div>
	     	</div>

	     	<div class="modal-body">
	        	<label for="" class="col-sm-3 control-label">Alamat Wilayah</label>
				<div class="row">
					<div class="col-xs-5">
						<input type="text" name="INV_WILAYAH_ALAMAT" id="INV_WILAYAH_ALAMAT" class="form-control" placeholder="Alamat Wilayah">
					</div>
	          	</div>
	     	</div>
	        <div class="modal-body">
				<label for="" class="col-sm-3 control-label">Status</label>
				<div class="row">
					<div class="col-xs-5">
						<select class="form-control select2" style="width: 100%;">
							<option>Aktif</option>
							<option>Tidak Aktif</option>
						</select>
					</div>
				</div>
	        </div>

	        <div class="modal-footer">
	           <button type="button"  id="submit" name="submit" onclick="savewilayah()" class="btn btn-default" data-dismiss="modal">Save</button>
	        </div>
        </form>
      </div>
    </div>
  </div>

 <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Hapus Data Unit</h4>
            </div>
            <form class="form-horizontal">
            <div class="modal-body">
                <input type="hidden" name="kode" id="textkode" value="">
                <div class="alert alert-warning"><p>Apakah Anda yakin akan menghapus data ini ?</p></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button class="btn_hapus btn btn-danger" id="btn_hapus" onclick="hapuswilayah()">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
	function savewilayah(){
		//alert('123'); die;
		var path = '';
		path = "<?php echo base_url('ibis_qa/index.php/einvoice/administrasi/masterwilayahsave');?>";

		var INV_WILAYAH_ID 	   = $("#INV_WILAYAH_CODE").val();
		var INV_WILAYAH_CODE   = $("#INV_WILAYAH_CODE").val();
		var INV_WILAYAH_NAME   = $("#INV_WILAYAH_NAME").val();
		var INV_WILAYAH_CABANG = $("#INV_WILAYAH_CABANG").val();
		var INV_WILAYAH_ALAMAT = $("#INV_WILAYAH_ALAMAT").val();


		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		INV_WILAYAH_ID:INV_WILAYAH_ID,
		INV_WILAYAH_CODE:INV_WILAYAH_CODE,
		INV_WILAYAH_NAME:INV_WILAYAH_NAME,
		INV_WILAYAH_CABANG:INV_WILAYAH_CABANG,
		INV_WILAYAH_ALAMAT:INV_WILAYAH_ALAMAT
		}).done(function( data ) {
        });

        return false;
	}

	function hapustampil($id){
		$('#ModalHapus').modal('show');
		$('[name="kode"]').val($id);
	}

	function hapuswilayah(){
		var path ='';
		path = "<?php echo base_url('ibis_qa/index.php/einvoice/administrasi/masterwilayahhapus');?>";

		var INV_WILAYAH_ID 	= $('[name="kode"]').val();

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
		,INV_WILAYAH_ID:INV_WILAYAH_ID
		}).done(function( data ) {
        });

        return false;
// 		var path ='';

// 		path = "<?php //echo base_url('ibis_qa/index.php/einvoice/administrasi/masterwilayahhapus');?>";
// // var INV_UNIT_ID 	= $('[name="org"]').val();
// 		var INV_WILAYAH_ID = $('[name="code_id"]').val();
// 		$.post(path, {'<?php //echo $this->security->get_csrf_token_name();?>' : '<?php //echo $this->security->get_csrf_hash();?>'
// 			,INV_WILAYAH_ID:INV_WILAYAH_ID
// 		}).done(function( data ){
// 		});
// 		return false;
	}
</script>


<script type="text/javascript">
    //Date picker
    $('#tglwilayaha').datepicker({
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
	$(document).ready(function() {
		var table = $('#table-example').dataTable({
			'info': false,
			"lengthChange": false,
			'sDom': 'lTr<"clearfix">tip',
			'oTableTools': {
	            'aButtons': [
	                {
	                    'sExtends':    'collection',
	                    'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
	                    'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
	                }
	            ]
	        }
		});
	});
</script>
