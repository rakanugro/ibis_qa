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
			<li class="active"><span>Master eMaterai</span></li>
		</ol>

		<h1>MASTER eMATERAI</h1>
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
									
									<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Company</label>
													<div class="row">
														<div class="col-xs-5">
															<select class="form-control select2"  name="INV_ENTITY_ID2" id="INV_ENTITY_ID2" style="width: 100%;">
																<option value="">All</option>
																<?php foreach($entity as $entityid) { ?>																
																	<option value="<?php echo $entityid->INV_ENTITY_ID;?>"><?php echo $entityid->INV_ENTITY_NAME;?></option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<!--	
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Branch</label>
													<div class="row">
														<div class="col-xs-5">
														<select class="form-control select2"  name="INV_UNIT_ID2" id="INV_UNIT_ID2" style="width: 100%;">
															<option value="">All</option>																														
															<?php foreach($unit as $unitid) { ?>
																<option value="<?php echo $unitid->INV_UNIT_ID;?>"><?php echo $unitid->INV_UNIT_ORGID;?> - <?php echo $unitid->INV_UNIT_NAME;?></option>
															<?php } ?>
														</select>	
														</div>
													</div>
												</div>
											</div>
											
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Invoice Type</label>
													<div class="row">
														<div class="col-xs-5">
														<select class="form-control select2"  name="INV_NOTA_ID2" id="INV_NOTA_ID2" style="width: 100%;">
															<option value="">All</option>																
															<?php foreach($nota as $notaid) { ?>
																<option value="<?php echo $notaid->INV_NOTA_ID;?>"><?php echo $notaid->INV_NOTA_CODE;?> - <?php echo $notaid->INV_NOTA_JENIS;?></option>
															<?php } ?>
														</select>
														</div>
													</div>
												</div>
											</div>
											-->
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
         <button class="btn btn-primary" data-toggle="modal" data-target="#add_materai"><i class="fa fa-plus"></i></button>
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
								<th>NO</th>
								<th>COMPANY</th>
								<th>MATERAI AMOUNT</th>
								<th>MIN. TRX AMOUNT</th>
								<th>EMATERAI NUMBER</th>
								<th>EMATERAI REDAKSI</th>
								<th>EFFECTIVE START DATE</th>
								<th>EFFECTIVE END DATE</th>
								<th>KET</th>
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

<div id="add_materai" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Add eMaterai</h4>
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
													<label for="" class="col-sm-2 control-label">Company</label>
													<div class="row">
														<div class="col-xs-5">
															<select class="form-control select2"  name="INV_ENTITY_ID" id="INV_ENTITY_ID" style="width: 100%;">
																<?php foreach($entity as $entityid) { ?>
																	<option value="<?php echo $entityid->INV_ENTITY_ID;?>"><?php echo $entityid->INV_ENTITY_NAME;?></option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<!--
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Branch</label>
													<div class="row">
														<div class="col-xs-5">
														<select class="form-control select2"  name="INV_UNIT_ID" id="INV_UNIT_ID" style="width: 100%;">
															<?php foreach($unit as $unitid) { ?>
																<option value="<?php echo $unitid->INV_UNIT_ID;?>"><?php echo $unitid->INV_UNIT_ORGID;?> - <?php echo $unitid->INV_UNIT_NAME;?></option>
															<?php } ?>
														</select>	
														</div>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Invoice Type</label>
													<div class="row">
														<div class="col-xs-5">
														<select class="form-control select2"  name="INV_NOTA_ID" id="INV_NOTA_ID" style="width: 100%;">
															<?php foreach($nota as $notaid) { ?>
																<option value="<?php echo $notaid->INV_NOTA_ID;?>"><?php echo $notaid->INV_NOTA_CODE;?> - <?php echo $notaid->INV_NOTA_JENIS;?></option>
															<?php } ?>
														</select>
														</div>
													</div>
												</div>
											</div>
											-->
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Minimal Total Pembayaran</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_EMATERAI_MIN_AMOUNT" id="INV_EMATERAI_MIN_AMOUNT" class="form-control" placeholder="Minimum Transaction"/>
														</div>
													</div>
												</div>
											</div>
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Nominal E-Materai</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_EMATERAI_NOMINAL" id="INV_EMATERAI_NOMINAL" class="form-control" placeholder="3000 Atau 6000"/>
														</div>
													</div>
												</div>
											</div>											
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Nomor Ijin E-Materai</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_EMATERAI_NUMBER" id="INV_EMATERAI_NUMBER" class="form-control" placeholder="E-Materai Number"/>
														</div>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">E-Materai Redaksi</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_EMATERAI_REDAKSI" id="INV_EMATERAI_REDAKSI" class="form-control" placeholder="E-Materai Redaksi"/>
														</div>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Effective Start Date</label>
													<div class="row">
														<div class="col-xs-4">
															<input type="date" class="form-control" name="INV_EFF_START_DATE" id="INV_EFF_START_DATE" placeholder="Effective" required/>
														</div>
													</div>
												</div>
											</div>
										
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Effective End Date</label>
													<div class="row">
														<div class="col-xs-4">
															<input type="date" class="form-control" name="INV_EFF_END_DATE" id="INV_EFF_END_DATE" placeholder="Effective" required/>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
				 					<div class="modal-footer">
										<button type="button"  id="submit" name="submit" onclick="check_validation()" class="btn btn-primary btn-sm" data-dismiss="modal">Save</button>
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

<div id="update_materai" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Update eMaterai</h4>
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
													<label for="" class="col-sm-2 control-label">Company</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" value="" name="INV_ENTITY_ID1" id="INV_ENTITY_ID1" class="form-control" disabled>
														</div>
													</div>
												</div>
											</div>
											<!--
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Branch</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" value="" name="INV_UNIT_ID1" id="INV_UNIT_ID1" class="form-control" disabled>	
														</div>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Invoice Type</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" value="" name="INV_NOTA_ID1" id="INV_NOTA_ID1" class="form-control" disabled>																
														</div>
													</div>
												</div>
											</div>
											-->
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Minimal Total Pembayaran</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_EMATERAI_MIN_AMOUNT1" id="INV_EMATERAI_MIN_AMOUNT1" class="form-control" disabled>
														</div>
													</div>
												</div>
											</div>
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Nominal E-Materai</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_EMATERAI_NOMINAL1" id="INV_EMATERAI_NOMINAL1" class="form-control" disabled>
														</div>
													</div>
												</div>
											</div>											
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Nomor Ijin E-Materai</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_EMATERAI_NUMBER1" id="INV_EMATERAI_NUMBER" class="form-control" disabled>
														</div>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">E-Materai Redaksi</label>
													<div class="row">
														<div class="col-xs-5">
															<input type="text" name="INV_EMATERAI_REDAKSI1" id="INV_EMATERAI_REDAKSI" class="form-control" disabled>
														</div>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Effective Start Date</label>
													<div class="row">
														<div class="col-xs-4">
															<input type="date" class="form-control" name="INV_EMATERAI_EFECTIVE1" id="INV_EMATERAI_EFECTIVE1">
														</div>
													</div>
												</div>
											</div>
										
											<div class="box-body">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Effective End Date</label>
													<div class="row">
														<div class="col-xs-4">
															<input type="date" class="form-control" name="INV_EMATERAI_END1" id="INV_EMATERAI_END1">
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


<div class="modal fade" id="MateraiSave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Konfirmasi Penyimpanan Master Materai</h4>
	        </div>
            <form class="form-horizontal">
            <div class="modal-body">
                <div><h1>Apakah Anda Yakin Menyimpan Data Materai Ini?</h1></div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" id="submit" data-dismiss="modal" onclick="savematerai()">Ya</button>
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
		        <h4 style="color:white"; class="modal-title">Konfirmasi Update eMaterai</h4>
	        </div>
            <form class="form-horizontal">
            <div class="modal-body">
                <div><h1>Apakah Anda yakin akan mengupdate data ini ?</h1></div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" id="submit" data-dismiss="modal" onclick="updatematerai()">Ya</button>
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
  var inv_entity_id = document.getElementById('INV_ENTITY_ID').value;
  var inv_unit_id = document.getElementById('INV_EMATERAI_MIN_AMOUNT').value;
  var inv_unit_id = document.getElementById('INV_EMATERAI_NOMINAL').value;
  //var inv_unit_id = document.getElementById('INV_UNIT_ID').value;
  //var inv_nota_id = document.getElementById('INV_NOTA_ID').value;
  var inv_ematerai_number = document.getElementById('INV_EMATERAI_NUMBER').value;
  var inv_ematerai_redaksi = document.getElementById('INV_EMATERAI_REDAKSI').value;
  var inv_eff_start_date = document.getElementById('INV_EFF_START_DATE').value;
  var inv_eff_end_date = document.getElementById('INV_EFF_END_DATE').value;

//   console.log('=====');
//   console.log(inv_entity_code);
//   console.log(inv_unit_code);
//   console.log(inv_nota_code);
//   console.log(inv_ematerai_number);
//   console.log(inv_ematerai_redaksi);
//   console.log(inv_eff_start_date);
//   console.log(inv_eff_end_date);
  
  if(inv_ematerai_number == "" || inv_ematerai_redaksi == "" || inv_eff_start_date == "" || inv_eff_end_date == "" ) {
	$("#Nota_Blank").modal();
  } else {
    $("#MateraiSave").modal();
  }
}
</script>

<script>

$( document ).ready(function() {
		$("form").attr('action', 'javascript:void(0)');
		loaddata();
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
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/searchmastermaterai';?>";
		var INV_ENTITY_ID 		= $("#INV_ENTITY_ID2").val();
		var INV_UNIT_ID 		= $("#INV_UNIT_ID2").val();
		var INV_NOTA_ID 		= $("#INV_NOTA_ID2").val();
		var INV_EMATERAI_ID		= '';

		$('#mastertable').DataTable( {
				"destroy": true,
				"dom" : "brtlp",
				"ajax": {
					"url": path,
					data : function ( d ) {
								d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
								d.INV_ENTITY_ID = INV_ENTITY_ID;
								d.INV_UNIT_ID = INV_UNIT_ID;
								d.INV_NOTA_ID = INV_NOTA_ID;
						},
					"type": "POST"
				},
				"columns": [
								{ "data": "num" },
								{ "data": "INV_ENTITY_NAME" },
								{ "data": "INV_EMATERAI_NOMINAL" },
								{ "data": "INV_EMATERAI_MIN_AMOUNT" },
								{ "data": "INV_EMATERAI_NUMBER" },
								{ "data": "INV_EMATERAI_REDAKSI" },
								{ "data": "INV_EMATERAI_EFECTIVE" },
								{ "data": "INV_EMATERAI_END" },
								{ "data": "action"},
				],} );

	}

	function savematerai()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/savemastermaterai';?>";

		var INV_ENTITY_ID 				= $("#INV_ENTITY_ID").val();
		var INV_EMATERAI_MIN_AMOUNT 	= $("#INV_EMATERAI_MIN_AMOUNT").val();
		var INV_EMATERAI_NOMINAL 		= $("#INV_EMATERAI_NOMINAL").val();
		//var INV_UNIT_ID 		= $("#INV_UNIT_ID").val();
		//var INV_NOTA_ID			= $("#INV_NOTA_ID").val();
		var INV_EMATERAI_NUMBER 		= $("#INV_EMATERAI_NUMBER").val();
		var INV_EMATERAI_REDAKSI		= $("#INV_EMATERAI_REDAKSI").val();
		var INV_EFF_START_DATE2			= $("#INV_EFF_START_DATE").val();
		var INV_EFF_END_DATE2			= $("#INV_EFF_END_DATE").val();

		INV_EFF_START_DATE	= SetDate(INV_EFF_START_DATE2);
		INV_EFF_END_DATE	= SetDate(INV_EFF_END_DATE2);
		
	    $.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			// dataType : "JSON",
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				
				INV_ENTITY_ID:INV_ENTITY_ID,
//				INV_UNIT_ID:INV_UNIT_ID,
//				INV_NOTA_ID:INV_NOTA_ID,
				INV_EMATERAI_NUMBER:INV_EMATERAI_NUMBER,
				INV_EMATERAI_REDAKSI:INV_EMATERAI_REDAKSI,
				INV_EFF_START_DATE:INV_EFF_START_DATE,
				INV_EFF_END_DATE:INV_EFF_END_DATE,
				INV_EMATERAI_MIN_AMOUNT:INV_EMATERAI_MIN_AMOUNT,
				INV_EMATERAI_NOMINAL:INV_EMATERAI_NOMINAL

			},
			success: function(data)
			{
				var result = JSON.parse(data);

				if(result.status == "failure") {
					alert('data gagal disimpan');
				}
				$('#INV_EMATERAI_NUMBER').val("");
				$('#INV_EMATERAI_REDAKSI').val("");
				$('#INV_EFF_START_DATE').val("");
				$('#INV_EFF_END_DATE').val("");
				loaddata()
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

	function updatematerai()
	{
		var path = '';
		path = "<?php echo ROOT.'einvoice/administrasi/updatemastermaterai';?>";

		var INV_EMATERAI_ID		= $("#ROWID").val();
		var INV_EMATERAI_EFECTIVE1	= $("#INV_EMATERAI_EFECTIVE1").val();
		var INV_EMATERAI_END1	= $("#INV_EMATERAI_END1").val();

		INV_EMATERAI_EFECTIVE	= SetDate(INV_EMATERAI_EFECTIVE1);
		INV_EMATERAI_END	= SetDate(INV_EMATERAI_END1);

        $.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				INV_EMATERAI_ID:INV_EMATERAI_ID,
				INV_EMATERAI_EFECTIVE:INV_EMATERAI_EFECTIVE,
				INV_EMATERAI_END:INV_EMATERAI_END
			},
			success: function( data )
			{
				var result = JSON.parse(data);
				if(result.status == "failure") {
					alert('gagal menyimpan data');
				}
				loaddata()
			}
		});
		
        return false;
	}

	function editmaterai($id)
	{
			$('[name="ROWID"]').val($id);

			var path = '';
			path = "<?php echo ROOT.'einvoice/administrasi/editmastermaterai';?>";
			var INV_EMATERAI_ID 	= $id;
			var INV_EMATERAI_NUMBER 	= '';

		$.ajax({
			url: path, // Url to which the request is send
			type: "POST",// Type of request to be send, called as method
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				,INV_EMATERAI_ID:INV_EMATERAI_ID
				,INV_EMATERAI_NUMBER:INV_EMATERAI_NUMBER
			},
			success: function(data)
			{
				var data1 = JSON.parse(data);
				for(i=0; i<Object.keys(data1).length; i++){
					$('[name="INV_ENTITY_ID1"]').val(data1[i].INV_ENTITY_NAME);
					$('[name="INV_EMATERAI_NOMINAL1"]').val(data1[i].INV_EMATERAI_NOMINAL);
					$('[name="INV_EMATERAI_MIN_AMOUNT1"]').val(data1[i].INV_EMATERAI_MIN_AMOUNT);
					$('[name="INV_EMATERAI_NUMBER1"]').val(data1[i].INV_EMATERAI_NUMBER);
					$('[name="INV_EMATERAI_REDAKSI1"]').val(data1[i].INV_EMATERAI_REDAKSI);
					$('[name="INV_EMATERAI_EFECTIVE1"]').val(GetDate(data1[i].INV_EMATERAI_EFECTIVE));
					$('[name="INV_EMATERAI_END1"]').val(GetDate(data1[i].INV_EMATERAI_END));

					$('#update_materai').modal('show');
				}
			}
		});

			return false;
	}


</script>
