<script>
function addrowToTableEquipment(tableid){
	var tbl = document.getElementById(tableid);
	var lastRow = tbl.rows.length;
	var iteration = lastRow;
	var row = tbl.insertRow(lastRow);
	
	var cell = row.insertCell(0);
	var el = document.createElement('select');
	el.name = 'equipment';
	el.id = 'equipment_' + iteration;
	el.className = 'tablebased';
	cell.appendChild(el);

	//Create and append the options
	for (var i = 0; i < list_equipment.length; i++) {
		var option = document.createElement("option");
		if (list_equipment[i].ID_PORT==selected_id_port){
			option.value = list_equipment[i].EQ_CODE;
			option.text = list_equipment[i].EQ_NAME;
			el.appendChild(option);
		}
	}
	
	cell = row.insertCell(1);
	el = document.createElement('select');
	el.name = 'unit';
	el.id = 'unit_' + iteration;
	el.className = 'tablebased';
	cell.appendChild(el);
	var option = document.createElement("option");
	option.value = "JAM";
	option.text = "JAM";
	el.appendChild(option);
	option = document.createElement("option");
	option.value = "SHIFT";
	option.text = "SHIFT";
	el.appendChild(option);
	option = document.createElement("option");
	option.value = "TON";
	option.text = "TON";
	el.appendChild(option);
	option = document.createElement("option");
	option.value = "M3";
	option.text = "M3";
	el.appendChild(option);
	option = document.createElement("option");
	option.value = "QTY";
	option.text = "QTY";
	el.appendChild(option);
	
	cell = row.insertCell(2);
	el = document.createElement('input');
	el.type = 'text';
	el.name = 'util';
	el.id = 'util_' + iteration;
	el.className = 'tablebased';
	cell.appendChild(el);
	
	cell = row.insertCell(3);
	el = document.createElement('input');
	el.type = 'button';
	el.value = 'delete';
	el.onclick = function() {removeRowIndexEquipment(this,tableid)};
	cell.appendChild(el);
}

function removeRowIndexEquipment(obj,tableid){
	var par=obj.parentNode;
	while(par.nodeName.toLowerCase()!='tr'){
		par=par.parentNode;
	}
	var index = par.rowIndex;
	
	var tbl = document.getElementById(tableid);
	var lastRow = tbl.rows.length;
	tbl.deleteRow(index);
}

function saveRealisasi(id_request){
	// alert(id_request);
	var r = confirm("Are you sure to confirm?");
	if (r == true) {
		alert("You will confirm this request");
		$.blockUI();
		var url = "<?=ROOT?>om/stevedoringmanagement/save_realisasi";
		var formdata_detail = {};
		var bl_number = [];
		$("input[name='bl_number']").each(function() {
			bl_number.push($(this).val());
		});
		var id_cargo = [];
		$("input[name='id_cargo']").each(function() {
			id_cargo.push($(this).val());
		});
		var e_i = [];
		$("input[name='e_i']").each(function() {
			e_i.push($(this).val());
		});
		var dtl_no = [];
		$("input[name='dtl_no']").each(function() {
			dtl_no.push($(this).val());
		});
		var detail_qty = [];
		$("input[name='detail_qty']").each(function() {
			detail_qty.push($(this).val());
		});
		var detail_ton = [];
		$("input[name='detail_ton']").each(function() {
			detail_ton.push($(this).val());
		});
		var detail_cbc = [];
		$("input[name='detail_cbc']").each(function() {
			detail_cbc.push($(this).val());
		});
		formdata_detail.bl_number = bl_number;
		formdata_detail.id_cargo = id_cargo;
		formdata_detail.e_i = e_i;
		formdata_detail.dtl_no = dtl_no;
		formdata_detail.detail_qty = detail_qty;
		formdata_detail.detail_ton = detail_ton;
		formdata_detail.detail_cbc = detail_cbc;
		
		var formdata_equipment = {};
		var equipment_code = [];
		var equipment_name = [];
		$("select[name='equipment']").each(function() {
			equipment_code.push($(this).val());
			equipment_name.push($(this).find('option:selected').text());
		});
		var unit = [];
		$("select[name='unit']").each(function() {
			unit.push($(this).find('option:selected').val());
		});
		var util = [];
		$("input[name='util']").each(function() {
			util.push($(this).val());
		});
		formdata_equipment.equipment_code = equipment_code;
		formdata_equipment.equipment_name = equipment_name;
		formdata_equipment.unit = unit;
		formdata_equipment.util = util;
		var param = {
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			id_request: id_request,
			detail_count: formdata_detail.id_cargo.length,
			detail: formdata_detail,
			equipment_count: formdata_equipment.equipment_code.length,
			equipment: formdata_equipment
		};
		// $.extend(param, formdata_detail, formdata_equipment);
		$.post(url, param, function(data){
			$.unblockUI();
			alert(data);
			$('#dialogViewReq').dialog('close');
		});
	}
}
</script>
<style>
.tablebase
{
	font-size: 13px;
}
.tablebased
{
	font-size: 11px;
	border-color:#e84e40;
	text-align:center;
}
.headtb
{
	background-color:#e84e40;
	color : white;
	text-align:center;
}
</style>
<table class="tablebase">
<tr>
	<td>Request Number</td>
	<td>: <?=$id_request;?></td>
