<script src="<?=CUBE_?>js/jquery.nanoscroller.min.js"></script>
<script src="<?=CUBE_?>js/modernizr.custom.js"></script>
<script src="<?=CUBE_?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?=CUBE_?>js/classie.js"></script>
<script src="<?=CUBE_?>js/notificationFx.js"></script>
<script src="<?=CUBE_;?>js/ipc/addressloading.js"></script>
<script src="<?=CUBE_;?>js/ipc/validation.js"></script>
<script src="<?=CUBE_?>js/hogan.js"></script>
<script src="<?=CUBE_?>js/typeahead.min.js"></script>
<script src="<?=CUBE_?>js/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-default.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-growl.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-bar.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-attached.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-other.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/libs/ns-style-theme.css"/>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>css/bootstrap/searchbt.css"/>


<style type="text/css">
.upload_info {
	font-size: small;
	font-style: italic;
	float: right;
}
.hidden_content {
	display: none;
}



.div_img {
  position: relative;
  text-align: left;
  color: black;
}

/* Bottom right text */
.txt_tid {
  position: absolute;
  top: 160px;
  right: 720px;
  font-weight: bold;
  font-size: 30px;
}
.txt_nopol {
  position: absolute;
  top: 190px;
  right: 720px;
  font-weight: bold;
  font-size: 30px;
}
.txt_company {
  position: absolute;
  top: 240px;
  right: 720px;
  font-weight: bold;
  font-size: 20px;
}

</style>

<script>
	function printBtn() {
		alert("Print TID");
	}

	function submitheader()
	{
		var terminal = $("#port").val();
		var registrant_name=$( "#registrant_name" ).val();
		var registrant_phone=$( "#registrant_phone" ).val();
		var company_name=$( "#company_name" ).val();
		var company_phone=$( "#company_phone" ).val();
		var truck_number=$( "#truck_number" ).val();
		var truck_id=$( "#truck_id" ).val();
		var company_address=$( "#company_address" ).val();
		var email=$( "#email" ).val();
		var kiu=$( "#kiu" ).val();
		var expired_kiu=$( "#expired_kiu" ).val();
		var no_stnk=$( "#no_stnk" ).val();
		var expired_stnk=$( "#expired_stnk" ).val();
		var expired_date=$( "#expired_date" ).val();
		var rfid_code=$( "#rfid_code" ).val();
		var association_company=$( "#association_company" ).val();
		var truck_id_old=$( "#truck_id_old" ).val();
		
		var url="<?=ROOT?>truck_container/update_register_id";
		$.blockUI();
		$.post(url,{TERMINAL:terminal,REGISTRANT_NAME:registrant_name,REGISTRANT_PHONE:registrant_phone,COMPANY_NAME:company_name,COMPANY_PHONE:company_phone,TRUCK_NUMBER:truck_number,TRUCK_ID:truck_id,COMPANY_ADDRESS:company_address,
		EMAIL:email,KIU:kiu,EXPIRED_KIU:expired_kiu,NO_STNK:no_stnk,EXPIRED_STNK:expired_stnk,EXPIRED_DATE:expired_date,RFID_CODE:rfid_code,ASSOCIATION_COMPANY:association_company,TRUCK_ID_OLD:truck_id_old,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

		function(data) {
			//alert(data);
			$.unblockUI();
			if(data == 'salah') {
				alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
				return false;
			}

			//$(':button').attr('disabled','disabled');

			var obj = jQuery.parseJSON( data );

			if(obj.rc=="F") {
				alert("Request Gagal. Hubungi sistem administrator: "+obj.rcmsg);
				$(':button').removeAttr('disabled');
			}
			else if(obj.data.info==null) {
				alert("Request Gagal. Hubungi sistem administrator: "+obj.rcmsg);
				$(':button').removeAttr('disabled');
			}
			else
			{
				var row_data = obj.data.info;
				var explode = row_data.split(',');
				var v_msg = explode[0];
				var v_req = explode[1];

				if(v_msg!="OK")
				{
					alert(v_req);
				}
				else
				{
					document.getElementById('submit_header').style.display = "none";
					alert("Simpan request berhasil");
					
					window.location = "<?=ROOT?>truck_container/create_truck_registration";

					// show the notification
					notification.show();
				}
				$(':button').removeAttr('disabled');
			}
		});
	}

</script>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2>Preview TID Card</h2>
			</header>
			<div class="main-box-body clearfix">
					<div class="div_img">
						<img src="<?=CUBE_?>img/tid_card.jpeg" alt="Snow" width="500" height="333">
						<div class="txt_tid"><?=$request_data[0]['TID']?></div>
						<div class="txt_nopol"><?=$request_data[0]['TRUCK_NUMBER']?></div>
						<div class="txt_company"><?=$request_data[0]['COMPANY_NAME']?></div>
					</div>
					<div>
						<button id="submit_header" onclick="printBtn()" class="btn btn-primary">PRINT</button>
					</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
