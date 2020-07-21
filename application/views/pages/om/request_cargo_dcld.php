<script>
$(document).ready(function() {
	$.post("<?=ROOT?>om/booking/auto_pkgtype",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',port: $('#port').val()
																	  },function(data){
		
														  
	    $("#pkg_id").html(data);
		load_detail();
	});
	
				var ei = $("#ei").val();
				console.log(ei);
				var pkg = $("#pkg_id").val();
				console.log(pkg);

		$( "#cargo_name" ).autocomplete({
			minLength: 5,
			source: function(request, response) {


					if(ei == 'E' && pkg=='General Cargo' || pkg=='Curah Kering'){

				console.log(ei+' NPK '+pkg);
						

						$.getJSON("<?=ROOT?>autocomplete/getHsCodeNpk?",{   term: $( "#cargo_name" ).val(),
																	port: $('#port').val(),
																	cargo_owner: $('#cargo_owner').val()
																			 }, response);
						// console.log("respones"+response);

					}else{

				console.log(ei+' Non '+pkg);
						$.getJSON("<?=ROOT?>autocomplete/getHsCode?",{  term: $( "#cargo_name" ).val(),
																				  port: $('#port').val()
																				 }, response);
					}
				},
			focus: function( event, ui )
			{
				$( "#cargo_name" ).val( ui.item.CARGO_NAME);
				// alert('1');
				return false;
			},
			select: function( event, ui )
			{
				$( "#cargo_name" ).val( ui.item.CARGO_NAME);
				$( "#cargo_id" ).val( ui.item.ID_CARGO);
				$( "#hs_code" ).val( ui.item.HS_CODE);
				$( "#size" ).val( ui.item.SIZE_);
				$( "#type").val( ui.item.TYPE_);
				$( "#status" ).val( ui.item.STATUS_);
				$( "#lblweight" ).text( ui.item.WEIGHT);
				$( "#lblvolume").text( ui.item.VOLUME);
				$( "#lblquantity" ).text( ui.item.QUANTITY);
				// alert('2');
				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item )
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'><p class='repo-language'>" + item.CARGO_NAME + "</p><p class='repo-name'>" +item.ID_CARGO+"</p></a>")
			.appendTo( ul );
	    };
	// }
});


$('#do_date').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});
	
$('#sppb_npe_date').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

$('#bl_date').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

