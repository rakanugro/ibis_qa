<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Administrasi</li>
			<li class="active"><span>Master Role</span></li>
		</ol>
		<h1>MASTER ROLE</h1>
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
											<label for="" class="col-sm-3 control-label">Access Role</label>
											<div class="row">
												<div class="col-xs-5">
						                  			<input type="text" name="INV_ROLE_NAME2" id="INV_ROLE_NAME2" class="form-control" placeholder="Access Role">
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
         <button class="btn btn-primary btn-sm" data-toggle="modal" id="modaladd" data-target="#add_role"><i class="fa fa-plus"></i></button>
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
								<th>Access Role</th>
								<th>Description</th>
								<th>Ket</th>
							</tr>
						  </thead>
						    <tbody id="show_data">
						    </tbody>
					    </table>
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
</div>


<div  id="add_role" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
    	<div style="background-color:#B22222;" class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 style="color:white"; class="modal-title">Add Access Role</h4>
        </div>

     	<div class="modal-body">
        <label for="" class="col-sm-3 control-label">Access Role</label>
			<div class="row">
				<div class="col-xs-5">
					<input type="text" name="INV_ROLE_NAME1" id="INV_ROLE_NAME1" class="form-control" placeholder="Access Role" data-error="required" required>
				</div>
          	</div>
     	</div>

     	<div class="modal-body">
        <label for="" class="col-sm-3 control-label">Access Role Description</label>
			<div class="row">
				<div class="col-xs-5">
					<input type="text" name="INV_ROLE_DESCRIPTION1" id="INV_ROLE_DESCRIPTION1" class="form-control" placeholder="Access Role Name" data-error="required" required>
				</div>
          	</div>
     	</div>
     	<div class="modal-body">
				<label for="" class="col-sm-3 control-label">Role Type</label>
					<div class="row">
						<div class="col-xs-5">
							<select name="INV_ROLE_TYPE1" id="INV_ROLE_TYPE1" class="form-control select2 select_role" style="width: 100%;">
								<option selected="selected" value="Super Admin">Super Admin</option>
								<option value="Admin Entity">Admin Entity</option>
								<option value="Admin Unit">Admin Unit</option>
								<option value="Customer Service">Customer Service</option>
								<option value="User">User</option>
								<option value="Super Admin VA">Super Admin VA</option>
								<option value="Admin VA">Admin VA</option>
								<option value="Keuangan VA">Keuangan VA</option>
								<option value="Billing VA">Billing VA</option>
								<option value="Customer/Self Service">Public/Self Services</option>
							</select>
						</div>
					</div>
		</div>

		<div class="modal-body div-entity" style="display: none">
				<label for="" class="col-sm-3 control-label">Entity</label>
					<div class="row">
						<div class="col-xs-5">
							<select name="INV_ENTITY_CODE1" id="INV_ENTITY_CODE1" class="form-control select2 select_entity" style="width: 100%;">
							<option value="0">-PILIH ENTITY-</option>
							<?php foreach($entitys as $entity) { ?>
								<option value="<?php echo $entity->INV_ENTITY_CODE;?>"><?php echo $entity->INV_ENTITY_NAME;?></option>
							<?php } ?>
							</select>
						</div>
						<div class="help-block"></div>
					</div>
		</div>

		<div class="modal-body div-unit" style="display: none">
			<label for="" class="col-sm-3 control-label">Unit</label>
			<div class="row">
				<div class="col-xs-5">
					<select name="INV_UNIT_CODE1" id="INV_UNIT_CODE1" class="form-control select2 select_unit" style="width: 100%;">
						<option value="0">-PILIH UNIT-</option>
					<?php foreach($unit1 as $unitid) { ?>
						<option value="<?php echo $unitid->INV_UNIT_CODE;?>"><?php echo $unitid->INV_UNIT_NAME;?></option>
					<?php } ?>
					</select>
				</div>
			</div>
		</div>
     	<div class="table-responsive layanan-div" style="display: none;">
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
					<div id="jen_check">
						<div class="row">
							<input type="checkbox" id="INV_ROLE_KAPAL1" name="INV_ROLE_KAPAL1" checked value="1">
							<label for="subscribeNews"  >Kapal</label>
							<input type="checkbox" id="INV_ROLE_PETIKEMAS1" name="INV_ROLE_PETIKEMAS1" checked value="1">
							<label for="subscribeNews" >Petikemas</label>
							<input type="checkbox" id="INV_ROLE_BARANG1" name="INV_ROLE_BARANG1" checked value="1">
							<label for="subscribeNews" >Barang</label>
							<input type="checkbox" id="INV_ROLE_RUPARUPA1" name="INV_ROLE_RUPARUPA1" checked value="1">
							<label for="subscribeNews" >Rupa Rupa</label>
						</div>
					</div>
			</div>
		</div>

		<div class="modal-footer">
			<button  type="button"  id="submit" name="submit" onclick="check_validation()"  class="btn btn-primary" data-dismiss="modal">Save</button>
			<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
		</div>


       	<!-- <div class="modal-body">
			<button type="submit" namae="submit" id="submit" onclick="saverole1()" class="btn btn-default" data-dismiss="modal" >Save</a></button>
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
        </div> -->
    </div>
    </div>
  	</div>



