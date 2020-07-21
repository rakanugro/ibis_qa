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
</style>

<script>
	$(document).ready(function() {
		//sql injection protection
		var edit="<?=$edit;?>";
		if(edit=='Y')
		{
			$('#request_no').val("<?=$data_headreq['ID_REQ'];?>");
			$('#port').val("<?=$data_headreq['ID_PORT'];?>");
			$('#customer_name').val("<?=$data_headreq['CUST_NAME'];?>");
			$('#customer_add').val("<?=$data_headreq['CUST_ADDR'];?>");
			$('#customer_npwp').val("<?=$data_headreq['CUST_NPWP'];?>");
			$('#customer_id').val("<?=$data_headreq['ID_CUST'];?>");
			$('#vessel_autocomplete').val("<?=$data_headreq['VESSEL'];?>");
			$('#voyage_in').val("<?=$data_headreq['VOY_IN'];?>");
			$('#voyage_out').val("<?=$data_headreq['VOY_OUT'];?>");
			$('#ukk').val("<?=$data_headreq['ID_VVD'];?>");
			$('#svc_type').val("<?=$data_headreq['ID_SERVICETYPE'];?>");
			$('#eta').val("<?=$data_headreq['ETA'];?>");
			$('#etd').val("<?=$data_headreq['ETD'];?>");
			$('#closing').val("<?=$data_headreq['CLOSE'];?>");
			$('#closingdoc').val("<?=$data_headreq['CLOSED'];?>");
			$('#openstack').val("<?=$data_headreq['OPEND'];?>");
			
			createHeader();			
		}
		
		
		$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
			$(this).val($(this).val().replace(/[\*\#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
		});
		var currentDate = new Date();
		var day = currentDate.getDate();
		var month = currentDate.getMonth() + 1;
		var year = currentDate.getFullYear();
		var hour = currentDate.getHours();
		var minute = currentDate.getMinutes() + 1;
		$("#start_shift").on('click', function(){
		  $("#start_shift").val(day+'-'+month+'-'+year+' '+hour+':'+minute);
		});

		$("#is_vgmterminal").on('click',function(){
				//alert('test');
				if(document.getElementById("is_vgmterminal").checked){
					$("#container_vgm").attr('style','display:none');
				}
				else {
					$("#container_vgm").removeAttr('style','display:none');
				}
		});

		$("#svc_type").on('change',function(){
			if($("#svc_type").val() == '03'){
			  $("#div_oldreq").removeAttr('style','display:none');
			}
			else {
			  $("#div_oldreq").attr('style','display:none');
			}
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
					$( "#customer_add" ).val( ui.item.ADDRESS);
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
		
		$( "#cargo_owner" ).autocomplete({
				minLength: 5,
				source: function(request, response) {
					$.getJSON("<?=ROOT?>autocomplete/getCustomerListNPK?",{  term: $( "#cargo_owner" ).val(),
																				  port: $('#port').val()
																				 }, response);
					},
				focus: function( event, ui )
				{
					$( "#cargo_owner" ).val( ui.item.NAME);
					return false;
				},
				select: function( event, ui )
				{
					$( "#cargo_owner" ).val( ui.item.NAME);
					$( "#cargo_owner_id" ).val( ui.item.CUSTOMER_ID);
					return false;
				}
			}).data( "uiAutocomplete" )._renderItem = function( ul, item )
			{
				return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a align='center'><p class='repo-language'>" + item.NAME + "</p><p class='repo-name'>" +item.CUSTOMER_ID+"</p></a>")
				.appendTo( ul );
		};		
	
	});

	function load_detail()
	{
		var edit="<?=$edit;?>";
		
		if(edit=='Y')
		{
			if(("<?=$data_headreq['ID_SERVICETYPE'];?>"=="01") || ("<?=$data_headreq['ID_SERVICETYPE'];?>"=="02"))
			{
				$('#do_numb').val("<?=$data_headreq['DO_NUMBER'];?>");
				$('#do_date').val("<?=$data_headreq['DO_DATE'];?>");
				$('#trade_type').val("<?=$data_detail[0]['OI'];?>");
				$('#sppb_npe').val("<?=$data_headreq['SPPB_OR_PE'];?>");
				$('#sppb_npe_date').val("<?=$data_headreq['SPPB_OR_PE_DATE'];?>");
				$('#bl_numb').val("<?=$data_detail[0]['BL_NUMBER'];?>");
				$('#bl_date').val("<?=$data_detail[0]['BL_DATE'];?>");
				$('#pol').val("<?=$data_headreq['POL'];?>");
				$('#comboPOD').val("<?=$data_headreq['POD'];?>");
				$('#comboFPOD').val("<?=$data_headreq['POR'];?>");
				$('#start_date').val("<?=$data_headreq['STACKIN_DATE'];?>");
				$('#wh_id').val("<?=$data_detail[0]['WHOUSE_ID'];?>");
				$('#end_date').val("<?=$data_headreq['STACKOUT_DATE'];?>");
				var mtl="";
				if("<?=$data_detail[0]['TL_FLAG'];?>"=="Y")
				{
					mtl="TL";
				}
				else
				{
					mtl="YARD";
				}
				$('#mv_type').val(mtl);
				
				<? foreach($data_detail as $row){?>
					var tbl = document.getElementById('list_cargo_table');
					var lastRow = tbl.rows.length;
					// if there's no header row in the table, then iteration = lastRow + 1
					var iteration = lastRow;
					var row = tbl.insertRow(lastRow);
					
					var cell = row.insertCell(0);
					var el = document.createElement('input');
					el.type = 'text';
					el.name = 'hs_code' + iteration;
					el.id = 'hs_code' + iteration;
					el.className = 'hs_code_class';
					el.size = 5;
					el.value = "<?=$row['HS_CODE'];?>";
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(1);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'cargo_id_' + iteration;
					el.id = 'cargo_id_' + iteration;
					el.className = 'cargo_id_class';
					el.size = 10;
					el.value = "<?=$row['ID_CARGO'];?>";
					cell.appendChild(el);
					
					cell = row.insertCell(2);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'cargo_name_' + iteration;
					el.id = 'cargo_name_' + iteration;
					el.className = 'cargo_name_class';
					el.value = "<?=$row['CARGO_NAME'];?>";
					el.size = 15;
					cell.appendChild(el);
					
					
					cell = row.insertCell(3);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'pkg_id_' + iteration;
					el.id = 'pkg_id_' + iteration;
					el.className = 'pkg_class';
					el.value = "<?=$row['ID_PKG'];?>";
					el.size = 10;
					cell.appendChild(el);
					
					cell = row.insertCell(4);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'qty_' + iteration;
					el.id = 'qty_' + iteration;
					el.className = 'qty_class';
					el.size = 10;
					el.value = "<?=$row['QTY'];?>";
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(5);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'ton_' + iteration;
					el.id = 'ton_' + iteration;
					el.className = 'ton_class';
					el.size = 10;
					el.value = "<?=$row['TON'];?>";
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(6);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'cubic_' + iteration;
					el.id = 'cubic_' + iteration;
					el.className = 'cubic_class';
					el.size = 10;
					el.value = "<?=$row['CUBIC'];?>";
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(7);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'hz_' + iteration;
					el.id = 'hz_' + iteration;
					el.className = 'hz_class';
					el.size = 5;
					el.value = "<?=$row['HZ'];?>";
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(8);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'ds_' + iteration;
					el.id = 'ds_' + iteration;
					el.className = 'ds_class';
					el.size = 5;
					el.value = "<?=$row['DS'];?>";
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(9);
					el = document.createElement('input');
					el.type = 'button';
					el.value = 'delete';
					el.onclick = function() {removeRowIndex(this,'list_cargo_table')};
					cell.appendChild(el);
					
					var x = tbl.rows;
					x[iteration].vAlign="top";
					
					document.getElementById('jum_detail').value = iteration;
				<?}?>
			}
			else if("<?=$data_headreq['ID_SERVICETYPE'];?>"=="00")
			{
				<? foreach($data_detail as $row){?>
					var tbl = document.getElementById('list_cargo_table1');
					var lastRow = tbl.rows.length;
					// if there's no header row in the table, then iteration = lastRow + 1
					var iteration = lastRow;
					var row = tbl.insertRow(lastRow);
					
					var cell = row.insertCell(0);
					var el = document.createElement('input');
					el.type = 'text';
					el.name = 'bl_numb' + iteration;
					el.id = 'bl_numb' + iteration;
					el.className = 'blnum_class';
					el.size = 10;
					el.value = '<?=$row['BL_NUMBER'];?>';
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(1);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'bl_date' + iteration;
					el.id = 'bl_date' + iteration;
					el.className = 'bldate_class';
					el.value = '<?=$row['BL_DATE'];?>';
					el.size = 15;
					cell.appendChild(el);
					
					cell = row.insertCell(2);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'cargo_name' + iteration;
					el.id = 'cargo_name' + iteration;
					el.className = 'cargo_name_class';
					el.value = '<?=$row['CARGO_NAME'];?>';
					el.size = 15;
					cell.appendChild(el);
					
					cell = row.insertCell(3);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'hs_code' + iteration;
					el.id = 'hs_code' + iteration;
					el.className = 'hs_code_class';
					el.value = '<?=$row['HS_CODE'];?>';
					el.size = 15;
					cell.appendChild(el);
					
					cell = row.insertCell(4);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'cargo_id' + iteration;
					el.id = 'cargo_id' + iteration;
					el.className = 'cargo_id_class';
					el.value = '<?=$row['ID_CARGO'];?>';
					el.size = 15;
					cell.appendChild(el);
					
					cell = row.insertCell(5);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'pkg_id_' + iteration;
					el.id = 'pkg_id_' + iteration;
					el.className = 'pkg_class';
					el.value = '<?=$row['ID_PKG'];?>';
					el.size = 15;
					cell.appendChild(el);
					
					cell = row.insertCell(6);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'qty_' + iteration;
					el.id = 'qty_' + iteration;
					el.className = 'qty_class';
					el.size = 10;
					el.value = '<?=$row['QTY'];?>';
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(7);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'ton_' + iteration;
					el.id = 'ton_' + iteration;
					el.className = 'ton_class';
					el.size = 10;
					el.value = '<?=$row['TON'];?>';
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(8);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'cubic_' + iteration;
					el.id = 'cubic_' + iteration;
					el.className = 'cubic_class';
					el.size = 10;
					el.value = '<?=$row['CUBIC'];?>';
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(9);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'hz_' + iteration;
					el.id = 'hz_' + iteration;
					el.className = 'hz_class';
					el.size = 5;
					el.value = '<?=$row['HZ'];?>';
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(10);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'ds_' + iteration;
					el.id = 'ds_' + iteration;
					el.className = 'ds_class';
					el.size = 5;
					el.value = '<?=$row['DS'];?>';
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(11);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'ei' + iteration;
					el.id = 'ei' + iteration;
					el.className = 'ei_class';
					el.size = 5;
					el.value = '<?=$row['E_I'];?>';
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(12);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'oi' + iteration;
					el.id = 'oi' + iteration;
					el.className = 'oi_class';
					el.value = '<?=$row['OI'];?>';
					el.size = 5;
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(13);
					el = document.createElement('input');
					el.type = 'text';
					el.name = 'tl' + iteration;
					el.id = 'tl' + iteration;
					el.className = 'tl_class';
					el.size = 5;
					el.value = '<?=$row['TL_FLAG'];?>';
					el.readOnly = true;
					cell.appendChild(el);
					
					cell = row.insertCell(14);
					el = document.createElement('input');
					el.type = 'button';
					el.value = 'delete';
					el.onclick = function() {removeRowIndex(this,'list_cargo_table1')};
					cell.appendChild(el);
					
					var x = tbl.rows;
					x[iteration].vAlign="top";
					
					document.getElementById('jum_detail').value = iteration;
				<?}?>
			}
					
		}
	}
			
	function createHeader(){
		var svc_type=$("#svc_type").val();
		var ukk=$("#ukk").val();
		
		var customer_name=$("#customer_name").val();
		var customer_id=$("#customer_id").val();
		var vessel_autocomplete=$("#vessel_autocomplete").val();
		var voyage_in=$("#voyage_in").val();
		var voyage_out=$("#voyage_out").val();
		var cargo_owner=$("#cargo_owner").val();
		var cargo_owner_id=$("#cargo_owner_id").val();
		
		if (customer_name =='')
		{
				alert('Field Customer Harus Terisi');
				return false;
		}
		else if (customer_id == '')
		{
				alert('Field Customer Harus Terisi');
				return false;
		}
		else if (vessel_autocomplete == '')
		{
				alert('Field Vessel Harus Terisi');
				return false;
		}
		else if (voyage_in == '')
		{
				alert('Field Vessel Harus Terisi');
				return false;
		}
		else if (voyage_out == '')
		{
				alert('Field Vessel Harus Terisi');
				return false;
		}
		
		var url="<?=ROOT?>om/booking/load_detail_req/"+svc_type+"/"+ukk;
		$('#container_data').load(url);
	}
			
	function complete(param){
		var res = param.split("^"); 
		//$isi=$t['VESSEL'].'^'.$t['VOYAGE_IN'].'^'.$t['VOYAGE_OUT'].'^'.$t['ETA'].'^'.$t['ETD'].'^'.$t['OPEN_STACK'].'^'.$t['CLOSING_TIME'].'^'.$t['CLOSING_TIME_DOC'].'^'.$t['ID_VSB_VOYAGE'].'^'.$t['VESSEL_CODE'].'^'.$t['CALL_SIGN'].'^'.$t['START_WORK'];
		$( "#vessel_autocomplete" ).val(res[0]);
		$( "#voyage_in" ).val(res[1]);
		$( "#voyage_out" ).val(res[2]);
		$( "#eta" ).val(res[3]);
		$( "#etd" ).val(res[4]);
		$( "#ukk" ).val(res[8]);
		$( "#vessel_code" ).val(res[9]);
		$( "#call_sign" ).val(res[10]);
		//$( "#voyage" ).val(res[0]);
		$( "#closing" ).val(res[6]);
		$( "#openstack" ).val(res[5]);
		$( "#closingdoc" ).val(res[7]);
	}
	
</script>

					<div class="row">
						<div class="col-lg-12 ">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Booking Data</h2>
								</header>

									<div class="main-box-body clearfix">
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Request Number</label>
											<input type="text" class="form-control" id="request_no" name="request_no" placeholder="" title="didapatkan setelah berhasil melakukan proses simpan" readonly>
										</div>
										<div class="form-group">
												<label>Terminal</label>
												<select id="port" name="port" class="form-control" style="width:400px;">
												<option> -- Please Choose Terminal -- </option>
												<?php
												foreach($terminal as $term)
												{
												?>
													<option value="<?=$term["KODE_CABANG_SIMKEU"]?>-<?=$term["ID_PORT"]?>"><?=$term["TERMINAL_NAME"]?></option>
												<?php
												}
												?>
												</select>
										</div>
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Debitur - Alamat</label>
												<input type="text" class="form-control" id="customer_name" name="customer_name" value="<?=$this->session->userdata('customername_phd');?>" placeholder="autocomplete" title="Data Nama Customer" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">&nbsp;</label>
												<input type="text" class="form-control" id="customer_add" name="customer_add" value="<?=$this->session->userdata('address_phd');?>" placeholder="autofill" title="Data Alamat Customer" readonly >
											</div>
										</div>
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Debitur NPWP</label>
												<input type="text" class="form-control" style="width:514px;" id="customer_npwp" name="customer_npwp" value="<?=$this->session->userdata('npwp_phd');?>" placeholder="autofill" title="Data NPWP Customer" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Debitur ID</label>
												<input type="text" class="form-control" style="width:514px;" id="customer_id" name="customer_id" value="<?=$this->session->userdata('customerid_phd');?>" placeholder="autofill" title="Data Customer ID" readonly>
											</div>
										</div>
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Vessel</label>
										    <div class="form-wrapper cf">
																  <input type="text" id="vessel_autocomplete"
											  name="vessel_autocomplete" placeholder="Search here..." title="Masukkan data kapal" required>
											  <button type="submit" onclick="search_vessel()">Search</button>
										    </div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage In</label>
												<input type="text" class="form-control" id="voyage_in" name="voyage_in" placeholder="Voyage In" title="Masukkan data kapal" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Voyage Out</label>
												<input type="text" class="form-control" id="voyage_out" name="voyage_out" placeholder="Voyage Out" title="Masukkan data kapal" readonly>
											</div>
											<input type="hidden" class="form-control" id="ukk" name="ukk" placeholder="autocomplete" title="Masukkan data kapal" readonly>
											<input type="hidden" id="vessel_code" name="vessel_code">
											<input type="hidden" id="voyage" name="voyage">
											<input type="hidden" id="call_sign" name="call_sign">
										</div>
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Estimate Time Arrival (ETA)</label>
												<input type="text" class="form-control" id="eta" name="eta" placeholder="autocomplete" title="Masukkan data kapal" readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Estimate Time Departure (ETD)</label>
												<input type="text" class="form-control" id="etd" name="etd" placeholder="autocomplete" title="Masukkan data kapal" readonly>
											</div>
										</div>
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Open Stack</label>
												<input type="text" class="form-control" id="openstack" name="openstack"  readonly>
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Closing Time</label>
												<input type="text" class="form-control" id="closing" name="closing" readonly>
											</div>
										</div>
										<div class="form-group example-twitter-oss">
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Closing Time Document</label>
												<input type="text" class="form-control" id="closingdoc" name="closingdoc" readonly style="width:514px;" >
											</div>
											<div class="form-group col-xs-6">
												<label for="exampleAutocomplete">Cargo Owner</label>
												<input type="text" class="form-control" id="cargo_owner" name="cargo_owner" placeholder="autocomplete" >
												<input type="hidden" id="cargo_owner_id" name="cargo_owner_id" >
											</div>
										</div>
										<div class="form-group">
												<label>Service Type</label>
												<select id="svc_type" name="svc_type" class="form-control" style="width:514px;">
													<option> -- Please Choose Service -- </option>
                          <?php foreach($svclist as $key) { ?>
                            <option value="<?=$key["ID_SERVICETYPE"]?>"><?=$key["SERVICETYPE_NAME"]?></option>
                          <?php } ?>
												</select>
												<input type="hidden" id="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
										</div>

                    <div class="form-group example-twitter-oss" id="div_oldreq" style="display:none">
                      <div class="form-group col-xs-12">
												<label>Old Delivery Request</label>
												<input class="form-control" type="text" id="old_req" name="old_req" style="width:514px;" />
                      </div>
												<input type="hidden" id="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
										</div>

										<button id="createHeader" onclick="createHeader();" class="btn btn-success"/>Create</button>
								</div>
							</div>
						</div>

					</div>
					<div class="row" id="container_data" name="container_data">
					</div>
					<div id="detailreq"></div>
          <div id="modalplaceholder"></div>

	<script>

  function search_vessel(){
      var vesselname = $("#vessel_autocomplete").val();
      var port       = $('#port').val();
		//container/auto_vessel_delivery
		//container_receiving/search_vessel_modal
      if(vesselname == ''){
          $("#vessel_autocomplete").focus();
          alert('Mohon diisi kolomnya');
      }
      else{
        $.get("<?=ROOT?>om/booking/auto_vessel_npk",{term : vesselname, port: port}, function(data){
              $('#modalplaceholder').html(data).children().modal('show');
          });
      }

  }

</script>

<link rel="stylesheet" href="<?=CUBE_?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/bootstrap-timepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=CUBE_?>css/libs/select2.css" type="text/css" />
