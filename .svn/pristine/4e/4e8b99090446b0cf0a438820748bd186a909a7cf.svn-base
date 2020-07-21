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
</style>

<script>
	$(document).ready(function() {
				$('#kendaraan_type').on('change', function(){
			var jenis_kend = $(this).val();
			//var terminal = ( $(this).val().split('-') )[1];
			//alert (jenis_kend);
			if (jenis_kend == 'KP'){
				$('#customer_name').attr('disabled','disabled');
			}  else {
				$("#customer_name").removeAttr('disabled');
			}
		});
		
			$('#tgl').datepicker({
		format: 'dd-mm-yyyy'
	});
		
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});
		
				$( "#customer_name" ).autocomplete({
				minLength: 5,
				source: function(request, response) {
					$.getJSON("<?=ROOT?>autocomplete/getCustomerList?",{  term: $( "#customer_name" ).val(),
																				  port: $('#port').val()
																				 }, response);
					},
				focus: function( event, ui )
				{
					$( "#customer_name" ).val( ui.item.NAME);
					return false;
				},
				select: function( event, ui )
				{
					$( "#customer_name" ).val( ui.item.NAME);
					$( "#customer_address" ).val( ui.item.ADDRESS);
					$( "#customer_npwp" ).val( ui.item.NPWP);
					$( "#customer_id" ).val( ui.item.CUSTOMER_ID);
					return false;
				}
			}).data( "uiAutocomplete" )._renderItem = function( ul, item )
			{
				return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a align='center'><p class='repo-language'>" + item.NAME + "</p><p class='repo-name'>" +item.ADDRESS+"</p></a>")
				.appendTo( ul );
		};
		
		
	});

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
	var stat_rfid = $( "#hidden_statrfid" ).val();

	if( registrant_name=='')
	{
		alert('Registrant Name tidak boleh kosong');
		return false;
	}
	
	if(registrant_phone=='')
	{
		alert('Registrant Phone tidak boleh kosong');
		return false;
	}
	
	if(company_name=='')
	{
		alert('Company Name tidak boleh kosong');
		return false;
	}
	
	if(company_phone=='')
	{
		alert('Company Phone tidak boleh kosong');
		return false;
	}
	
	if(truck_number=='')
	{
		alert('License Plate tidak boleh kosong');
		return false;
	}
	
	if(truck_id=='')
	{
		alert('TID tidak boleh kosong');
		return false;
	}
	
	if(company_address=='')
	{
		alert('Company Address tidak boleh kosong');
		return false;
	}
	
	if(kiu=='')
	{
		alert('KIR tidak boleh kosong');
		return false;
	}
	
	if(expired_kiu=='')
	{
		alert('Expired KIR tidak boleh kosong');
		return false;
	}
	
	if(no_stnk=='')
	{
		alert('NO STNK tidak boleh kosong');
		return false;
	}
	
	if(expired_stnk=='')
	{
		alert('Expired STNK tidak boleh kosong');
		return false;
	}
	
	if(expired_date=='')
	{
		alert('Expired Date tidak boleh kosong');
		return false;
	}
	
	if(association_company=='')
	{
		alert('Association Company tidak boleh kosong');
		return false;
	}
	
	if(stat_rfid == '1') {
		if(rfid_code == '')
		{
			alert('RFID Code tidak boleh kosong');
			return false;
		}
	}
	
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



//======================================= autocomplete container==========================================//



