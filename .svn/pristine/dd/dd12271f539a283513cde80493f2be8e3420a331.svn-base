			<div id="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12">
								<div id="content-header" class="clearfix">
									<div class="pull-left">
										<ol class="breadcrumb">
											<li><a href="#">Home</a></li>
											<li class="active"><span>Ubah Profil</span></li>
										</ol>

										<h1>Ubah Profil</h1>
									</div>


									<?php if($this->session->userdata('custid_phd')){?>
									<div class="pull-right hidden-xs">
										<div class="xs-graph pull-right">
											<div class="graph-label">
												<a href="<?php echo ROOT."container/billing_management"?>"><b><i class="fa fa-shopping-cart"></i> <span id="tot_order_all"><?=$tot_order_all?></span></b> Orders</a>
												<br>
												<?=$customer_name?>
											</div>
											<!--<div class="graph-content spark-orders"></div>-->
										</div>
										<!--<div class="xs-graph pull-left mrg-l-lg mrg-r-sm">
											<div class="graph-label">
												<b>&dollar;12.338</b> Revenues
											</div>
											<div class="graph-content spark-revenues"></div>
										</div>-->
									</div>
										<?php }?>
								</div>
							</div>
						</div>
						<form id="form_update" role="form">
						<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Profile Detail</h2>
										</header>
										<div class="main-box-body clearfix">
											<div class="form-group example-twitter-oss">
												<input type="text" class="id_x hidden" value="">
												<!-- <input type="hidden" name="INV_USER_ID" id="INV_USER_ID"> -->
												<div class="row">
												<div class="form-group">
													<label class="control-label col-md-2">Name</label>
													<div class="col-md-6">
										                <input type="text" class="form-control" name="INV_USER_NAME" id="INV_USER_NAME" class="form-control" placeholder="Nama User" >
										            </div>        	
										        </div>
										    </div>
										    <br>
									        <div class="row">
												<div class="form-group">
													<label class="control-label col-md-2">NIPP</label>
													<div class="col-md-6">
										                <input type="text" class="form-control" value="" name="INV_USER_NIPP" id="INV_USER_NIPP" class="form-control" placeholder="Nipp" >
										            </div>        	
									        </div>
										        </div>
										        <br>
									       <div class="row">
										        <div class="form-group">
													<label class="control-label col-md-2">Username</label>
													<div class="col-md-6">
										                <input type="text" class="form-control"  name="INV_USER_USERNAME" id="INV_USER_USERNAME" class="form-control" placeholder="Username" >
										            </div>        	
										        </div>	
									        </div>
										        <br>
										    <div class="row">				        
												<div class="form-group">
													<label class="control-label col-md-2">Password</label>
													<div class="col-md-6">
										                <input type="password" class="form-control" name="INV_USER_PASSWORD" id="INV_USER_PASSWORD" class="form-control" data-error="Minimum of 6 characters"  minlength="6" maxlength="16" placeholder="Masukan password baru jika ingin merubah">
										            </div>        	
										        </div>
										    </div>
										        <br>
											<div class="row">
												<div class="form-group">
													<label class="control-label col-md-2">Confirm Password</label>
													<div class="col-md-6">
										                <input type="password" class="form-control" name="CONFIRM_PASSWORD" id="CONFIRM_PASSWORD" class="form-control" data-error="Minimum of 6 characters"  minlength="6" maxlength="16" placeholder="Ulangi password yang sama jika ingin merubah">
										            </div>        	
										        </div>
										    </div>
										        <br>
									        <div class="row">
										         <div class="form-group">
													<label class="control-label col-md-2">User Aktif </label>
													<div class="col-md-6">
										                <input type="text" class="form-control" value="" name="INV_USER_EFECTIVE" id="INV_USER_EFECTIVE" class="form-control" placeholder="User Aktif" data-error="required" readonly>
										            </div>        	
										        </div>
									        </div>
										        <br>
									        <div class="row">
													<div class="form-group">
													<label class="control-label col-md-2">User Expired</label>
													<div class="col-md-6">
										                <input type="text" class="form-control" value="" name="INV_USER_EXPIRED" id="INV_USER_EXPIRED" class="form-control" placeholder="User Aktif" data-error="required" readonly>
										            </div>        	
										        </div>	
									        </div>
										        <br>
										<center><input type="submit" value="Simpan" class="btn btn_user_update btn-primary"></center>																					
										    </div>
										</div>
										</div>
									</div>
								</div>
								</div>
								</form>
							</div>
						

		
