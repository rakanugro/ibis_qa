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
			
		
			$('#tgl').datepicker({
		format: 'dd-mm-yyyy'
	});
		
		$('#expired_kiu').datepicker({
		format: 'dd-mm-yyyy'
	});
	
	var picker = $('#expired_stnk').datepicker({
		format: 'dd-mm-yyyy'
	});
		
		//sql injection protection
		$(":input").keyup(function(event) {
			// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});
		
			$( "#company_name" ).autocomplete({
				minLength: 5,
				source: function(request, response) {
					$.getJSON("<?=ROOT?>truck_container/auto_truck_company?",{  company_name: $( "#company_name" ).val(),
																				  port: $('#port').val()
																				 }, response);
					},
				focus: function( event, ui )
				{
					$( "#company_name" ).val( ui.item.COMPANY_NAME);
					return false;
				},
				select: function( event, ui )
				{
					$( "#company_name" ).val( ui.item.COMPANY_NAME);
					$( "#company_phone" ).val( ui.item.COMPANY_PHONE);
					$( "#association_company" ).val( ui.item.ASSOCIATION_COMPANY);
					$( "#company_address" ).val( ui.item.COMPANY_ADDRESS);
					return false;
				}
			}).data( "uiAutocomplete" )._renderItem = function( ul, item )
			{
				return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a align='center'><p class='repo-language'>" + item.COMPANY_NAME + "</p></a>")
				.appendTo( ul );
		}; 
		
		
	});

