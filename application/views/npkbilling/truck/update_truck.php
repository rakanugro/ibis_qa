<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>

<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
<script src="<?=CUBE_?>js/hogan.js"></script>
<script src="<?=CUBE_?>js/typeahead.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>
<link rel="stylesheet" href="<?=CUBE_?>css/libs/bootstrap-timepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />

<style type="text/css">
.upload_info {
    font-size: small;
    font-style: italic;
    float: right;
}
.hidden_content {
	display: none;
}
#component_type {
	float: left;
}
#component_reefer {
	float: left;
	margin-left: 10px;
}
.main-box-footer {
	text-align: center;
	margin-bottom: 30px;
}
.btn-footer{
	width: 100px;
}

.modal-header {
    border-bottom:1px solid #eee;
    background-color: #0480be;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
 }

</style>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
				</header>
				
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-12">
						<label for="datepickerDate">TID Truck</label>
						<span style="color: red">*</span>
						<input name="TRUCK_ID" id="TRUCK_ID" type="text" class="form-control" value="<?php echo $truck_id ?>" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label>Vechile Type</label>
						<span style="color: red">*</span>
						<select id="TRUCK_TYPE" name="TRUCK_TYPE" class="form-control" onchange="getnameoperation(this);">
							<option> -- Please Choose Terminal -- </option><?php 
							foreach($kendaraan as $term){ ?>
								<option value="<?=$term->type_id?>" <?php if ($term->type_name == $truck_type_name){?> selected="selected" 	
									<?php }?>><?php echo $term->type_name; ?>
								</option><?php  
							}?>
						</select>
						<input type="hidden" class="form-control" id="TRUCK_TYPE_NAME" value="<?php echo $truck_type_name ?>" name="TRUCK_TYPE_NAME">
					</div>

					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Truck Company Name</label>
						<span style="color: red">*</span>
						<input name="TRUCK_CUST_NAME" id="TRUCK_CUST_NAME" type="text" class="form-control" value="<?php echo $truck_cust_name ?>" placeholder="autocomplete" >
						<input type="hidden" class="form-control" id="TRUCK_CUST_ID" name="TRUCK_CUST_ID" value="<?php echo $truck_cust_id ?>" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="exampleTooltip">Plat Nomor</label>
						<span style="color: red">*</span>
						<input name="TRUCK_PLAT_NO" id="TRUCK_PLAT_NO" type="text" value="<?php echo $truck_plat_no ?>" class="form-control" placeholder="Plat Nomor" readonly>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Expired Date</label>
						<span style="color: red">*</span>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="TRUCK_PLAT_EXP" name="TRUCK_PLAT_EXP" type="text" value="<?php echo $truck_plat_exp; ?>" class="form-control" id="datepickerDate">
						</div>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">RFID Code</label>
						<input name="TRUCK_RFID" id="TRUCK_RFID" type="text" value="<?php echo $truck_rfid ?>" class="form-control" placeholder="RFID Code">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					&nbsp;
				</header>
				<div class="main-box-body clearfix">		
					<div class="form-group example-twitter-oss pull-right">
						<button id="save_truck" class="btn btn-danger btn-footer" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Update</button>
						<button id="submit_header" class="btn btn-primary btn-footer"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>					
					</div>
				</div>
			</div>
		</div>
	</div>	

	<div class="modal fade bd-example-modal-sm" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-sm">
    		<div class="modal-content">
    			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel"><b>Informasi</b></h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<!-- <span aria-hidden="true">&times;</span> -->
        			</button>
      			</div>
      			<div class="modal-body">
        			Apakah anda yakin&hellip;?
      			</div>
      			<div class="modal-footer">
        			<button type="button" id="btn-modal-kirim" class="btn btn-danger"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Save</button>
        			<button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>
        		</div>
        	</div>
  		</div>
	</div>