</tr>
<tr>
	<td>Customer</td>
	<td>: <?=$row_header['CUST_NAME'];?></td>
</tr>
<tr>
	<td></td>
	<td>&nbsp;<?=$row_header['CUST_ADDR'];?></td>
</tr>
<tr>
	<td>Vessel ( voy )</td>
	<td>: <?=$row_header['VESVOY'];?> </td>
</tr>
</table>
<br/>
<p class="tablebase"><b>Data Detail</b></p>
<table border=1 class="tablebased" id="detail_request">
<tr>
	<td class="headtb" width="150">BL Number</td>
	<td class="headtb" width="150">Cargo Name</td>
	<td class="headtb" width="100">Package Name</td>
	<td class="headtb" width="80">Qty</td>
	<td class="headtb" width="80">Ton</td>
	<td class="headtb" width="80">Cubic</td>
	<td class="headtb" width="80">Hz</td>
	<td class="headtb" width="80">EI</td>
	<td class="headtb" width="80">OI</td>
	<td class="headtb" width="80">TL</td>
	<!--<td class="headtb" width="200">Action</td>-->
</tr>
<? 
$i=1;
foreach($row_detail as $rowd){
?>
<tr>
	<input name="bl_number" type="hidden" value="<?=$rowd->BL_NUMBER;?>"/>
	<input name="id_cargo" type="hidden" value="<?=$rowd->ID_CARGO;?>"/>
	<input name="e_i" type="hidden" value="<?=$rowd->E_I;?>"/>
	<input name="dtl_no" type="hidden" value="<?=$rowd->DTL_NO;?>"/>
	<td class="tablebased"><?=$rowd->BL_NUMBER;?></td>
	<td class="tablebased"><?=$rowd->CARGO_NAME;?></td>
	<td class="tablebased"><?=$rowd->PKG_NAME;?></td>
	<td class="tablebased">
		<input id="detail_qty_<?=$rowd->DTL_NO?>" name="detail_qty" type="text" size="5" value="<?=$rowd->QTY;?>"/>
	</td>
	<td class="tablebased">
		<input id="detail_ton_<?=$rowd->DTL_NO?>" name="detail_ton" type="text" size="5" value="<?=$rowd->TON;?>"/>
	</td>
	<td class="tablebased">
		<input id="detail_cbc_<?=$rowd->DTL_NO?>" name="detail_cbc" type="text" size="5" value="<?=$rowd->CUBIC;?>"/>
	</td>
	<td class="tablebased"><?=$rowd->HZ;?></td>
	<td class="tablebased"><?=$rowd->E_I;?></td>
	<td class="tablebased"><?=$rowd->OI;?></td>
	<td class="tablebased"><?=$rowd->TL_FLAG;?></td>
	<!--<td class="tablebased"><? echo '<a class=\'btn btn-success\' onclick=\'clickConfirm("update_realisasi", "'.$id_request.'", "'.$rowd->DTL_NO.'");\' title="Update"><i class="fa fa-pencil-square-o" ></i></a>' ?></td>-->
</tr>
<?
	$i++;
}
?>
</table>
<br/>
<p class="tablebase"><b>Data Alat</b></p>
<a onclick="addrowToTableEquipment('detail_alat')" title="Add">
	<img border="0" src="<?=IMAGES_?>add_content.png" />
</a>
<table border=1 class="tablebased" id="detail_alat">
<tr>
	<td class="headtb" width="200">Equipment</td>
	<td class="headtb" width="50">Unit</td>
	<td class="headtb" width="200">Utilization</td>
	<td class="headtb" width="100"></td>
</tr>
</table>
<br/>
<a class='btn btn-success' onclick="saveRealisasi('<?=$id_request?>')" title='Save'>
	<i class='fa fa-floppy-o'> Save</i>
</a>
<br/>
<table class="tablebase">
<br/>
<tr>
	<td>History:</td>
</tr>
<?foreach($row_history as $rowd){?>
<tr>
	<td><?=$rowd['HISTORY'];?></td>
</tr>
<?}?>
</table>