$('#bl_date2').datepicker({
		format: 'dd-mm-yyyy',
		//startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});	
	
$('#start_date').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

$('#end_date').datepicker({
		format: 'dd-mm-yyyy',
		startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});


function getEI(){
	var ei = $("#ei").val();
	console.log(ei);
	return ei;
}

function getPackage(){
	var pkg = $("#pkg_id").val();
				console.log(pkg);
	return pkg;
}

function getCgList(){

	var cargo_owner=$("#cargo_owner").val();
	var cargo_owner_id=$("#cargo_owner_id").val();	
	console.log(cargo_owner);

	var url = "<?=ROOT?>autocomplete/getHsCode?"
}

function addrowToTable(tableid)
{


	var tbl = document.getElementById(tableid);
	var lastRow = tbl.rows.length;
	// if there's no header row in the table, then iteration = lastRow + 1
	var iteration = lastRow;
	var row = tbl.insertRow(lastRow);
	var weight = $('#lblweight').text();
	var qty = $('#lblquantity').text();
	var vol = $('#lblvolume').text();
	var IntW = parseInt(weight);
	var IntQ = parseInt(qty);
	var IntV = parseInt(vol);

	var ton = $('#ton').val();
	var quant = $('#qty').val();
	var kubik = $('#cubic').val();
	var IntT = parseInt(ton);
	var IntQty = parseInt(quant);
	var IntK = parseInt(kubik);
	
	if($('#bl_number').val()=='')
		{
			alert('Field BL Number Harus Terisi');
			return false;
		} 
	else 	if($('#bl_date2').val()=='')
		{
			alert('Field BL Date Harus Terisi');
			return false;
		}
	else 	if($('#cargo_name').val()=='')
		{
			alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
			return false;
		}
	else 	if($('#hs_code').val()=='')
		{
			alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
			return false;
		}
	else 	if($('#cargo_id').val()=='')
		{
			alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
			return false;
		}

	else 	if($('#cubic').val()=='' && $('#ton').val()=='' && $('#qty').val()=='' )
		{
			alert('Jumlah Muatan atau Bongkaran Harus Diisi, Sesuaikan Dengan Tipe Package');
			return false;
		}
	else 	if($('#pkg_id').val()=='General Cargo' || $('#pkg_id').val()=='Curah Kering')
		{
			if($('#ei').val()=='E'){
				var q;
				var w;
				var v;

				if(qty == 0){
					q = 1;
					// confirm('jumlah quantitas di NPK '+0+'. klik "OK" untuk melanjutkan');
				} else if (IntQty > IntQ){
					q = 0;
					alert('Jumlah quantiti Muatan tidak dapat melebihi '+ qty);
					return false;
				} else {
					q = 1;
				}

				if(weight == 0){
					w = 1;
					// confirm('jumlah tonase di NPK  '+0+'. klik "OK" untuk melanjutkan');
				} else if (IntT > IntW){
					w = 0;
					alert('Jumlah tonase Muatan tidak dapat melebihi '+ weight);
					return false;
				} else {
					w = 1;
				}

				if(vol == 0){
					v = 1;
					// confirm('jumlah kubikasi di NPK '+0+'. klik "OK" untuk melanjutkan');
				} else if (IntK > IntV){
					v = 0;
					alert('Jumlah kubikasi Muatan tidak dapat melebihi '+ vol);
					return false;
				} else {
					v = 1;
				}
			}
		}	
	var cell = row.insertCell(0);
	var el = document.createElement('input');
	el.type = 'text';
	el.name = 'bl_numb' + iteration;
	el.id = 'bl_numb' + iteration;
	el.className = 'blnum_class';
	el.size = 10;
	el.value = $('#bl_number').val();
	el.readOnly = true;
	cell.appendChild(el);
	
	
	cell = row.insertCell(1);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'bl_date' + iteration;
	el.id = 'bl_date' + iteration;
	el.className = 'bldate_class';
	el.value = $('#bl_date2').val();
	el.size = 15;
	cell.appendChild(el);
	
	cell = row.insertCell(2);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'ei' + iteration;
	el.id = 'ei' + iteration;
	el.className = 'ei_class';
	el.size = 5;
	el.value = $('#ei').val();
	el.readOnly = true;
	cell.appendChild(el);
	
	cell = row.insertCell(3);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'pkg_id_' + iteration;
	el.id = 'pkg_id_' + iteration;
	el.className = 'pkg_class';
	el.value = $('#pkg_id').val();
	el.size = 15;
	cell.appendChild(el);

	cell = row.insertCell(4);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'cargo_name' + iteration;
	el.id = 'cargo_name' + iteration;
	el.className = 'cargo_name_class';
	el.value = $('#cargo_name').val();
	el.size = 15;
	cell.appendChild(el);
	
	cell = row.insertCell(5);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'hs_code' + iteration;
	el.id = 'hs_code' + iteration;
	el.className = 'hs_code_class';
	el.value = $('#hs_code').val();
	el.size = 15;
	cell.appendChild(el);
	
	cell = row.insertCell(6);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'cargo_id' + iteration;
	el.id = 'cargo_id' + iteration;
	el.className = 'cargo_id_class';
	el.value = $('#cargo_id').val();
	el.size = 15;
	cell.appendChild(el);
	
	cell = row.insertCell(7);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'qty_' + iteration;
	el.id = 'qty_' + iteration;
	el.className = 'qty_class';
	el.size = 10;
	el.value = $('#qty').val();
	el.readOnly = true;
	cell.appendChild(el);
	
	cell = row.insertCell(8);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'ton_' + iteration;
	el.id = 'ton_' + iteration;
	el.className = 'ton_class';
	el.size = 10;
	el.value = $('#ton').val();
	el.readOnly = true;
	cell.appendChild(el);
	
	cell = row.insertCell(9);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'cubic_' + iteration;
	el.id = 'cubic_' + iteration;
	el.className = 'cubic_class';
	el.size = 10;
	el.value = $('#cubic').val();
	el.readOnly = true;
	cell.appendChild(el);
	
	cell = row.insertCell(10);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'hz_' + iteration;
	el.id = 'hz_' + iteration;
	el.className = 'hz_class';
	el.size = 5;
	el.value = $('#hz').val();
	el.readOnly = true;
	cell.appendChild(el);
	
	cell = row.insertCell(11);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'ds_' + iteration;
	el.id = 'ds_' + iteration;
	el.className = 'ds_class';
	el.size = 5;
	el.value = $('#ds').val();
	el.readOnly = true;
	cell.appendChild(el);
	
	
	cell = row.insertCell(12);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'oi' + iteration;
	el.id = 'oi' + iteration;
	el.className = 'oi_class';
	el.value = $('#oi').val();
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
	el.value = $('#tl').val();
	el.readOnly = true;
	cell.appendChild(el);
	
	cell = row.insertCell(14);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'size_' + iteration;
	el.id = 'size_' + iteration;
	el.className = 'size_class';
	el.size = 5;
	el.value = $('#size').val();
	cell.appendChild(el);
	var el_size = el;
	
	cell = row.insertCell(15);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'type_' + iteration;
	el.id = 'type_' + iteration;
	el.className = 'type_class';
	el.size = 5;
	el.value = $('#type').val();
	cell.appendChild(el);
	var el_type = el;
	
	cell = row.insertCell(16);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'status_' + iteration;
	el.id = 'status_' + iteration;
	el.className = 'status_class';
	el.size = 5;
	el.value = $('#status').val();
	cell.appendChild(el);
	var el_status = el;
	
	cell = row.insertCell(17);
	el = document.createElement('input');
	el.type = 'button';
	el.value = 'delete';
	el.onclick = function() {removeRowIndex(this,tableid)};
	cell.appendChild(el);
	
	var x = tbl.rows;
	x[iteration].vAlign="top";
	
	document.getElementById('jum_detail').value = iteration;
}

function removeRowIndex(obj,tableid)
{
	var par=obj.parentNode;
	while(par.nodeName.toLowerCase()!='tr'){
		par=par.parentNode;
	}
	var index = par.rowIndex;
	
	var tbl = document.getElementById(tableid);
	var lastRow = tbl.rows.length;
	tbl.deleteRow(index);
	while(index < tbl.rows.length) {
		indexnya = index+1;
		bl_numb = document.getElementById('bl_numb' + indexnya);
		bl_numb.id="bl_numb"+index;
		bl_numb.name="bl_numb"+index;
		bl_date = document.getElementById('bl_date' + indexnya);
		bl_date.id="bl_date"+index;
		bl_date.name="bl_date"+index;
		cargo_name = document.getElementById('cargo_name' + indexnya);
		cargo_name.id="cargo_name"+index;
		cargo_name.name="cargo_name"+index;
		hs_code = document.getElementById('hs_code' + indexnya);
		hs_code.id="hs_code"+index;
		hs_code.name="hs_code"+index;
		cargo_id = document.getElementById('cargo_id' + indexnya);
		cargo_id.id="cargo_id"+index;
		cargo_id.name="cargo_id"+index;
		pkg_id_ = document.getElementById('pkg_id_' + indexnya);
		pkg_id_.id="pkg_id_"+index;
		pkg_id_.name="pkg_id_"+index;
		qty_ = document.getElementById('qty_' + indexnya);
		qty_.id="qty_"+index;
		qty_.name="qty_"+index;
		ton_ = document.getElementById('ton_' + indexnya);
		ton_.id="ton_"+index;
		ton_.name="ton_"+index;
		hz = document.getElementById('hz_' + indexnya);
		hz.id="hz_"+index;
		hz.name="hz_"+index;		
		ds_ = document.getElementById('ds_' + indexnya);
		ds_.id="hz_"+index;
		ds_.name="hz_"+index;		
		ei = document.getElementById('ei' + indexnya);
		ei.id="ei"+index;
		ei.name="ei"+index;		
		oi = document.getElementById('oi' + indexnya);
		oi.id="oi"+index;
		oi.name="oi"+index;		
		tl = document.getElementById('tl' + indexnya);
		tl.id="tl"+index;
		size = document.getElementById('size' + indexnya);
		size_.id="size_"+index;
		size_.name="size_"+index;
		type = document.getElementById('type' + indexnya);
		type_.id="type_"+index;
		type_.name="type_"+index;
		status = document.getElementById('status' + indexnya);
		status_.id="status_"+index;
		status_.name="status_"+index;		
		
		index++;
	}		
	
	document.getElementById('jum_detail').value = (tbl.rows.length-1);
}

// function getCgList(){

// }

function createAll()
{	
	var port=$('#port').val();
	var customer_id=$( "#customer_id" ).val();
	var customer_name=$( "#customer_name" ).val();
	
	var cargo_owner=$("#cargo_owner").val();
	var cargo_owner_id=$("#cargo_owner_id").val();	
	// console.log(cargo_owner);
	
	var customer_add=$( "#customer_add" ).val();
	var customer_npwp=$( "#customer_npwp" ).val();
	var svc_type=$( "#svc_type" ).val();
	var ukk=$( "#ukk" ).val();
	var vessel_autocomplete=$( "#vessel_autocomplete" ).val();
	var voyage_in=$( "#voyage_in" ).val();
	var voyage_out=$( "#voyage_out" ).val();
	/*var do_numb=$( "#do_numb" ).val();
	var do_date=$( "#do_date" ).val();
	var pol=$( "#pol" ).val();
	var pod=$( "#comboPOD" ).val();
	var fpod=$( "#comboFPOD" ).val();
	var start_date=$( "#start_date" ).val();
	var wh_id=$( "#wh_id" ).val();
	var end_date=$( "#end_date" ).val();
	var mv_type=$( "#mv_type" ).val();
	var sppb_npe=$( "#sppb_npe" ).val();
	var sppb_npe_date=$( "#sppb_npe_date" ).val();
	
	Pada permintaan B/M field diatas tidak tercantum
	*/
	
	var do_numb='';
	var do_date='';
	var pol='';
	var pod='';
	var fpod='';
	var start_date='';
	var wh_id='';
	var end_date='';
	var mv_type='';
	var sppb_npe='';
	var sppb_npe_date='';
	
	var hs_code=[];
	hs_code = $('.hs_code_class').map( function(){return $(this).val(); }).get();
	
	var cargo_id=[];
	cargo_id = $('.cargo_id_class').map( function(){return $(this).val(); }).get();
	
	var cargo_name=[];
	cargo_name = $('.cargo_name_class').map( function(){return $(this).val(); }).get();
	
	var pkg_id=[];
	pkg_id = $('.pkg_class').map( function(){return $(this).val(); }).get();
	
	var qty=[];
	qty = $('.qty_class').map( function(){return $(this).val(); }).get();
	
	var ton=[];
	ton = $('.ton_class').map( function(){return $(this).val(); }).get();
	
	var cubic=[];
	cubic = $('.cubic_class').map( function(){return $(this).val(); }).get();
	
	var hz=[];
	hz = $('.hz_class').map( function(){return $(this).val(); }).get();
	
	var ds=[];
	ds = $('.ds_class').map( function(){return $(this).val(); }).get();
	
	var ei=[];
	ei = $('.ei_class').map( function(){return $(this).val(); }).get();
	
	var oi=[];
	oi = $('.oi_class').map( function(){return $(this).val(); }).get();
	
	var tl=[];
	tl = $('.tl_class').map( function(){return $(this).val(); }).get();
	
	var bl=[];
	bl = $('.blnum_class').map( function(){return $(this).val(); }).get();
	
	var bldate=[];
	bldate = $('.bldate_class').map( function(){return $(this).val(); }).get();
	
		var size=[];
	size = $('.size_class').map( function(){return $(this).val(); }).get();
	
	var type=[];
	type = $('.type_class').map( function(){return $(this).val(); }).get();
	
	var status=[];
	status = $('.status_class').map( function(){return $(this).val(); }).get();
	
			if(cargo_name=='')
{
	alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
	return false;
}
else if(hs_code =='')
{
	alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
	return false;
}
else if(bl =='')
{
	alert('Field BL Harus Terisi');
	return false;
}
else if(bldate =='')
{
	alert('Field BL Date Harus Terisi');
	return false;
}
else 	if(cargo_id=='')
{
	alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
	return false;
}
else 	if(pkg_id=='')
{
	alert('Package Harus Dipilih');
	return false;
}

else 	if(cubic=='' && ton=='' && qty=='' )
{
	alert('Jumlah Muatan atau Bongkaran Harus Diisi, Sesuaikan Dengan Tipe Package');
	return false;
}
	
	var url="<?=ROOT?>om/booking/save_recdelv";
	$.blockUI();
	
	$.post(url,{
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				PORT:port,
				CNAME:customer_name,
				CADD:customer_add,
				CNPWP:customer_npwp,
				CID:customer_id,
				SVCT:svc_type,
				UKK:ukk,
				VES:vessel_autocomplete,
				VIN:voyage_in,
				VOT:voyage_out,
				DON:do_numb,
				DOD:do_date,
				POL:pol,
				POD:pod,
				POR:fpod,
				STD:start_date,
				WHI:wh_id,
				END:end_date,
				MVT:tl,
				SPB:sppb_npe,
				SPD:sppb_npe_date,
				HSC:hs_code,
				CRI:cargo_id,
				CRN:cargo_name,
				PKG:pkg_id,
				QTY:qty,
				TON:ton,
				CBC:cubic,
				HZD:hz,
				DST:ds,
				SIZE:size,
				TYPE:type,
				STATUS:status,
				TTY:oi,
				BLN:bl,
				BLD:bldate,
				TYA:ei,
				PYC:$('#type_of_payment').val(),
				IDR:$('#request_no').val(),
				ETA:$('#eta').val(),
				ETD:$('#etd').val(),
				CONAME:cargo_owner,
				COID:cargo_owner_id
			}, function(data){
				var result=data.split("^");
				var message='';
				if(result[0]=='Ok')
				{
					message='Your request number is '+result[1];
					$.unblockUI();
					alert(message);
					window.location = "<?=ROOT?>om/booking";
				}
				else
				{
					message='Request Error, contact your administrator';
				}
				
				
	});
}


</script>
<div class="col-lg-12 ">
	<div class="main-box">
		<header class="main-box-header clearfix">
			<h2>Detail Booking</h2>
		</header>
		<div class="main-box-body clearfix">
			<div class="form-group">	
				<div class="form-group col-xs-12">
					<label for="exampleAutocomplete">Type of Payment</label>
					<select id="type_of_payment" name="type_of_payment" class="form-control" style="width:300px;">
						<option value="UP">Sum Insured (UPER)</option>
						<option value="CD">Non UPER</option>
					</select>
				</div>				
			</div>
			<!--
			<div class="form-group">
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">BL Number</label>
					<input type="text" class="form-control" id="bl_numb" name="bl_numb" title="BL Number" /> <button id="loadbl" onclick="loadBL();" class="btn btn-success">Load</button>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">BL Date</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control" id="bl_date" name="bl_date" title="BL Date" /> 
						<input type="hidden" name="jum_detail" id="jum_detail" />
					</div>
				</div>
			</div>
			-->
			<input type="hidden" id="lblweight" name="weight" value=""  class="form-control" style="width:200px;" />
			<input type="hidden" id="lblvolume" name="volume" value=""  class="form-control" style="width:200px;" />
			<input type="hidden" id="lblquantity" name="quantity" value=""  class="form-control" style="width:200px;" />
			<div class="form-group">
				&nbsp;
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id='list_cargo_table1'>
					<thead>
						<tr>
							<th><span>BL/SI Number</span></th>
							<th><span>BL/SI Date</span></th>
							<th><span>EI</span></th>
							<th><span>Package Name</span></th>
							<th><span>Cargo Name</span></th>
							<th><span>HS Code</span></th>
							<th><span>Cargo ID</span></th>
							<th><span>Qty</span></th>
							<th><span>Ton</span></th>
							<th><span>Cubic</span></th>
							<th><span>Hz</span></th>
							<th><span>Ds</span></th>
							<th><span>OI</span></th>
							<th><span>TL</span></th>
							<th><span>Action</span></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" id="bl_number" name="bl_number" value="" style="width:100px;"  class="form-control"/></td>
							<td><input type="text" id="bl_date2" name="bl_date2" value="" style="width:100px;" class="form-control"/></td>
							<td><select id="ei" name="ei" class="form-control" style="width:80px;" onchange="getEI();" >
									<option value="E">E</option>
									<option value="I">I</option>
								</select></td>
							<td><select id="pkg_id" name="pkg_id" class="form-control" style="width:200px;"  onchange="getPackage();"></select></td>
							<td>
								<input type="text" id="cargo_name" name="cargo_name" value=""  class="form-control" style="width:200px;" />
							</td>
							<td>
								<input type="text" id="hs_code" name="hs_code" value="" readonly  class="form-control" style="width:100px;" />
							</td>
							<td>
								<input type="text" id="cargo_id" name="cargo_id" value="" readonly  class="form-control" style="width:100px;"/>
							</td>
							<td>
								<!-- <p style="color: red;">Max: <label id='lblquantity'></label></p> -->
								<input type="text" id="qty" name="qty" value="" style="width:60px;" class="form-control"/>
							</td>
							<td>
								<!-- <p style="color: red;">Max: </p><p id='lblweight' name="weight"></p> -->
								<input type="text" id="ton" name="ton" value="" style="width:60px;" class="form-control"/>
							</td>
							<td>
								<!-- <p style="color: red;">Max: </p><p id='lblvolume' name="volume"></p> -->
								<input type="text" id="cubic" name="cubic" value="" style="width:60px;" class="form-control"/>
							</td>
							<td><select id="hz" name="hz" class="form-control" style="width:80px;">
									<option value="N">N</option>
									<option value="Y">Y</option>
								</select></td>
							<td><select id="ds" name="ds" class="form-control" style="width:80px;">
									<option value="N">N</option>
									<option value="Y">Y</option>
								</select></td>
							<td><select id="oi" name="oi" class="form-control" style="width:80px;">
									<option value="O">O</option>
									<option value="I">I</option>
								</select></td>
							<td><select id="tl" name="tl" class="form-control" style="width:80px;">
									<option value="N">N</option>
									<option value="Y">Y</option>
								</select></td>
							<td>
							<input type="hidden" id="size" name="size" value="" class="form-control" />
							<input type="hidden" id="type" name="type" value="" class="form-control" />
							<input type="hidden" id="status" name="status" value="" class="form-control" />
							
								<a class="link-button" onclick="addrowToTable('list_cargo_table1')">
									<img border="0" src="<?=IMAGES_?>add_content.png" />
								</a>
							</td>
						</tr>
					</tbody>
				</table>
				<input type="hidden" name="jum_detail" id="jum_detail" />
			</div>
			<br>
			<button id="createAll" onclick="createAll();" class="btn btn-success">Save</button>
		</div>
	</div>
</div>