<div  id="update_role" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div style="background-color:#B22222;" class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 style="color:white"; class="modal-title">Update Access Role</h4>
        </div>

     	<div class="modal-body">
        <label for="" class="col-sm-3 control-label">Access Role</label>
			<div class="row">
				<div class="col-xs-5">
					<input type="text" name="INV_ROLE_NAME3" id="INV_ROLE_NAME3" class="form-control" placeholder="Acces Role">
				</div>
          	</div>
     	</div>
     	<div class="modal-body">
        <label for="" class="col-sm-3 control-label">Access Role Description</label>
			<div class="row">
				<div class="col-xs-5">
					<input type="text" name="INV_ROLE_DESCRIPTION2" id="INV_ROLE_DESCRIPTION2" class="form-control" placeholder="Acces Role Name">
				</div>
          	</div>
     	</div>
     	<div class="modal-body">
				<label for="" class="col-sm-3 control-label">Role</label>
					<div class="row">
						<div class="col-xs-5">
							<select name="INV_ROLE_TYPE2" id="INV_ROLE_TYPE2"  class="form-control select2 select_role select_rolexx" style="width: 100%;">
								<option selected="selected" value="Super Admin">Super Admin</option>
								<option value="Admin Entity">Admin Entity</option>
								<option value="Admin Unit">Admin Unit</option>
								<option value="Customer Service">Customer Service</option>
								<option value="User">User</option>
							</select>
						</div>
					</div>
		</div>

		<div class="modal-body entity-div2 div-entitycc">
				<label for="" class="col-sm-3 control-label">Entity</label>
					<div class="row">
						<div class="col-xs-5">
							<select name="INV_ENTITY_CODE2" id="INV_ENTITY_CODE2" class="form-control select2 select_entity" style="width: 100%;">
								<option value="0">-PILIH ENTITY-</option>
							<?php foreach($entitys as $entity) { ?>
									<option value="<?php echo $entity->INV_ENTITY_CODE;?>"><?php echo $entity->INV_ENTITY_NAME;?></option>
							<?php } ?>
							</select>
						</div>
						<div class="help-block"></div>
					</div>
		</div>

		<div class="modal-body div-unit div-unitcc" style="display: none">
				<label for="" class="col-sm-3 control-label">Unit</label>
					<div class="row">
						<div class="col-xs-5">
							<select name="INV_UNIT_CODE2" id="INV_UNIT_CODE2" class="form-control select2 select_unit" style="width: 100%;">
							<option value="0">-PILIH UNIT-</option>
							<?php foreach($unit1 as $unitid) { ?>
								<option value="<?php echo $unitid->INV_UNIT_CODE;?>"><?php echo $unitid->INV_UNIT_NAME;?></option>
							<?php } ?>
							</select>
						</div>
					</div>
		</div>
     	<div class="table-responsive layanan-div div-layanancc" style="display: none;" >
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
					<div id="jen_check jen_checkcc">
					<div class="row">
							<input type="checkbox" id="INV_ROLE_KAPAL2" name="INV_ROLE_KAPAL2" checked>
							<label for="subscribeNews">Kapal</label>
							<input type="checkbox" id="INV_ROLE_PETIKEMAS2" name="INV_ROLE_PETIKEMAS2" checked>
							<label for="subscribeNews">Petikemas</label>
							<input type="checkbox" id="INV_ROLE_BARANG2" name="INV_ROLE_BARANG2" checked>
							<label for="subscribeNews">Barang</label>
							<input type="checkbox" id="INV_ROLE_RUPARUPA2" name="INV_ROLE_RUPARUPA2" checked>
							<label for="subscribeNews">Rupa Rupa</label>
					</div>
					</div>
			</div>
		</div>

		<div class="modal-footer">
			<button  type="button"  id="submit" name="submit" onclick="check_validation2()" class="btn btn-primary btn-sm" data-dismiss="modal">Update</button>
			<button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
		</div>

       <!-- 	<div class="modal-body">
		<button type="submit" namae="submit" id="submit" onclick="updaterole1()" class="btn btn-default" data-dismiss="modal" >Update</a></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
        </div> -->
    </div>
    </div>
  	</div>