<script>								

$( document ).ready(function() {
	editprofil();
	// alert('test');

});

$(document).ready(function() {
	//sql injection protection
	$('#INV_USER_PASSWORD').keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});

$(document).ready(function() {
	//sql injection protection
	$('#CONFIRM_PASSWORD').keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});

function editprofil()
	{		
			$id=0;
			$('#form_update')[0].reset();
			// alert($id);die;
			$('.id_x').val($id);
			var path = '';
			path = "<?php echo ROOT.'einvoice/profil/editprofil';?>";
			var INV_USER_ID 	= $id;
			$('[name="ROWID"]').val($id);
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,INV_USER_ID:INV_USER_ID
			}).done(function( data ) {
				var data1 = JSON.parse(data);
				 //alert($data1);
			// for(i=0; i<Object.keys(data1).length; i++){
				// console.log(data1);
				// alert(data1[0].INV_USER_NAME);
				var eff = GetDate(data1[0].INV_USER_EFECTIVE);
				var exp = GetDate(data1[0].INV_USER_EXPIRED);
				// alert(eff);die;
				// $('.nama_x').text(data1[0].INV_USER_NAME);
				$('#INV_USER_NAME').val(data1[0].INV_USER_NAME);
				$('#INV_USER_NIPP').val(data1[0].INV_USER_NIPP);
				$('#INV_USER_USERNAME').val(data1[0].INV_USER_USERNAME);
				// $('#INV_USER_PASSWORD').val(data1[0].INV_USER_PASSWORD);
				// $('#CONFIRM_PASSWORD').val(data1[0].CONFIRM_PASSWORD);
				$('#INV_USER_EFECTIVE').val(eff);
				$('#INV_USER_EXPIRED').val(exp);
				// $('#INV_UNIT_CODE').val(data1[0].INV_UNIT_CODE);
				$('#update_user').modal('show');
			
			});

			return false;
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

	$('.btn_user_update').click(function(){

})
	$('#form_update').submit(function (e) {
		// e.preventDefault();
		// // alert("test");
		if (e.isDefaultPrevented()) {
			return false;
		// handle the invalid form...
		} else {
			var path = '';
		path = "<?php echo ROOT.'einvoice/profil/updateprofil';?>";
		var INV_USER_ID 		=  $('.id_x').val();
		var INV_USER_NAME 		= $("#INV_USER_NAME").val();
		var INV_USER_NIPP 	= $("#INV_USER_NIPP").val();
		var INV_USER_USERNAME = $("#INV_USER_USERNAME").val();
		var INV_USER_PASSWORD 	= $("#INV_USER_PASSWORD").val();
		var CONFIRM_PASSWORD = $("#CONFIRM_PASSWORD").val();
		var INV_USER_EFECTIVE = $("#INV_USER_EFECTIVE").val();
		var INV_USER_EXPIRED = $("#INV_USER_EXPIRED").val();

		/*tambahan entity dan role*/
		
		INV_USER_EFECTIVE	= SetDate(INV_USER_EFECTIVE);
		INV_USER_EXPIRED	= SetDate(INV_USER_EXPIRED);
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			INV_USER_ID:INV_USER_ID,
			INV_USER_NAME:INV_USER_NAME,
			INV_USER_NIPP:INV_USER_NIPP,
			INV_USER_USERNAME:INV_USER_USERNAME,
			INV_USER_PASSWORD:INV_USER_PASSWORD,
			CONFIRM_PASSWORD:CONFIRM_PASSWORD,
			INV_USER_EFECTIVE:INV_USER_EFECTIVE,
			INV_USER_EXPIRED:INV_USER_EXPIRED
			// INV_UNIT_CODE:INV_UNIT_CODE
		}).done(function( data ) {
			// $('#update_user').modal('toggle');
			// loaddata();
			 var obj = jQuery.parseJSON(data);
             var status = obj['status'];
             // $('#allert_update').modal('show');
			 if(status =='success'){
			location.reload();
			 	 /*alert('success update data');*/
			 } else {
			 	 alert(obj.message);
			 }


        });

			return false;
		}
	});

	</script>