<script>

	$(document).ready(function() {
		//$("#save_truck").prop('disabled', true);
		$('#save_truck').click(function(){
			var TRUCK_TYPE			= $('#TRUCK_TYPE').val();
			var TRUCK_CUST_NAME		= $('#TRUCK_CUST_NAME').val();
			var TRUCK_PLAT_EXP		= $('#TRUCK_PLAT_EXP').val();
			var TRUCK_RFID			= $('#TRUCK_RFID').val();

			if (TRUCK_TYPE == 'not-selected') {
				alert("Please Truck Type !");
				$('#TRUCK_TYPE').focus()
				return false;
			} else if (TRUCK_CUST_NAME == '') {
				alert("Please Customer Name !");
				$('#TRUCK_CUST_NAME').focus()
				return false;
			}else if (TRUCK_PLAT_EXP == '') {
				alert("Please Choose Tanggal Plat !");
				$('#TRUCK_PLAT_EXP').focus()
				return false;
			}else if (TRUCK_RFID == '') {
				alert("Please Choose Tanggal truck RFID !");
				$('#TRUCK_RFID').focus()
				return false;
			}

		});


		$('#TRUCK_PLAT_EXP').datetimepicker({
			format: 'Y-m-d H:i'
		});

		$('#TRUCK_CUST_NAME').autocomplete({
			minLength: 2,
			source: function( request, response ) {

				$.blockUI();
				$.ajax({
					url: "<?=ROOT?>npkbilling/truckregistrasi/getTruckCompany",
					type: 'post',
					dataType: "json",
					data: {
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
						search:request.term
					},
					success: function( data ) {
						obj = data.length;
						if (obj != 0) {
							response( data );
						}else{
							alert('Data Kosong');
						}
						$.unblockUI();
					}
				});
			},
			select: function (event, ui) {
				$('#TRUCK_CUST_ID').val(ui.item.value);
				$('#TRUCK_CUST_NAME').val(ui.item.label);
				return false;
			}
		});
	});

	function getSelectedText(elementId) {
		var elt = document.getElementById(elementId);
		if(elt == null){
			return '';
		}else{
			if (elt.selectedIndex == -1)
				return null;
			return elt.options[elt.selectedIndex].text;
		}
	}

	function getnameoperation(sel) {
		var text = sel.options[sel.selectedIndex].text;
		$("#TRUCK_TYPE_NAME").val(text);
	}

	$('#btn-modal-kirim').click(function(){ Update_truck(); return false; });

	function Update_truck() {
		$('#modal-default').modal('hide');
		var TRUCK_ID 			= $("#TRUCK_ID").val();
		var TRUCK_TYPE 			= $("#TRUCK_TYPE").val(); //KP
		var TRUCK_TYPE_NAME 	= $("#TRUCK_TYPE_NAME").val();
		var TRUCK_CUST_NAME 	= $("#TRUCK_CUST_NAME").val();
		var TRUCK_CUST_ID 		= $("#TRUCK_CUST_ID").val();
		var TRUCK_PLAT_EXP 		= $("#TRUCK_PLAT_EXP").val();
		var str 				= $("#TRUCK_PLAT_NO").val();
		var TRUCK_PLAT_NO		= str.toUpperCase();
		var str 				= $("#TRUCK_RFID").val();
		var TRUCK_RFID			= str.toUpperCase();

		var url = "<?=ROOT?>npkbilling/truckregistrasi/updateRequestTruck";
		$.blockUI();

		//return false;

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',				
				TRUCK_ID 			: TRUCK_ID,
				TRUCK_TYPE			: TRUCK_TYPE,
				TRUCK_TYPE_NAME		: TRUCK_TYPE_NAME,
				TRUCK_CUST_NAME		: TRUCK_CUST_NAME,
				TRUCK_CUST_ID		: TRUCK_CUST_ID,
				TRUCK_PLAT_EXP 		: TRUCK_PLAT_EXP,
				TRUCK_PLAT_NO 		: TRUCK_PLAT_NO,
				TRUCK_RFID			: TRUCK_RFID
			},
			success:function(data) {
				console.log("ini data: "+data);
				var obj = JSON.parse(data);
				if (obj == "Success") {
					var notification = new NotificationFx({
						message : '<p>Data Berhasil Disimpan</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					});
					setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/truckregistrasi"; }, 3000);	
				} else {
					alert('Data Gagal Disimpan;');
				}
				$.unblockUI();
			}
		});
	}
</script>