<div id="allert_add" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Save acces role</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<button  type="button"  id="submit" name="submit" onclick="saverole()" class="btn btn-primary" data-dismiss="modal">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="blank_form" class="modal fade top-modal" role="dialog" data-backdrop="static">
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

<div id="allert_check" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Save acces role</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Silahkan isi semua form yang ada!</h1>
							<div class="modal-footer">
								<button  type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
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
		        <h4 style="color:white"; class="modal-title">Update acces role</h4>
	        </div>
	        	<div class="modal-body">
					<form id="form1">
						<div class="tab-content">
							<h1>Apakah Anda Yakin Menyimpan Data Ini?</h1>
							<div class="modal-footer">
								<button  type="button"  id="submit" name="submit" onclick="updaterole()" class="btn btn-primary" data-dismiss="modal">Ya</button>
                				<button type="close" class="btn btn-primary" data-dismiss="modal">Tidak</button>
            				</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<input type="hidden" name="ROWID" id="ROWID" class="form-control" placeholder="ROWID">


<script type="text/javascript">
function link_unit(){
	window.location.href="<?php echo ROOT;?>einvoice/administrasi/adding_unit";
}
</script>


<script type="text/javascript">
	$(document).ready(function(){

		$('#add_role').click(function(){

			// $("#INV_ROLE_DESCRIPTION1").val('');
			// ('#INV_ENTITY_CODE1').val('');
			// $('.div-unit').hide();
   //     		$('.div-entity').hide();
   //     		$('.layanan-div').hide();


		});

        $('.select_entity').change(function(){
            var id=$(this).val();

            $.ajax({
                url : "<?php echo ROOT ?>einvoice/administrasi/get_sub_entity",
                method : "POST",
                data : {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                INV_ENTITY_CODE: id},
                dataType : 'json',

                beforeSend: function() {
					$('.help-block').show();
					$('.help-block').text('Loading...');
				},
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        // html += '<option>'+data[i].INV_UNIT_CODE+'</option>';
						// 20181019 3ono, menampilkan unit name di combo box, sebelumnya hanya unit code
						html += '<option value='+data[i].INV_UNIT_CODE+'>'+data[i].INV_UNIT_NAME+'</option>';
                    }
                    $('.select_unit').html(html);
                    $('.help-block').hide();

                }
            });
        });



       $('.select_role').change(function(){

       		var role_val = $(this).val();

       		if(role_val=='Admin Unit'||role_val=='Customer Service'){
       			$('.div-entity').show();
       			$('.div-unit').show();
       			$('.layanan-div').hide();



       		}

       		if(role_val=='Super Admin'){

       			$('.div-unit').hide();
       			$('.div-entity').hide();
       			$('.layanan-div').hide();
       			$('.jen_check').hide();
       		}

       		if(role_val=='Admin Entity'){
       			$('.div-entity').show();
       			$('.div-unit').hide();
       			$('.layanan-div').hide();
       		}

       		if(role_val=='User'){
       			$('.div-entity').show();
       			$('.div-unit').show();
       			$('.layanan-div').show();

       		}


       });



    });


