<script>
var combo_pkgtype;
var combo_hz = "<option value='N'>N</option><option value='Y'>Y</option>";
var combo_ds = "<option value='N'>N</option><option value='Y'>Y</option>";

$(document).ready(function() {
/* 			$( "#bl_numb" ).autocomplete({
			minLength: 5,
			source: function(request, response) {
				$.getJSON("<?=ROOT?>autocomplete/getBlNumb?",{  term: $( "#bl_numb" ).val(),ukk: $('#ukk').val(),
																			  port: $('#port').val()
																			 }, response);
				},
			focus: function( event, ui )
			{
				$( "#bl_numb" ).val( ui.item.BL_NUMBER);
				return false;
			},
			select: function( event, ui )
			{
				$( "#bl_numb" ).val( ui.item.BL_NUMBER);
				$( "#id_vvd" ).val( ui.item.ID_VVD);
				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item )
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'><p class='repo-language'>" + item.BL_NUMBER + "</p><p class='repo-name'>" +item.ID_VVD+"</p></a>")
			.appendTo( ul );
    }; */
	
	
	
	$.post("<?=ROOT?>om/booking/auto_whoryd",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
																		port: $('#port').val()
																	  },function(data){
		$("#wh_id").html(data);
	});
	
	$.post("<?=ROOT?>om/booking/auto_pkgtype",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',port: $('#port').val()
																	  },function(data){
		combo_pkgtype = data;																  
		$("#pkg_id").html(combo_pkgtype);
	});
	
	$('#hz').html(combo_hz);
	$('#ds').html(combo_ds);
	
	var d="<?=$svc_type;?>";
	var port=$('#port').val();
	
	if((d=='01') && (port=='91-201'))
	{
		$('#pol').append($('<option>', {
				value: 'IDBTN',
				text: 'IDBTN : Banten, Indonesia'
			}));
			
		$.post("<?=ROOT?>container_receiving/auto_pod_new",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
																		term: $( "#pod_autocomplete" ).val(),
																		vessel: $("#vessel_autocomplete").val(),
																		voyin: $("#voyage_in").val(),
																		voyout: $("#voyage_out").val(),
																		port: $('#port').val()
																	  },function(data){
			$("#comboPOD").html(data);
			$("#comboFPOD").html(data);															  
			$.post("<?=ROOT?>om/booking/auto_whoryd",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
																		port: $('#port').val()
																	  },function(data){
				$("#wh_id").html(data);
				load_detail();
			});
			
			
		});
	}
	else if((d=='02') && (port=='91-201'))
	{
		$('#comboPOD').append($('<option>', {
				value: 'IDBTN',
				text: 'IDBTN : Banten, Indonesia'
			}));
		
		$.post("<?=ROOT?>container_receiving/auto_pod_new",{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
																		term: $( "#pod_autocomplete" ).val(),
																		vessel: $("#vessel_autocomplete").val(),
																		voyin: $("#voyage_in").val(),
																		voyout: $("#voyage_out").val(),
																		port: $('#port').val()
																	  },function(data){
			$("#pol").html(data);
			$("#comboFPOD").html(data);
			load_detail();
		});
	}
	
	cargo_autocomplete('#cargo_name','#cargo_id', '#hs_code', '#ton_id', '#tonval', '#cubic', '#cubicval', '#qty', '#qtyval','#size','#type','#status');
	
});

function cargo_autocomplete(cgname_id, cgid_id, hs_id, ton_id, tonval_id, cubic_id, cubicval_id, qty_id, qtyval_id,size_id,type_id,status_id ){
		$( cgname_id ).autocomplete({
			minLength: 5,
			source: function(request, response) {
				$.getJSON("<?=ROOT?>autocomplete/getHsCode?",{  term: $( cgname_id ).val(),ukk: $('#ukk').val(),bl_numb: $('#bl_numb').val(),
																			mv_type: $('#mv_type').val(),
																			  port: $('#port').val()
																			 }, response);
				},
			focus: function( event, ui )
			{
				$( cgname_id ).val( ui.item.CARGO_NAME);
				return false;
			},
			select: function( event, ui )
			{
				$( cgname_id ).val( ui.item.CARGO_NAME);
				$( cgid_id ).val( ui.item.ID_CARGO);
				$( hs_id ).val( ui.item.HS_CODE);
				$( ton_id ).val( ui.item.WEIGHT);
				$( tonval_id ).val( ui.item.WEIGHT);
				$( cubic_id ).val( ui.item.VOLUME);
				$( cubicval_id ).val( ui.item.VOLUME);
				$( qty_id ).val( ui.item.QUANTITY);
				$( qtyval_id ).val( ui.item.QUANTITY);
				$( size_id ).val( ui.item.SIZE_);
				$( type_id ).val( ui.item.TYPE_);
				$( status_id ).val( ui.item.STATUS_);
				return false;
			}
		}).data( "uiAutocomplete" )._renderItem = function( ul, item )
		{
			return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a align='center'><p class='repo-language'>" + item.CARGO_NAME + "</p><p class='repo-name'>" +item.ID_CARGO_OM+"</p></a>")
			.appendTo( ul );
		};
		
		$( cgname_id )
}


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
		//startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