function submitheader()
{
	var v_port = $("#port").val();
	v_port = v_port.split("-");

	var v_rfid = '';

	var terminal = $("#port").val();
	var customer_name=$( "#customer_name" ).val();
	var customer_address=$( "#company_address" ).val();
	var registrant_phone=$( "#registrant_phone" ).val();
	var company_name=$( "#company_name" ).val();
	var company_phone=$( "#company_phone" ).val();
	var truck_number=$( "#truck_number" ).val();
	var truck_id=$( "#truck_id" ).val();
	var email=$( "#email" ).val();
	var kiu=$( "#kiu" ).val();
	var expired_kiu=$("#expired_kiu").val();
	var no_stnk=$( "#no_stnk" ).val();
	var expired_stnk=$( "#expired_stnk" ).val();
	var tgl=$( "#tgl" ).val();
	var rfid_code=$( "#rfid_code" ).val();
	var association_company=$( "#association_company" ).val();
	var txt_rfid = $( "#txt_rfid" ).val();
	

	/*if( terminal=='')
	{
		alert('Terminal tidak boleh kosong');
		return false;
	}*/
	
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
	
	/* if( customer_name=='')
	{
		alert('Registrant Name tidak boleh kosong');
		return false;
	} */
	
	/* if(registrant_phone=='')
	{
		alert('Registrant Phone tidak boleh kosong');
		return false;
	} */
	
	if(truck_id=='')
	{
		alert('TID tidak boleh kosong');
		return false;
	}
	
	if(truck_number=='')
	{
		alert('License Plate tidak boleh kosong');
		return false;
	}
	
	/* if(kiu=='')
	{
		alert('KIR tidak boleh kosong');
		return false;
	}
	
	if(expired_kiu=='')
	{
		alert('Expired KIR tidak boleh kosong');
		return false;
	} */
	
	/* if(no_stnk=='')
	{
		alert('NO STNK tidak boleh kosong');
		return false;
	} */
	
	/* if(expired_stnk=='')
	{
		alert('Expired STNK tidak boleh kosong');
		return false;
	} */
	
	/* if(association_company=='')
	{
		alert('Association Company tidak boleh kosong');
		return false;
	} */
	
	if(v_port[2] == 'IDPNJ') {
		if(txt_rfid == '')
		{
			alert('RFID Code tidak boleh kosong');
			return false;
		}
		else {
			v_rfid = txt_rfid;
		}
	}
	

	var url="<?=ROOT?>truck_container/create_register_id";
	$.blockUI();
	$.post(url,{TERMINAL:terminal,CUSTOMER_NAME:customer_name,CUSTOMER_ADDRESS:customer_address,REGISTRANT_PHONE:registrant_phone,COMPANY_NAME:company_name,COMPANY_PHONE:company_phone,TRUCK_NUMBER:truck_number,TRUCK_ID:truck_id,EMAIL:email,KIU:kiu,EXPIRED_KIU:expired_kiu,NO_STNK:no_stnk,EXPIRED_STNK:expired_stnk,TGL:tgl,RFID_CODE:rfid_code,ASSOCIATION_COMPANY:association_company,txt_rfid:v_rfid,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},

	function(data) {
		//alert(data);
		$.unblockUI();
		if(data == 'salah') {
			alert('Masih terdapat kesalahan input, silakan periksa kembali inputan anda.');
			return false;
		}
	
		$(':button').attr('disabled','disabled');
		
		var obj = jQuery.parseJSON( data );
		//alert(var obj);
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
				alert("Registrasi Truck Berhasil");
				
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
									<h2>Truck ID Registration</h2>
								</header>
									<div class="main-box-body clearfix">
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control">
												<option value=""> -- Please Choose Terminal -- </option>
												<?php
												foreach($terminal as $term)
												{
												?>
													<option 
													value="<?=$term["KODE_CABANG_SIMKEU"]?>-<?=$term["ID_PORT"]?>-<?=$term["PORT"].'-'.$term["TERMINAL"]?>" <?= $term["TERMINAL"]==$terminal_code? 'selected' : '' ?>>
													<?=$term["TERMINAL_NAME"]?>
													</option>
												<?php
												}
												?>
												</select>
										</div>
										
										<div class="form-group example-twitter-oss">
											<!--<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">ID Customer</label>
												<input type="hidden" class="form-control" id="customer_id" name="customer_id" size="8" readonly >-->
											<!--</div>-->
											
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Trucking Company Name<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Nama Perusahaan" title="Masukkan data perusahaan" size="8">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Company Phone<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="Telepon Perusahaan" title="Masukkan nomor perusahaan" size="8" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Company Address<font color="red">*</font></label>
												<input type="text" class="form-control" id="company_address" name="company_address" placeholder="Alamat Perusahaan" title="Masukkan alamat perusahaan" size="8" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Association Company<font color="red">*</font></label>
												<input type="hidden" class="form-control" id="rfid_code" name="rfid_code" placeholder="rfid-code" title="Masukkan No RFID Kartu" size="10" >
												<input type="text" class="form-control" id="association_company" name="association_company" placeholder="Association Company" title="Association Company" size="10" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Registrant Name</label>
												<input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Nama" title="Masukkan data customer" size="8">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Registrant Phone</label>
												<input type="text" class="form-control" id="registrant_phone" name="registrant_phone" placeholder="No Telepon" title="Masukkan nomor customer" size="8" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">TID<font color="red">*</font></label>
												<input type="text" class="form-control" id="truck_id" name="truck_id" placeholder="Truck ID" title="Masukkan TID" size="8" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">License Plate<font color="red">*</font></label>
												<input type="text" class="form-control" id="truck_number" name="truck_number" placeholder="Plat Nomor" title="Masukkan truck number" size="8" >
												<input type="hidden" class="form-control" id="tgl" name="tgl" placeholder="Tanggal Berlaku" title="Masukkan tanggal" size="10" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">KIR</label>
												<input type="text" class="form-control" id="kiu" name="kiu" placeholder="KIU" title="Masukkan KIR" size="10" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Expired KIR</label>
												<input type="text" class="form-control" id="expired_kiu" name="expired_kiu" placeholder="Expired KIU" title="Masukkan expired KIU" size="10" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">NO STNK</label>
												<input type="text" class="form-control" id="no_stnk" name="no_stnk" placeholder="NO STNK" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['EXPIRED_DATE']?>">
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Expired STNK</label>
												<input type="text" class="form-control" id="expired_stnk" name="expired_stnk" placeholder="Expired STNK" title="Masukkan No RFID Kartu" size="10" value="<?=$request_data[0]['EXPIRED_STNK']?>" >	
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Email</label>
												<input type="text" class="form-control" id="email" name="email" placeholder="Email" title="Masukkan email" size="8" >
											</div>
											<div id="div_rfid" style="display:none" class="form-group col-xs-6">
												<label for="exampleAutocomplete">RFID<font color="red">*</font></label>
												<input type="text" class="form-control" maxlength="16" id="txt_rfid" name="txt_rfid" title="Masukkan RFID" readonly="readonly" onkeyup="checkSizeRFID()" >
												<button id="btnGetRFID" class="btn btn-small">Get RFID</button>
											</div>
											<div class="form-group col-xs-6">
												<font color="red">*)field is required</font>
											</div>
											<div class="form-group col-xs-6">
												<button id="submit_header" onclick="submitheader()" class="btn btn-success">Save</button>
											</div>
										</div>
										
								</div>
							</div>
						</div>
					</div>
					 <div id="modalplaceholder"></div>
					<div id="detail_truck_id" name="detail_truck_id" class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Truck ID Search</h2>
								</header>

													<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<div class="main-box clearfix">
										<div class="main-box-body clearfix">
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Truck ID</label>
											<input type="text" class="form-control" id="search_input" name="search_input" value="" placeholder="" style="width:50%;" />
										</div>										
										<div class="form-group example-twitter-oss">
											<input type="button" onclick="load_table()" value="Search" id="search_reqs" name="search_reqs" class="btn btn-success"/>
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						 <div id="modalplaceholder"></div>
								<div class="main-box-body clearfix">
<div class="row" id="tabledata">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Truck ID List</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<div id= "contpainer-table"> 
											<table class="table table-striped table-hover">
												    <?php
												            $tmpl = array (
												                'table_open'          => '<table id="table-request" class="table table-hover">',
												                'heading_row_start'   => '<tr class=\'clickableRow\'>',
												                'heading_row_end'     => '</tr>',
												                'heading_cell_start'   => '',
												                'heading_cell_end'     => ''
												          );

												            $this->table->set_template($tmpl);                                              
												            echo $this->table->generate();
												        ?>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="dialogViewReq"></div>
					</div>


					<div id="viewDialogReject" style="display:none">
						<form action="#" method="post" id="view_approval_rejection">
							<table class="tablebase">
								<tr>
									<td width="130">Request Number</td>
									<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
									<td>
									<!-- <span id="reqnum"></span> -->
									<input id="view_reqnum" class="form-control" type="text" readonly="readonly">
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp</td>
								</tr>
								<tr>
									<td width="130">Vessel - Voyage</td>
									<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
									<td>
									<input id="view_vessel_and_voyage" class="form-control" type="text" readonly="readonly">
									</td>
								</tr>				
								<tr>
									<td colspan="3">&nbsp</td>
								</tr>		
								<tr>
									<td>Notes</td>
									<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
									<td>
										<textarea class="form-control" id="view_notes_rejection" placeholder="" title="Notes" cols="30" disabled="disabled"></textarea>
									</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp</td>
								</tr>
								<tr>
									<td width="130">Document</td>
									<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
									<td>
									<a href="#" id="file_reject"></a>
									</td>
								</tr>	
							</table>
							<!-- <br> -->
							<hr>
							<div>
								<div class="the_title_rejection">Notes History</div>
								<div id="rejection_history" style="float: left; width: 100%; font-size: 12px;">
								</div>
							</div>
						</form>
					</div>


<script>
	function load_table()
		{
			var port = $('#port').val();
			port = port.split("-");
			// console.log(port);
			$.blockUI();

			port_code = port[2];
			terminal_code = port[3];
			
			var url = "<?=ROOT?>/truck_container/search_truck_registration";
			var limit = $("#pagelimit").val();
			var search_input = $("#search_input").val();
			$("#tabledata").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
										port_code:port_code,
										terminal_code:terminal_code,
										search:search_input,
										page:1,limit:limit},function() {
									  $.unblockUI();
									});
		}	
		function clickDialog1(a)
		{
		    a = a.split(",");
		    var tid = a[0];
		    var port = a[1];
		    var terminal = a[2];

		    // var url = "<?=ROOT?>/truck_container/view_truck/"+tid+"/"+port+"/"+terminal;
		    $('#viewDialogReject').dialog({modal:false, height:300,width:500,title: 'View Rejection RBM',close: function( event, ui ) {$('a').removeAttr('disabled');}});
		    
		    // $('#dialogViewReq').load("http://localhost/ibis_qa/index.php//truck_container/view_truck/YU777/IDPNK/PNKD").dialog({modal:false, height:500,width:650,title: 'View Content'});
		}		
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
	var picker = $('#start_shift').datepicker({
		format: 'dd-mm-yyyy 00:00',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

	var picker = $('#peb_dt').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});
	//.val(moment().format("D-M-YYYY 00:00"));

	</script>
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/jquery.datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
	