</script>
<script type="text/javascript">
    //Date picker
    $('#tgl_valid1').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

    $('#keluar_valid2').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

    $("#formSearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));
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

<script>

function ClearAddNew(){
		$('[name="INV_ROLE_NAME1"]').val('');
		$('[name="INV_ROLE_DESCRIPTION1"]').val('');
		$('[name="INV_ROLE_TYPE1"]').val('');
		$('[name="INV_UNIT_CODE1"]').val('');
}

	function check_validation() {
		var INV_ROLE_NAME1 			= document.getElementById('INV_ROLE_NAME1').value;
		var INV_ROLE_DESCRIPTION1 	= document.getElementById('INV_ROLE_DESCRIPTION1').value;
		var INV_ROLE_TYPE1			= document.getElementById('INV_ROLE_TYPE1').value;
		var INV_ENTITY_CODE1		= document.getElementById('INV_ENTITY_CODE1').value;
		var INV_UNIT_CODE1			= document.getElementById('INV_UNIT_CODE1').value;
		var INV_ROLE_KAPAL1			= $("input[name=INV_ROLE_KAPAL1]:checked").val();
		var INV_ROLE_PETIKEMAS1		= $("input[name=INV_ROLE_PETIKEMAS1]:checked").val();
		var INV_ROLE_BARANG1		= $("input[name=INV_ROLE_BARANG1]:checked").val();
		var INV_ROLE_RUPARUPA1		= $("input[name=INV_ROLE_RUPARUPA1]:checked").val();
		if(INV_ROLE_TYPE1 == "Super Admin"){
			if(INV_ROLE_NAME1 == "" || INV_ROLE_DESCRIPTION1 == "") {
				$('#allert_check').modal('show');
			}
			else {
				$('#allert_add').modal('show');
			}

		}else if(INV_ROLE_TYPE1 == "Admin Entity"){
			if(INV_ROLE_NAME1 == "" || INV_ROLE_DESCRIPTION1 == "" || INV_ENTITY_CODE1 == "0" ) {
				$('#allert_check').modal('show');
			}
			else {
				$('#allert_add').modal('show');
			}

		}else if(INV_ROLE_TYPE1 == "Admin Unit"||INV_ROLE_TYPE1 == "Customer Service"){
			if(INV_ROLE_NAME1 == "" || INV_ROLE_DESCRIPTION1 == "" || INV_ENTITY_CODE1 == "0" || INV_UNIT_CODE1 == "0") {
				$('#allert_check').modal('show');
			}
			else {
				$('#allert_add').modal('show');
			}

		}else if(INV_ROLE_TYPE1 == "User"){
			if(INV_ROLE_NAME1 == "" || INV_ROLE_DESCRIPTION1 == "" || INV_ENTITY_CODE1 == "0" || INV_UNIT_CODE1 == "0" || INV_ROLE_KAPAL1 != 1 && INV_ROLE_PETIKEMAS1 != 1 && INV_ROLE_BARANG1 != 1 && INV_ROLE_RUPARUPA1 != 1){
				$('#allert_check').modal('show');
			}else {
				$('#allert_add').modal('show');
			}

		}

	}

	function check_validation2() {
		var INV_ROLE_NAME1 			= document.getElementById('INV_ROLE_NAME3').value;
		var INV_ROLE_DESCRIPTION1 	= document.getElementById('INV_ROLE_DESCRIPTION2').value;
		var INV_ROLE_TYPE1			= document.getElementById('INV_ROLE_TYPE2').value;
		var INV_ENTITY_CODE1		= document.getElementById('INV_ENTITY_CODE2').value;
		var INV_UNIT_CODE1			= document.getElementById('INV_UNIT_CODE2').value;
		var INV_ROLE_KAPAL1			= $("input[name=INV_ROLE_KAPAL2]:checked").length;
		var INV_ROLE_PETIKEMAS1		= $("input[name=INV_ROLE_PETIKEMAS2]:checked").length;
		var INV_ROLE_BARANG1		= $("input[name=INV_ROLE_BARANG2]:checked").length;
		var INV_ROLE_RUPARUPA1		= $("input[name=INV_ROLE_RUPARUPA2]:checked").length;
		if(INV_ROLE_TYPE1 == "Super Admin"){
			if(INV_ROLE_NAME1 == "" || INV_ROLE_DESCRIPTION1 == "") {
				$('#allert_check').modal('show');
			}
			else {
				$('#allert_update').modal('show');
			}

		}else if(INV_ROLE_TYPE1 == "Admin Entity"){
			if(INV_ROLE_NAME1 == "" || INV_ROLE_DESCRIPTION1 == "" || INV_ENTITY_CODE1 == "0" ) {
				$('#allert_check').modal('show');
			}
			else {
				$('#allert_update').modal('show');
			}

		}else if(INV_ROLE_TYPE1 == "Admin Unit"||INV_ROLE_TYPE1 == "Customer Service"){
			if(INV_ROLE_NAME1 == "" || INV_ROLE_DESCRIPTION1 == "" || INV_ENTITY_CODE1 == "0" || INV_UNIT_CODE1 == "0") {
				$('#allert_check').modal('show');
			}
			else {
				$('#allert_update').modal('show');
			}

		}else if(INV_ROLE_TYPE1 == "User"){
			if(INV_ROLE_NAME1 == "" || INV_ROLE_DESCRIPTION1 == "" || INV_ENTITY_CODE1 == "0" || INV_UNIT_CODE1 == "0" || INV_ROLE_KAPAL1  < 1 && INV_ROLE_PETIKEMAS1  < 1 	&& INV_ROLE_BARANG1  < 1 && INV_ROLE_RUPARUPA1 < 1){
				$('#allert_check').modal('show');
			}else {
				$('#allert_update').modal('show');
			}

		}

	}

$( document ).ready(function() {
		loaddata();
		// alert( "ready!" );
	});

	function clearreset(){
		window.location.reload(true);
	}

	function loaddata(){

		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterrolesearch';?>";
		var INV_ROLE_NAME 		= $("#INV_ROLE_NAME2").val();

		// alert(INV_NOTA_CODE);
		$('#mastertable').DataTable( {
				"destroy": true,
				"dom" : "brtlp",
				"ajax": {
					"url": path,
					data : function ( d ) {
								d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
								d.INV_ROLE_NAME = INV_ROLE_NAME;
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
										{ "data": "INV_ROLE_NAME" },
										{ "data": "INV_ROLE_DESCRIPTION" },
										{"data": "action"},
				],} );
	}


	function saverole1()
	{
		$('#allert_add').modal('show');
	}
/*
	function check_validation() {

		  var accessrole = document.getElementById('INV_ROLE_NAME1').value;
		  var roledesc = document.getElementById('INV_ROLE_DESCRIPTION1').value;


		  if(accessrole == "" || roledesc == "") {
		    $("#blank_form").modal();
		  } else {
		    $("#allert_add").modal();
		  }
		}*/



	function saverole()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterrolesave';?>";

		// var INV_NOTA_ID 		= $("#INV_NOTA_CODE").val();
		var INV_ROLE_NAME 			= $("#INV_ROLE_NAME1").val();
		var INV_ROLE_DESCRIPTION 	= $("#INV_ROLE_DESCRIPTION1").val();
		var INV_ROLE_TYPE			= $("#INV_ROLE_TYPE1").val();
		var INV_ENTITY_CODE1		= $('#INV_ENTITY_CODE1').val();
		// var INV_ROLE_NOTE 			= $("#INV_ROLE_NOTE1").val();
		var INV_ROLE_KAPAL 			= '0';
		var INV_ROLE_PETIKEMAS 		= '0';
		var INV_ROLE_BARANG 		= '0';
		var INV_ROLE_RUPARUPA 		= '0';
		var INV_UNIT_CODE 			= $("#INV_UNIT_CODE1").val();

		if($("#INV_ROLE_KAPAL1").is(":checked")) INV_ROLE_KAPAL='1';
		if($("#INV_ROLE_PETIKEMAS1").is(":checked")) INV_ROLE_PETIKEMAS='1';
		if($("#INV_ROLE_BARANG1").is(":checked")) INV_ROLE_BARANG='1';
		if($("#INV_ROLE_RUPARUPA1").is(":checked")) INV_ROLE_RUPARUPA='1';

		$.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				// INV_NOTA_ID:INV_NOTA_ID,
				INV_ROLE_NAME:INV_ROLE_NAME,
				INV_ROLE_DESCRIPTION:INV_ROLE_DESCRIPTION,
				INV_ROLE_TYPE:INV_ROLE_TYPE,
				// INV_ROLE_NOTE:INV_ROLE_NOTE,
				INV_ROLE_KAPAL:INV_ROLE_KAPAL,
				INV_ROLE_PETIKEMAS:INV_ROLE_PETIKEMAS,
				INV_ROLE_BARANG:INV_ROLE_BARANG,
				INV_ROLE_RUPARUPA:INV_ROLE_RUPARUPA,
				INV_UNIT_CODE:INV_UNIT_CODE,
				INV_ENTITY_CODE : INV_ENTITY_CODE1
			},
			success: function(resp)
			{
				loaddata();
			location.reload();
			$("#INV_ROLE_NAME1").val("");
			 $("#INV_ROLE_DESCRIPTION1").val("");
			 $('#INV_ENTITY_CODE1').val("");
			 $("#INV_ROLE_TYPE1").val("Super Admin");
			 $("#INV_UNIT_CODE1").val("");
			$('.select_role').change(function(){

       		var role_val = $(this).val();

       		if(role_val=='Admin Unit'||role_val=='Customer Service'){
       			$('.div-entity').show();
       			$('.div-unit').show();
       			$('.layanan-div').hide();



       		}

       		if(role_val=='Super Admin'){

       			$('.div-unit').hide();
       			$('.div-entity').hide();
       			$('.layanan-div').hide();
       			$('.jen_check').hide();
       		}

       		if(role_val=='Admin Entity'){
       			$('.div-entity').show();
       			$('.div-unit').hide();
       			$('.layanan-div').hide();
       		}

       		if(role_val=='User'){
       			$('.div-entity').show();
       			$('.div-unit').show();
       			$('.layanan-div').show();

       		}


       });
			 $("#INV_ROLE_KAPAL1").is(":checked")='1';
			 $("#INV_ROLE_PETIKEMAS1").is(":checked")='1';
			 $("#INV_ROLE_BARANG1").is(":checked")='1';
			 $("#INV_ROLE_RUPARUPA1").is(":checked")='1';




			}
		});

        return false;

		/*$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			// INV_NOTA_ID:INV_NOTA_ID,

			INV_ROLE_NAME:INV_ROLE_NAME,
			INV_ROLE_DESCRIPTION:INV_ROLE_DESCRIPTION,
			INV_ROLE_TYPE:INV_ROLE_TYPE,
			// INV_ROLE_NOTE:INV_ROLE_NOTE,
			INV_ROLE_KAPAL:INV_ROLE_KAPAL,
			INV_ROLE_PETIKEMAS:INV_ROLE_PETIKEMAS,
			INV_ROLE_BARANG:INV_ROLE_BARANG,
			INV_ROLE_RUPARUPA:INV_ROLE_RUPARUPA,
			INV_UNIT_CODE:INV_UNIT_CODE,
			INV_ENTITY_CODE : INV_ENTITY_CODE1


		}).done(function( data ) {
			loaddata();
			location.reload();
			alert('insert data sukses!');
			$("#INV_ROLE_NAME1").val("");
			 $("#INV_ROLE_DESCRIPTION1").val("");
			 $('#INV_ENTITY_CODE1').val("");
			 $("#INV_ROLE_TYPE1").val("Super Admin");
			 $("#INV_UNIT_CODE1").val("");
			$('.select_role').change(function(){

       		var role_val = $(this).val();

       		if(role_val=='Admin Unit'){
       			$('.div-entity').show();
       			$('.div-unit').show();
       			$('.layanan-div').hide();



       		}

       		if(role_val=='Super Admin'){

       			$('.div-unit').hide();
       			$('.div-entity').hide();
       			$('.layanan-div').hide();
       			$('.jen_check').hide();
       		}

       		if(role_val=='Admin Entity'){
       			$('.div-entity').show();
       			$('.div-unit').hide();
       			$('.layanan-div').hide();
       		}

       		if(role_val=='User'){
       			$('.div-entity').show();
       			$('.div-unit').show();
       			$('.layanan-div').show();

       		}


       });
			 $("#INV_ROLE_KAPAL1").is(":checked")='1';
			 $("#INV_ROLE_PETIKEMAS1").is(":checked")='1';
			 $("#INV_ROLE_BARANG1").is(":checked")='1';
			 $("#INV_ROLE_RUPARUPA1").is(":checked")='1';





        });

        return false;*/
	}

	function editrole($id)
	{
			// alert($id);
			$('.layanan-div').show();
			$('[name="ROWID"]').val($id);

			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/masterroleedit';?>";
			var INV_ROLE_ID 	= $id;

			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_ROLE_ID:INV_ROLE_ID
			}).done(function( data ) {
				var data2 = JSON.parse(data);

		$('#INV_ROLE_KAPAL2').prop('checked', false);
		$('#INV_ROLE_RUPARUPA2').prop('checked', false);
		$('#INV_ROLE_BARANG2').prop('checked', false);
		$('#INV_ROLE_PETIKEMAS2').prop('checked', false);

				if($('#INV_ROLE_TYPE2').val() == 'Admin Entity'){
					$('.div-unit').hide();
				}








				// alert(data2.INV_UNIT_KAPAL);
				$('[name="INV_ROLE_NAME2"]').val(data2.INV_ROLE_NAME);
				$('[name="INV_ROLE_NAME3"]').val(data2.INV_ROLE_NAME);
				$('[name="INV_ROLE_DESCRIPTION2"]').val(data2.INV_ROLE_DESCRIPTION);
				$('[name="INV_ROLE_TYPE2"]').val(data2.INV_ROLE_TYPE);
				// $('[name="INV_ROLE_NOTE2"]').val(data2.INV_ROLE_NOTE);
				$('[name="INV_UNIT_CODE2"]').val(data2.INV_UNIT_CODE);
				$('[name=INV_ENTITY_CODE2]').val(data2.INV_ENTITY_CODE);

				if(data2.INV_ROLE_KAPAL==1)$("#INV_ROLE_KAPAL2").attr("checked","checked");
				if(data2.INV_ROLE_PETIKEMAS==1)$("#INV_ROLE_PETIKEMAS2").attr("checked","checked");
				if(data2.INV_ROLE_BARANG==1)$("#INV_ROLE_BARANG2").attr("checked","checked");
				if(data2.INV_ROLE_RUPARUPA==1)$("#INV_ROLE_RUPARUPA2").attr("checked","checked");

				var role_val = $('#INV_ROLE_TYPE2').val();

	       		if(role_val=='Admin Unit'||role_val=='Customer Service'){
	       			$('.div-entity').show();
	       			$('.div-unit').show();
	       			$('.layanan-div').hide();



	       		}

	       		if(role_val=='Super Admin'){

	       			$('.div-unit').hide();
	       			$('.entity-div2').hide();
	       			$('.layanan-div').hide();
	       			$('.jen_check').hide();
	       		}

	       		if(role_val=='Admin Entity'){
	       			$('.entity-div2').show();
	       			$('.div-unit').hide();
	       			$('.layanan-div').hide();
	       		}

	       		if(role_val=='User'){
	       			$('.entity-div2').show();
	       			$('.div-unit').show();
	       			$('.layanan-div').show();
	       			$('.jen_check').show();

					if(data2.INV_ROLE_KAPAL == 1){
							$('#INV_ROLE_KAPAL2').prop('checked', true);
					}if(data2.INV_ROLE_RUPARUPA == 1){
							$('#INV_ROLE_RUPARUPA2').prop('checked', true);
					}if(data2.INV_ROLE_BARANG == 1){
							$('#INV_ROLE_BARANG2').prop('checked', true);
					}if(data2.INV_ROLE_PETIKEMAS == 1){
							$('#INV_ROLE_PETIKEMAS2').prop('checked', true);
					}
						       		}

				$('#update_role').modal('show');


			});

			return false;
	}

	$("#modaladd").click(function() {
		  var role_val = $("#INV_ROLE_TYPE1").val();

       		if(role_val=='Admin Unit'||role_val=='Customer Service'){
       			$('.div-entity').show();
       			$('.div-unit').show();
       			$('.layanan-div').hide();

       		}

       		if(role_val=='Super Admin'){

       			$('.div-unit').hide();
       			$('.div-entity').hide();
       			$('.layanan-div').hide();
       			$('.jen_check').hide();
       		}

       		if(role_val=='Admin Entity'){
       			$('.div-entity').show();
       			$('.div-unit').hide();
       			$('.layanan-div').hide();
       		}

       		if(role_val=='User'){
       			$('.div-entity').show();
       			$('.div-unit').show();
       			$('.layanan-div').show();

       		}
		});


	function updaterole1()
	{
		$('#allert_update').modal('show');
	}

	function updaterole()
	{



		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/masterroleupdate';?>";

		var INV_ROLE_ID 	= $("#ROWID").val();
		var INV_ROLE_NAME 		= $("#INV_ROLE_NAME3").val();
		var INV_ROLE_DESCRIPTION 	= $("#INV_ROLE_DESCRIPTION2").val();
		var INV_ROLE_TYPE 	= $("#INV_ROLE_TYPE2").val();
		var INV_UNIT_CODE 	= $("#INV_UNIT_CODE2").val();
		var INV_ROLE_KAPAL = '0';
		var INV_ROLE_PETIKEMAS = '0';
		var INV_ROLE_BARANG = '0';
		var INV_ROLE_RUPARUPA = '0';
		var INV_ENTITY_CODE2 =  $('#INV_ENTITY_CODE2').val();

		if($("#INV_ROLE_KAPAL2").is(":checked")) INV_ROLE_KAPAL='1';
		if($("#INV_ROLE_PETIKEMAS2").is(":checked")) INV_ROLE_PETIKEMAS='1';
		if($("#INV_ROLE_BARANG2").is(":checked")) INV_ROLE_BARANG='1';
		if($("#INV_ROLE_RUPARUPA2").is(":checked")) INV_ROLE_RUPARUPA='1';

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_ROLE_ID:INV_ROLE_ID,
			INV_ROLE_NAME:INV_ROLE_NAME,
			INV_ROLE_DESCRIPTION:INV_ROLE_DESCRIPTION,
			INV_ROLE_TYPE:INV_ROLE_TYPE,
			INV_ROLE_KAPAL:INV_ROLE_KAPAL,
			INV_ROLE_PETIKEMAS:INV_ROLE_PETIKEMAS,
			INV_ROLE_BARANG:INV_ROLE_BARANG,
			INV_ROLE_RUPARUPA:INV_ROLE_RUPARUPA,
			INV_ENTITY_CODE:INV_ENTITY_CODE2,
			INV_UNIT_CODE : INV_UNIT_CODE

		}).done(function( data ) {
			$("#INV_ROLE_NAME2").val($("#INV_ROLE_NAME3").val())
			var role_val = $('#INV_ROLE_TYPE2').val();

	       		if(role_val=='Admin Unit'||role_val=='Customer Service'){
	       			$('.div-entity').show();
	       			$('.div-unit').show();
	       			$('.layanan-div').hide();



	       		}

	       		if(role_val=='Super Admin'){

	       			$('.div-unit').hide();
	       			$('.div-entity').hide();
	       			$('.layanan-div').hide();
	       			$('.jen_check').hide();
	       		}

	       		if(role_val=='Admin Entity'){
	       			$('.div-entity').show();
	       			$('.div-unit').hide();
	       			$('.layanan-div').hide();
	       		}

	       		if(role_val=='User'){
	       			$('.div-entity').show();
	       			$('.div-unit').show();
	       			$('.layanan-div').show();
	       			$('.jen_check').show();


	       		}
			loaddata();

        });

        return false;
	}

       $('.select_rolexx').change(function(){

       		var role_val = $(this).val();

       		if(role_val=='Admin Unit'||role_val=='Customer Service'){
       			$('.div-entitycc').show();
       			$('.div-unitcc').show();
       			$('.div-layanancc').hide();
       			$('#jen_checkcc').hide();



       		}

       		if(role_val=='Super Admin'){

       			$('.div-unitcc').hide();
       			$('.div-entitycc').hide();
       			$('.div-layanancc').hide();
       			$('#jen_checkcc').hide();
       		}

       		if(role_val=='Admin Entity'){
       			$('.div-entitycc').show();
       			$('.div-unitcc').hide();
       			$('.div-layanancc').hide();
       			$('#jen_checkcc').hide();
       		}

       		if(role_val=='User'){
       			$('.div-entitycc').show();
       			$('.div-unitcc').show();
       			$('.div-layanancc').show();
       			$('#jen_checkcc').show();

       		}


       });

</script>