$('#start_date').datepicker({
		format: 'dd-mm-yyyy',
		//endDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

$('#end_date').datepicker({
		format: 'dd-mm-yyyy',
		//startDate: new Date(),
		todayBtn: true,
		todayHighlight: true
	});

function reset_field()
{
	 $('#hs_code').val('');
	 $('#cargo_id').val('');
	 $('#cargo_name').val('');
	 $('#qty').val('');
	 $('#ton').val('');
	 $('#cubic').val('');
	  $('#size').val('');
	   $('#type').val('');
	    $('#status').val('');
}

function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function cekDateStack()
{
	var from = $("#start_date").val();
	var to = $("#end_date").val();
	var f = toDate(from);
	var t = toDate(to);	
	var dayDiff = Math.round((t-f)/(1000*60*60*24));
	if(dayDiff<0)
	{
		alert("End Date tidak boleh kurang dari Start Date...!");
	}
}
	
function addrowToTable(tableid)
{
	
	if($('#cargo_name').val()=='')
	{
		alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
		return false;
	}
	else if($('#hs_code').val()=='')
	{
		alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
		return false;
	}
	else 	if($('#cargo_id').val()=='')
	{
		alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
		return false;
	}
	else if($('#pkg_id').val()=='')
	{
		alert('Package Harus Dipilih');
		return false;
	}
	else if($('#cubic').val()=='' && $('#ton').val()=='' && $('#qty').val()=='' )
	{
		alert('Jumlah Muatan atau Bongkaran Harus Diisi, Sesuaikan Dengan Tipe Package');
		return false;
	}

	var tbl = document.getElementById(tableid);
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
	el.value = $('#hs_code').val();
	el.readOnly = true;
	cell.appendChild(el);
	var el_hscode = el;
	
	cell = row.insertCell(1);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'cargo_id_' + iteration;
	el.id = 'cargo_id_' + iteration;
	el.className = 'cargo_id_class';
	el.size = 10;
	el.value = $('#cargo_id').val();
	el.readOnly = true;
	cell.appendChild(el);
	var el_cgid = el;
	
	cell = row.insertCell(2);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'cargo_name_' + iteration;
	el.id = 'cargo_name_' + iteration;
	el.className = 'cargo_name_class';
	el.value = $('#cargo_name').val();
	el.size = 15;
	cell.appendChild(el);
	var el_cgname = el;
	
	cell = row.insertCell(3);
	el = document.createElement('select');
	//el.type = 'text';
	el.name = 'pkg_id_' + iteration;
	el.id = 'pkg_id_' + iteration;
	el.className = 'pkg_class';
	el.innerHTML = combo_pkgtype;
	el.value = $('#pkg_id').val();
	//el.size = 10;
	cell.appendChild(el);
	
	cell = row.insertCell(4);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'qty_' + iteration;
	el.id = 'qty_' + iteration;
	el.className = 'qty_class';
	el.size = 10;
	el.value = $('#qty').val();
	cell.appendChild(el);
	var el_qty = el;
	
	cell = row.insertCell(5);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'ton_' + iteration;
	el.id = 'ton_' + iteration;
	el.className = 'ton_class';
	el.size = 10;
	el.value = $('#ton').val();
	cell.appendChild(el);
	var el_ton = el;
	
	cell = row.insertCell(6);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'cubic_' + iteration;
	el.id = 'cubic_' + iteration;
	el.className = 'cubic_class';
	el.size = 10;
	el.value = $('#cubic').val();
	cell.appendChild(el);
	var el_cubic = el;
	
	cell = row.insertCell(7);
	el = document.createElement('select');
	//el.type = 'text';
	el.name = 'hz_' + iteration;
	el.id = 'hz_' + iteration;
	el.className = 'hz_class';
	el.innerHTML = combo_hz
	el.value = $('#hz').val();
	cell.appendChild(el);
	
	cell = row.insertCell(8);
	el = document.createElement('select');
	//el.type = 'text';
	el.name = 'ds_' + iteration;
	el.id = 'ds_' + iteration;
	el.className = 'ds_class';
	el.innerHTML = combo_ds;
	el.value = $('#ds').val();
	cell.appendChild(el);
	
	cell = row.insertCell(9);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'tonval_' + iteration;
	el.id = 'tonval_' + iteration;
	el.className = 'tonval_class';
	el.size = 5;
	el.value = $('#tonval').val();
	cell.appendChild(el);
	var el_tonval = el;
	
	cell = row.insertCell(10);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'cubicval_' + iteration;
	el.id = 'cubicval_' + iteration;
	el.className = 'cubicval_class';
	el.size = 5;
	el.value = $('#cubicval').val();
	cell.appendChild(el);
	var el_cubicval = el;
	
	cell = row.insertCell(11);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'qtyval_' + iteration;
	el.id = 'qtyval_' + iteration;
	el.className = 'qtyval_class';
	el.size = 5;
	el.value = $('#qtyval').val();
	cell.appendChild(el);
	var el_qtyval = el;
	
	cell = row.insertCell(12);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'size_' + iteration;
	el.id = 'size_' + iteration;
	el.className = 'size_class';
	el.size = 5;
	el.value = $('#size').val();
	cell.appendChild(el);
	var el_size = el;
	
	cell = row.insertCell(13);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'type_' + iteration;
	el.id = 'type_' + iteration;
	el.className = 'type_class';
	el.size = 5;
	el.value = $('#type').val();
	cell.appendChild(el);
	var el_type = el;
	
	cell = row.insertCell(14);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'status_' + iteration;
	el.id = 'status_' + iteration;
	el.className = 'status_class';
	el.size = 5;
	el.value = $('#status').val();
	cell.appendChild(el);
	var el_status = el;
	
	cell = row.insertCell(15);
	el = document.createElement('input');
	el.type = 'button';
	el.value = 'delete';
	el.onclick = function() {removeRowIndex(this,tableid)};
	cell.appendChild(el);
	
	var x = tbl.rows;
	x[iteration].vAlign="top";
	
	document.getElementById('jum_detail').value = iteration;
	reset_field();
	
	cargo_autocomplete(el_cgname,el_cgid, el_hscode, el_ton, el_tonval, el_cubic, el_cubicval, el_qty, el_qtyval,size_id,type_id,status_id);

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
		hs_code = document.getElementById('hs_code' + indexnya);
		hs_code.id="hs_code"+index;
		hs_code.name="hs_code"+index;
		cargo_id_ = document.getElementById('cargo_id_' + indexnya);
		cargo_id_.id="cargo_id_"+index;
		cargo_id_.name="cargo_id_"+index;
		cargo_name_ = document.getElementById('cargo_name_' + indexnya);
		cargo_name_.id="cargo_name_"+index;
		cargo_name_.name="cargo_name_"+index;
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
		ds_.id="ds_"+index;
		ds_.name="ds_"+index;
		tonval = document.getElementById('tonval' + indexnya);
		tonval_.id="tonval_"+index;
		tonval_.name="tonval_"+index;			
		cubicval = document.getElementById('cubicval' + indexnya);
		cubicval.id="cubicval_"+index;
		cubicval.name="cubicval_"+index;
		qtyval = document.getElementById('qtyval' + indexnya);
		qtyval_.id="qtyval_"+index;
		qtyval_.name="qtyval_"+index;
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

function createAll()
{	
	var port=$('#port').val();
	var customer_id=$( "#customer_id" ).val();
	var customer_name=$( "#customer_name" ).val();
	
	var cargo_owner=$("#cargo_owner").val();
	var cargo_owner_id=$("#cargo_owner_id").val();
	
	var customer_add=$( "#customer_add" ).val();
	var customer_npwp=$( "#customer_npwp" ).val();
	var svc_type=$( "#svc_type" ).val();
	var ukk=$( "#ukk" ).val();
	var vessel_autocomplete=$( "#vessel_autocomplete" ).val();
	var voyage_in=$( "#voyage_in" ).val();
	var voyage_out=$( "#voyage_out" ).val();
	var do_numb=$( "#do_numb" ).val();
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
	
	if($('#bl_numb').val()=='')
	{
		alert('Field BL / MANIFEST / SI / PACKING LIST Number Harus Terisi');
		return false;
	}
	else if($('#bl_date').val()=='')
	{
		alert('Field BL / MANIFEST / SI / PACKING LIST Date Harus Terisi');
		return false;
	}
	else if($('#start_date').val()=='')
	{
		alert('Field Start Date Harus Terisi');
		return false;
	}
	else if($('#end_date').val()=='')
	{
		alert('Field End Date Harus Terisi');
		return false;
	}
	
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
	
	var tonval=[];
	tonval = $('.tonval_class').map( function(){return $(this).val(); }).get();
	
	var cubicval=[];
	cubicval = $('.cubicval_class').map( function(){return $(this).val(); }).get();
	
	var qtyval=[];
	qtyval = $('.qtyval_class').map( function(){return $(this).val(); }).get();
	
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
	else if(cargo_id=='')
	{
		alert('Field Cargo Name Harus Terisi dan Input Secara Autocomplete');
		return false;
	}
	else if(pkg_id=='')
	{
		alert('Package Harus Dipilih');
		return false;
	}

	else if(cubic=='' && ton=='' && qty=='' )
	{
		alert('Jumlah Muatan atau Bongkaran Harus Diisi, Sesuaikan Dengan Tipe Package');
		return false;
	}
	
/* 	alert (tonval);
	alert (ton);
	
	if ((Number(ton)) > (Number(tonval)))
		
		{
			
			alert('Berat Yang Diinput '+ton+' melebihi Berat Yang Sudah di Request '+ tonval);
			return true;
		}
		
	if (cubic > cubicval)
		
		{
			alert('Volume Yang Diinput melebihi Volume Yang Sudah di Request');
			return true;
		}
		
	if (qty > qtyval)
		
		{
			alert('Quantity Yang Diinput melebihi Quantity Yang Sudah di Request');
			return true;
		} */
		
	
	var tya="";
	if(svc_type=='01'){
		tya="E"
	} else if(svc_type=='02'){
		tya="I"
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
				MVT:mv_type,
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
				TTY:$('#trade_type').val(),
				BLN:$('#bl_numb').val(),
				BLD:$('#bl_date').val(),
				TYA:tya,
				PYC:'CH',
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

function pilihTrade()
{
	if($('#trade_type').val()=='I'){
		document.getElementById('og_attr').style.display = "none";
	}
	else if($('#trade_type').val()=='O'){
		document.getElementById('og_attr').style.display = "block";
	}
		
}

function pilih_move()
{
	if($('#mv_type').val()=='TL'){
		document.getElementById('wh_attr').style.display = "none";
	}
	else if($('#mv_type').val()=='YARD'){
		document.getElementById('wh_attr').style.display = "block";
	}
}
</script>
<div class="col-lg-12 ">
	<div class="main-box">
		<header class="main-box-header clearfix">
			<h2>Detail Booking</h2>
		</header>
		<div class="main-box-body clearfix">
			<?if($svc_type=='02'){?>
			<div class="form-group example-twitter-oss">
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">DO Number</label>
					<input type="text" class="form-control" id="do_numb" name="do_numb" title="DO Number" /> 
					<input type="hidden" class="form-control" id="ukk" name="ukk" title="DO Number" />
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">DO Date</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control" id="do_date" name="do_date" title="DO Date" /> 
					</div>
				</div>
			</div>
			<?}?>
			<div class="form-group" >
				<label>Trade Type</label>
				<select id="trade_type" name="trade_type" class="form-control" style="width:514px;" onclick="pilihTrade()">
					<option value="O">OCEANGOING</option>
					<option value="I">INTERSULER</option>
				</select>
			</div>
			<div class="form-group example-twitter-oss" id="og_attr">
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">SPPB / PE (NPE)</label>
					<input type="text" class="form-control" id="sppb_npe" name="sppb_npe"  /> 
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">SPPB / PE (NPE) Date</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control" id="sppb_npe_date" name="sppb_npe_date" /> 
					</div>
				</div>
			</div>
			<div class="form-group example-twitter-oss">
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">BL / MANIFEST / SI / PACKING LIST NUMBER</label>
					<input type="text" class="form-control" id="bl_numb" name="bl_numb" title="BL Number" /> 
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">BL / MANIFEST / SI / PACKING LIST DATE</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control" id="bl_date" name="bl_date" title="BL Date" /> 
					</div>
				</div>
			</div>
			<div class="form-group example-twitter-oss">
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">POL</label>
					<select class="form-control" id="pol" name="pol" title="Port Of Loading"/> </select>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">POD</label>
					<select id="comboPOD" name="comboPOD" class="form-control" style="width:514px;"></select>
				</div>
			</div>
			<div class="form-group example-twitter-oss">				
				<div class="form-group col-xs-6">
					&nbsp;
					<!--
					<label for="exampleAutocomplete">POR</label>
					<select id="comboFPOD" name="comboFPOD" class="form-control" style="width:514px;"></select>
					-->
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">Start Date</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control" id="start_date" name="start_date" title="Start Date" /> 
					</div>
				</div>
			</div>
			
			<div class="form-group example-twitter-oss">
				<div class="form-group col-xs-6">
					<label>Movement Type</label>
					<select id="mv_type" name="mv_type" class="form-control" style="width:514px;" onclick="pilih_move()">
						<option value="YARD">Yard</option>
						<option value="TL">TL</option>
					</select>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleAutocomplete">End Date</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control" id="end_date" name="end_date" title="End Date" onChange="cekDateStack()" /> 
					</div>
				</div>
			</div>
			
			<div class="form-group" id="wh_attr">
				<label>Warehouse / Yard</label>
					<select id="wh_id" name="wh_id" class="form-control" ></select> 
			</div>
			
			<div class="form-group" >
				&nbsp;<input type="hidden" name="jum_detail" id="jum_detail" />
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id='list_cargo_table' style='font-size:12px;'>
					<thead>
						<tr>
							<th><span>HS Code</span></a></th>
							<th><span>Cargo ID</span></a></th>
							<th><span>Cargo Name</span></a></th>
							<th><span>Package Name</span></a></th>
							<th><span>Qty</span></a></th>
						
							<th><span>Ton</span></a></th>
							<th><span>Cubic</span></a></th>
							<th><span>Hz</span></a></th>
							<th><span>Ds</span></a></th>
							<th><span>Action</span></a></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="text" id="hs_code" name="hs_code" value="" readonly  class="form-control" />
								<input type="hidden" id="ukk" name="ukk" value="" readonly  class="form-control" />
							</td>
							<td>
								<input type="text" id="cargo_id" name="cargo_id" value="" readonly  class="form-control" />
							</td>
							<td>
								<input type="text" id="cargo_name" name="cargo_name" value=""  class="form-control" />
							</td>
							<td><select id="pkg_id" name="pkg_id" class="form-control"></select></td>
							<td><input type="text" id="qty" name="qty" value="" class="form-control" /></td>
							<td><input type="text" id="ton" name="ton" value="" class="form-control"/></td>
							<td><input type="text" id="cubic" name="cubic" value="" class="form-control" /></td>
							<td><select id="hz" name="hz" class="form-control" style="width:70px;"></select></td>
							<td><select id="ds" name="ds" class="form-control" style="width:70px;"></select></td>
							<td>
							<input type="hidden" id="tonval" name="tonval" value="" class="form-control" />
							<input type="hidden" id="cubicval" name="cubicval" value="" class="form-control" />
							<input type="hidden" id="qtyval" name="qtyval" value="" class="form-control" />
							<input type="hidden" id="size" name="size" value="" class="form-control" />
							<input type="hidden" id="type" name="type" value="" class="form-control" />
							<input type="hidden" id="status" name="status" value="" class="form-control" />
							
								<a class="link-button" onclick="addrowToTable('list_cargo_table')">
									<img border="0" src="<?=IMAGES_?>add_content.png" />
								</a>
								<!--<a class="link-button" onclick="addrowToTable('list_cargo_table')">
									<img border="0" src="<?=IMAGES_?>del_content.png" />
								</a>-->
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
			<button id="createAll" onclick="createAll();" class="btn btn-success">Save</button>
		</div>
	</div>
</div>
<input type="hidden" id="temp_auto_cargo">