<script type="text/javascript">
	
	var Form = function () { 
		var ChartInitialize = function(port1,port2) {

			$.ajax({  type:"post",
				async: false,
				data: { <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' , port1 : port1, port2 : port2},
				url: "<?=ROOT?>truck_container/table_truck_registration/",
				success: function(data) {
					$('#contpainer-table').empty();
					$('#contpainer-table').append(data);

				}
			});   
		
			$('#table-request').dataTable({
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
		};


		return {
			init: function() {
				$('body').on('change','#port',function(e){
					var port = $(this).val();
					port = port.split("-");
					ChartInitialize(port[2],port[3]); 
					
					// RFID base on Terminal
					var statRFID = $('#hidden_statrfid').val();
					if(statRFID == '1') {
						$('#div_rfid').css('display', 'block');
					}
					else {
						$('#div_rfid').css('display', 'none');
					}
					// alert(port[0]+"|"+port[2]+"|"+port[3]);
					                    
				});

					/*$('body').on('change','#port',function(e){
						   var port = $(this).val();
						   port = port.split("-");
						   ChartInitialize(port[2],port[3]);
						   var alamatku = "<?= base_url();?>ibis_qa/index.php/truck_container/create_truck_registration/"+port[2]+"/"+port[3];
						   console.log(alamatku);
						   window.location = alamatku;
						});*/

			}
		};

		}();

		function checkSizeRFID() {
			var v_elemt = $('#txt_rfid').val();
			var v_size = v_elemt.length;

			// if(v_size == 16) {
			// 	$('#txt_rfid').prop('readonly', true);
			// }
		}

		$('#btnGetRFID').click(function() {
			$('#txt_rfid').prop('readonly', false);
			$('#txt_rfid').val('');
			$('#txt_rfid').focus();

			// checkSizeRFID();
				// $('#txt_rfid').prop('readonly', true);
		});

		jQuery(document).ready(function() {
		    Form.init();
		});

		
</script>