</script>
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Truck ID Registration</h2>
								</header>
									<div class="main-box-body clearfix">
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control" readonly>
													<?php foreach ($terminal as $key => $value) { ?>
														<?php if($value['TERMINAL'] == $port2){ ?>
															<option value="<?php echo $value['PORT']; ?>-<?php echo $value['TERMINAL']; ?>"><?php echo $value['TERMINAL_NAME']; ?></option>
														<?php } ?>
													<?php } ?>
												</select>
										</div>
										
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Registrant Name<font color="red">*</font></label>
												<input type="text" class="form-control" id="registrant_name" name="registrant_name" size="8" value="<?=$request_data[0]['REGISTRANT_NAME']?>">
												<input id="hidden_statrfid" name="hidden_statrfid" value="<?php echo $statRFID; ?>" type="hidden" />
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Registrant Phone<font color="red">*</font></label>
												<input type="text" class="form-control" id="registrant_phone" name="registrant_phone" title="Masukkan data customer" size="8" value="<?=$request_data[0]['REGISTRANT_PHONE']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Truck Company Name<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_name" name="company_name" title="Masukkan truck number" size="8" value="<?=$request_data[0]['COMPANY_NAME']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Company Phone<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="company_phone" title="Masukkan truck id" size="8" value="<?=$request_data[0]['COMPANY_PHONE']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Company Address<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['COMPANY_ADDRESS']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Association Company<font color="red">*</font></label>
												<input type="text" class="form-control" id="association_company" name="association_company" placeholder="Association Company" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['ASSOCIATION_COMPANY']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">License Plate<font color="red">*</font></label>
												<input type="text" class="form-control" id="truck_number" name="truck_number" placeholder="Truck Number" title="Masukkan truck id" size="8" value="<?=$request_data[0]['TRUCK_NUMBER']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">TID<font color="red">*</font></label>
												<input type="text" class="form-control" disabled="disabled" id="truck_id" name="truck_id" placeholder="TID" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['TID']?>">
												<input type="hidden" class="form-control" id="truck_id_old" name="truck_id_old" value="<?=$request_data[0]['TID']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">KIR<font color="red">*</font></label>
												<input type="text" class="form-control" id="kiu" name="kiu" placeholder="KIU" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['KIU']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Expired KIR<font color="red">*</font></label>
												<input type="text" class="form-control" id="expired_kiu" name="expired_kiu" placeholder="Expired KIU" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['EXPIRED_KIU']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">NO STNK<font color="red">*</font></label>
												<input type="text" class="form-control" id="no_stnk" name="no_stnk" placeholder="NO STNK" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['NO_STNK']?>" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Expired STNK<font color="red">*</font></label>
												<input type="text" class="form-control" id="expired_stnk" name="expired_stnk" placeholder="Expired STNK" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['EXPIRED_STNK']?>" >	
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Expired Date<font color="red">*</font></label>
											<input type="text" class="form-control" id="expired_date" name="expired_date" placeholder="Expired Date" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['EXPIRED_DATE']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">RFID Code</label>
												<input type="text" class="form-control" id="rfid_code" name="rfid_code" placeholder="RFID-Code" title="Masukkan No RFID Kartu" maxlength="16" size="10" value="<?=$request_data[0]['RFID_CODE']?>" readonly onkeyup="checkSizeRFID()">
												<button id="btnGetRFID" class="btn btn-small">Get RFID</button>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Email</label>
												<input type="text" class="form-control" id="email" name="email" placeholder="EMAIL" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['EMAIL']?>">
											</div>
											<div class="form-group col-xs-6">
												<font color="red">*)field is required</font>
											</div>
											<div>
											<label for="exampleAutocomplete">   </label>
												<button id="submit_header" onclick="submitheader()" class="btn btn-success">Save</button>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>

		<script>
		function load_table()
			{
				$.blockUI();
				var url = "<?=ROOT?>om/truck/search_main_truck";
				var limit = $("#pagelimit").val();
				var search_input = $("#search_input").val();
				$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
											search:search_input,
											page:1,limit:limit},function() {
										  $.unblockUI();
										});
			}
			var table2 = $('#table-request').dataTable({
				'info': false,
				'sDom': 'lTfr<"clearfix">tip',
				'columnDefs': [
					{ type: 'date-dd-mmm-yyyy', targets: 2 },
					{ type: 'date-dd-mmm-yyyy', targets: 6 }
				],
				'oTableTools': {
					'aButtons': [
						{
							'sExtends':    'collection',
							'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
							'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
						}
					]
				},
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
			});
							
		</script>
	<script>

  function search_vessel(){
      var vesselname = $("#vessel_autocomplete").val();
      var port       = $('#port').val();
      //var url = "<?=ROOT?>autocomplete/getVesselList";
      if(vesselname == ''){
          $("#vessel_autocomplete").focus();
          alert('Mohon diisi kolomnya');
      }
      else{
        $.get("<?=ROOT?>container/auto_vessel_delivery?",{term : vesselname, port: port}, function(data){
              $('#modalplaceholder').html(data).children().modal('show');
          });
      }

  }

  function complete($vessel,$voyin,$voyout,$voyage,$id_vsb_voyage,$vessel_code,$call_sign,$date_discharge,$etd,$eta,$nobook){
      $( "#vessel_autocomplete" ).val($vessel);
			$( "#voyage_in" ).val($voyin);
			$( "#voyage_out" ).val($voyout);
			$( "#voyage" ).val($voyage);
			$( "#id_vsb_voyage" ).val($id_vsb_voyage);
			$( "#vessel_code" ).val($vessel_code);
			$( "#call_sign" ).val($call_sign);
			$( "#date_discharge" ).val($date_discharge);
			$( "#etd" ).val($etd);
			$( "#eta" ).val($eta);
			$( "#nobook" ).val($nobook);

      $('#modalplaceholder').attr('display','none');
  }

	$(function() {
		$("#container_data").attr('class', 'row hidden');
		$("#container_excel").attr('class', 'row hidden');

    /*    $( "#vessel_autocomplete" ).autocomplete({
			minLength: 5,
			source: function(request, response) {
				$.getJSON("<?=ROOT?>autocomplete/getVesselList?",{  term: $( "#vessel_autocomplete" ).val(),
																			  port: $('#port').val()
																			 }, response);
				},
			focus: function( event, ui )
			{
				$( "#vessel_autocomplete" ).val( ui.item.VESSEL);
				return false;
			},
			select: function( event, ui )
			{
				$( "#vessel_autocomplete" ).val( ui.item.VESSEL);
				$( "#voyage_in" ).val( ui.item.VOYAGE_IN);
				$( "#voyage_out" ).val( ui.item.VOYAGE_OUT);
				$( "#eta" ).val( ui.item.ETA);
				$( "#etd" ).val( ui.item.ETD);
				$( "#end_shift" ).val( ui.item.ETD);
				$( "#ukk" ).val( ui.item.UKK);
				$( "#vessel_code" ).val( ui.item.VESSEL_CODE);
				$( "#call_sign" ).val( ui.item.CALL_SIGN);
				$( "#voyage" ).val( ui.item.VOYAGE);

				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item )
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'><p class='repo-language'>" + item.VESSEL + "</p><p class='repo-name'>Voyage in " +item.VOYAGE_IN+"- Voyage out "+item.VOYAGE_OUT+"</p></a>")
			.appendTo( ul );
    };*/



      /*  $( "#pod_autocomplete" ).autocomplete({
        minLength: 5,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>container_receiving/auto_pod?",{  term: $( "#pod_autocomplete" ).val(),
                                                                          vessel: $("#vessel_autocomplete").val(),
                                                                          voyin: $("#voyage_in").val(),
                                                                          voyout: $("#voyage_out").val(),
                                                                          port: $('#port').val()
                                                                         }, response);
            },
        focus: function( event, ui )
        {
            $( "#pod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            return false;
        },
        select: function( event, ui )
        {
            $( "#pod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            $( "#idpod" ).val( ui.item.ID_PELABUHAN);
            $( "#fpod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            $( "#idfpod" ).val( ui.item.ID_PELABUHAN);

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'>" + item.NM_PELABUHAN + "<br>" +item.ID_PELABUHAN+"</a>")
        .appendTo( ul );

        };

        $( "#fpod_autocomplete" ).autocomplete({
        minLength: 5,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>container_receiving/auto_pod?",{  term: $( "#fpod_autocomplete" ).val(),
                                                                          vessel: $("#vessel_autocomplete").val(),
                                                                          voyin: $("#voyage_in").val(),
                                                                          voyout: $("#voyage_out").val(),
                                                                          port: $('#port').val()
                                                                         }, response);
            },
        focus: function( event, ui )
        {
            $( "#fod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            return false;
        },
        select: function( event, ui )
        {
            $( "#fpod_autocomplete" ).val( ui.item.NM_PELABUHAN);
            $( "#idfpod" ).val( ui.item.ID_PELABUHAN);

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'>" + item.NM_PELABUHAN + "<br>" +item.ID_PELABUHAN+"</a>")
        .appendTo( ul );

      };*/

        /*$( "#container_operator" ).autocomplete({
        minLength: 3,
        source: function(request, response) {
            $.getJSON("<?=ROOT?>/container_receiving/auto_carrier?",{  term: $( "#container_operator" ).val(),
                                                                          vessel: $("#vessel_autocomplete").val(),
                                                                          port: $('#port').val()
                                                                         }, response);
            },
        focus: function( event, ui )
        {
            $( "#container_operator" ).val( ui.item.CODE);
            return false;
        },
        select: function( event, ui )
        {
            $( "#container_operator" ).val( ui.item.CODE);

            return false;
        }
        }).data( "uiAutocomplete" )._renderItem = function( ul, item )
        {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a align='center'>" + item.CODE + "<br>" +item.LINE_OPERATOR+"</a>")
        .appendTo( ul );

        };*/
    });

	//datepicker
	var picker = $('#expired_date').datepicker({
		format: 'dd-mm-yyyy'
	});

	var picker = $('#expired_stnk').datepicker({
		format: 'dd-mm-yyyy'
	});
	
	var picker = $('#expired_kiu').datepicker({
		format: 'dd-mm-yyyy'
	});
	//.val(moment().format("D-M-YYYY 00:00"));

		function checkSizeRFID() {
			var v_elemt = $('#rfid_code').val();
			var v_size = v_elemt.length;

			// if(v_size == 16) {
			// 	$('#txt_rfid').prop('readonly', true);
			// }
		}

		$('#btnGetRFID').click(function() {
			$('#rfid_code').prop('readonly', false);
			$('#rfid_code').val('');
			$('#rfid_code').focus();

			// checkSizeRFID();
				// $('#txt_rfid').prop('readonly', true);
		});

	</script>
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
