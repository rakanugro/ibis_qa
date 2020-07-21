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

    <!-- global scripts -->
<script src="<?=JSQ?>jquery-ui.min.js"></script>

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

input[type=radio] {
    vertical-align: middle;
    width: 17px;
    height: 17px;
}

</style>

<script>
</script>
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
				</header>
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-6">
						<label>PBM / EMKL</label>
						<input name="DEL_CARGO_PBM_NAME" id="DEL_CARGO_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input name="DEL_CARGO_PBM_ID" id="DEL_CARGO_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Nomor Request</label>
						<input name="DEL_CARGO_NO" id="DEL_CARGO_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
						<input name="DEL_CARGO_ID" id="DEL_CARGO_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>To</label>
						<select id="DEL_CARGO_TO" name="DEL_CARGO_TO" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose To  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Payment Method</label>
						<select id="DEL_CARGO_PAYMETHOD" name="DEL_CARGO_PAYMETHOD" class="form-control" disabled>
							<option value="not-selected"> -- Please Choose Payment Method  -- </option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="datepickerDate">Date</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="DEL_CARGO_DATE" name="DEL_CARGO_DATE" type="text" class="form-control" value="<?=date('Y-m-d')?>" disabled readOnly>
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label>Penumpukan Oleh</label>
						<input name="DEL_CARGO_STACKBY_NAME" id="DEL_CARGO_STACKBY_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input name="DEL_CARGO_STACKBY_ID" id="DEL_CARGO_STACKBY_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Data Kapal</b></h2>
				</header>
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-6">
						<label>Vessel</label>
						<input name="DEL_CARGO_VESSEL_NAME" id="DEL_CARGO_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
						<input type="hidden" id="DEL_CARGO_VESSEL_CODE" class="form-control" name="DEL_CARGO_VESSEL_CODE" required>
						<input type="hidden" id="DEL_VESSEL" class="form-control" name="DEL_VESSEL" required>
					</div>
					<div class="form-group col-xs-6">
						<label>Nama Agen</label>
						<input name="DEL_CARGO_VESSEL_AGENT" id="DEL_CARGO_VESSEL_AGENT" type="text" class="form-control" readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>No PKK</label>
						<input name="DEL_CARGO_VESSEL_PKK" id="DEL_CARGO_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" disabled readonly="">
						<input name="DEL_CARGO_VVD_ID" id="DEL_CARGO_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" disabled readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage In</label>
						<input name="DEL_CARGO_VOYIN" id="DEL_CARGO_VOYIN" type="text" class="form-control" placeholder="Voyage In" disabled readonly="">
					</div>
					<div class="form-group col-xs-4">
						<label>Voyage Out</label>
						<input name="DEL_CARGO_VOYOUT" id="DEL_CARGO_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" disabled readonly="">
					</div>
					<div class="form-group col-xs-6">
						<label>ETA</label>
						<input name="DEL_CARGO_VESSEL_ETA" id="DEL_CARGO_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
					</div>
					<div class="form-group col-xs-6">
						<label>ETD</label>
						<input name="DEL_CARGO_VESSEL_ETD" id="DEL_CARGO_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 ">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Dokumen</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<table id="myTable" class="table order-list list_file">
						<tr>
							
						</tr>
					</table>
				
					<div class="form-group example-twitter-oss pull-right">
			        </div>
				</div>
			</div>
		</div>
	</div>

<div class="hidden_content" id='show-detail'>
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail</b></h2>
				</header>
				<input id="DTL_ID" name="DTL_ID" type="hidden" class="form-control">
				<div class="main-box-body clearfix">

					<table class="table table-striped table-hover" id="detail-list">
						<thead>
							<tr>
								<th>Cargo Owner</th>
								<th>BL/SI/DO</th>
								<th>Jumlah</th>
								<th>Sifat</th>
								<th>Kemasan</th>
								<th>Barang</th>
								<th>Satuan</th>
								<th>Delivery Via</th>
								<th>Stacking Area</th>
								<th>Tanggal Receiving</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>	
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
						<button id="submit_header" class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Back</button>			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
	var counterdoc = 0;
	counterdetail = 0;
	var apiUrl = "http://10.88.48.33/api/public/";

	$(document).ready(function() {
		
		$('#date').datepicker({
			format: 'dd-mm-yyyy'
		});

		$('#REC_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});

		//ADD_FILE
		$("#add_file").on("click", function () {
			var record = <?php echo json_encode($docType); ?>;

			counterdoc++;

		    var newRow = $("<tr>");
		    var cols = "";

			var no_req = $('#REC_NO').val();

		    cols += '';

		    cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE'+counterdoc+'" name="DOC_TYPE'+counterdoc+'" class="form-control"><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

		    cols += '<div class="col-xs-4"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40"></div>';

		    cols += '<div class="col-xs-4"><label>Upload Dokumen</label><input type="file" accept=".pdf" name="DOC_NAME'+counterdoc+'" id="DOC_NAME'+counterdoc+'" doc_name="" data-toggle="tooltip" data-placement="bottom" size="100" onchange="encodedoc('+counterdoc+')"></div>';

			cols +=	'<input type="hidden" id="DOC_PATH'+counterdoc+'" name="DOC_PATH'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols +=	'<input type="hidden" id="DOC_BASH'+counterdoc+'" name="DOC_BASH'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols +=	'<input type="hidden" id="DOC_ID'+counterdoc+'" name="DOC_ID'+counterdoc+'" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">';

			cols += '<br/><div class="form-group col-xs-1"><a class="ibtnDel btn btn-primary" id="add_file"><span class="glyphicon glyphicon-minus"></span></a><div>';
		    
		    newRow.append(cols);

			$(".list_file").append(newRow);

			var toAppend = '';
			for(var i=0;i<record.length;i++){
				toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
			}
			$('#DOC_TYPE'+counterdoc).append(toAppend);

		});

		$("table.list_file").on("click", ".ibtnDel", function (event) {
		        $(this).closest("tr").remove();       
		        counterdoc--;
		});

		$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
			counterdetail--;
			$(this).closest("tr").remove();       
		});

		$("#btn-show").click(function(){
	    	$('#show-detail').removeClass('hidden_content');
	  	});

		//PBM
		$('#DEL_CARGO_PBM_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/pbm/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				console.log(ui);
				$('#DEL_CARGO_PBM_NAME').val(ui.item.label);
				$('#DEL_CARGO_PBM_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//stackby
		$('#DEL_CARGO_STACKBY_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/stackby/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				console.log(ui);
				$('#DEL_CARGO_STACKBY_NAME').val(ui.item.label);
				$('#DEL_CARGO_STACKBY_ID').val(ui.item.pbm_id);
				
				return false;
			}
		});

		//from
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/from",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#DEL_CARGO_TO').append(toAppend);
			}
		});

		//payment method
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/paymethod",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_order']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#DEL_CARGO_PAYMETHOD').append(toAppend);
			}
		});

		//vessel
		$('#DEL_CARGO_VESSEL_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/vessel/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#DEL_CARGO_VESSEL_NAME').val(ui.item.label);
				$('#DEL_CARGO_VESSEL_CODE').val(ui.item.vesselCode);
				$('#DEL_CARGO_VOYIN').val(ui.item.voyageIn);
				$('#DEL_CARGO_VOYOUT').val(ui.item.voyageOut);
				$('#DEL_CARGO_VESSEL_PKK').val(ui.item.idUkkSimop);
				$('#DEL_CARGO_VVD_ID').val(ui.item.idUkkSimop);
				$('#DEL_VESSEL').val(ui.item.name);
				return false;
			}
		});

		//customer
		$('#CARGO_DTL_OWNER_NAME').autocomplete({
			source: function( request, response ) {
				console.log(request);
				$.ajax({
					url: "<?=ROOT?>npksbilling/mdm/customer/"+ request.term,
					type: 'GET',
					dataType: 'json',
					success: function( data ) {
						response( data );
					}
				});
			},
			select: function (event, ui) {
				$('#CARGO_DTL_OWNER_NAME').val(ui.item.label);
				$('#CARGO_DTL_OWNER').val(ui.item.customer_id);
				return false;
			}
		});

		//sifat
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/sifat_cargo",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['character_id']+'">'+record[i]['character_name']+'</option>';
				}
				
				$('#CARGO_DTL_CHARACTER_ID').append(toAppend);
			}
		});

		//kemasan
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/kemasan_cargo",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['package_id']+'">'+record[i]['package_name']+'</option>';
				}
				
				$('#CARGO_DTL_PKG_ID').append(toAppend);
			}
		});

		//barang
		$('#CARGO_DTL_PKG_ID').on('change', function() {
			var val = this.value;
			$.ajax({
				type: "GET",
				url: "<?=ROOT?>npksbilling/mdm/barang_cargo/"+ val,
				success: function(data){
					if(!data){
						return false;
					}
					var obj = JSON.parse(data);
					var record = obj['result'];
					var toAppend = '';
					for(var i=0;i<record.length;i++){
						toAppend += '<option pgkid="'+record[i]['package_id']+'" value="'+record[i]['commodity_id']+'">'+record[i]['commodity_name']+'</option>';
					}
					$('#CARGO_DTL_CMDTY_ID').find('option').remove().end().append('<option value="not-selected"> -- Please Choose Barang  -- </option>');
					$('#CARGO_DTL_CMDTY_ID').append(toAppend);
				}
			});
		});

		//barang tmp
		$('#CARGO_DTL_PKG_ID').on('change', function() {
			var DTL_PKG_ID = $(this).val();
			$('#CARGO_DTL_PKG_TMP').val(DTL_PKG_ID);
		});

		$('#CARGO_DTL_CMDTY_ID').on('change', function() {
			var DTL_CMDTY_ID = $(this).val();
			var parent_id =  $(this).find('option:selected').attr('pgkid');
			$('#CARGO_DTL_PKG_TMP').val(parent_id);
		});

		//satuan
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/satuan_cargo",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['unit_id']+'">'+record[i]['unit_name']+'</option>';
				}
				
				$('#CARGO_DTL_UNIT_ID').append(toAppend);
			}
		});

		//via
		$.ajax({
		    type: "GET",
		   	url: "<?=ROOT?>npksbilling/mdm/via",
			success: function(data){
				var obj = JSON.parse(data);
				var record = obj['result'];
		
				var toAppend = '';
				for(var i=0;i<record.length;i++){
					toAppend += '<option value="'+record[i]['reff_id']+'">'+record[i]['reff_name']+'</option>';
				}
				
				$('#CARGO_DTL_VIA').append(toAppend);
			}
		});

	});

	//encode file
	function encodedoc (counterdoc){
		var inputf = document.getElementById('DOC_NAME'+counterdoc).files[0];
		if (inputf != null) {
			var reader = new FileReader();
			reader.readAsArrayBuffer(inputf);
			reader.onloadend = function (oFREvent) {
				var byteArray = new Uint8Array(oFREvent.target.result);
				var file = (new Uint8Array(oFREvent.target.result)).subarray(0, 4); 
				var len = byteArray.byteLength;
				var binary = '';
				for (var i = 0; i < len; i++) {
					binary += String.fromCharCode(byteArray[i]);
				}
				byteArray = window.btoa(binary);
				var path = inputf.name;
				$("#DOC_PATH"+counterdoc).val(path);
				$("#DOC_NAME"+counterdoc).attr("doc_name", path);
				$("#DOC_BASH"+counterdoc).val(byteArray);

				var code = "";
				for (var i = 0; i < file.length; i++) {
					code += file[i].toString(16);
				}

				if(code){
					switch (code) {
						case '89504e47':
							return 'image/png'
						case '25504446':

						case "ffd8ffe0":
						case "ffd8ffe1":
						case "ffd8ffe2":
							return 'image/jpeg'
						default:
							alert('File harus PDF');
							$('#DOC_NAME'+counterdoc).val('');
							$("#btn-show").prop('disabled', true);
					}
				}
			}
		}
	}

	function goBack() {
		window.history.back();
	}

	//getdata
	var id_del = "<?=$id?>";
	if(id_del != ""){
		$.blockUI();
		$.ajax({
			url: "<?=ROOT?>npksbilling/deliverybarang/update_receivingBarang/"+id_del,
			type: 'GET',
			dataType: 'json',
			success: function( data ) {
				console.log(data);
				if(data.HEADER != ""){
					$.unblockUI();
					arrData = data;
					arrData.HEADER.forEach(function(item, index){
						$("#DEL_CARGO_ID").val(item.del_cargo_id);
						$("#DEL_CARGO_NO").val(item.del_cargo_no);
						$("#DEL_CARGO_DATE").val(item.del_cargo_date);
						$("#DEL_CARGO_PAYMETHOD").val(item.del_cargo_paymethod);
						$("#DEL_CARGO_CUST_ID").val(item.del_cargo_cust_id);
						$("#DEL_CARGO_CUST_NAME").val(item.del_cargo_cust_name);
						$("#DEL_CARGO_CUST_ADDRESS").val(item.del_cargo_cust_address);
						$("#DEL_CARGO_CUST_NPWP").val(item.del_cargo_cust_npwp);
						$("#DEL_CARGO_CUST_ACCOUNT").val(item.del_cargo_cust_account);
						$("#DEL_CARGO_STACKBY_ID").val(item.del_cargo_stackby_id);
						$("#DEL_CARGO_STACKBY_NAME").val(item.del_cargo_stackby_name);
						$("#DEL_CARGO_VESSEL_CODE").val(item.del_cargo_vessel_code);
						$("#DEL_CARGO_VESSEL_NAME").val(item.del_cargo_vessel_name);
						$("#DEL_CARGO_VOYIN").val(item.del_cargo_voyin);
						$("#DEL_CARGO_VOYOUT").val(item.del_cargo_voyout);
						$("#DEL_CARGO_VVD_ID").val(item.del_cargo_vvd_id);
						$("#DEL_CARGO_VESSEL_ETA").val(item.del_cargo_vessel_eta);
						$("#DEL_CARGO_VESSEL_ETD").val(item.del_cargo_vessel_etd);
						$("#DEL_CARGO_BRANCH_ID").val(4);
						$("#DEL_CARGO_NOTA").val(item.del_cargo_nota);
						//$("#DEL_CARGO_CO").val(item.del_cargo_corDEL_CARGOtion);
						//$("#DEL_CARGO_NO").val(item.del_cargo_corDEL_CARGOtion_date);
						//$("#DEL_CARGO_NO").val(item.del_cargo_print_card);
						$("#DEL_CARGO_TO").val(item.del_cargo_to);
						$("#DEL_CARGO_CREATE_BY").val(item.del_cargo_create_by);
						//$("#DEL_CARGO_CREATE_DATE").val(item.del_cargo_create_date);
						//$("#DEL_CARGO_NO").val(item.del_cargo_bl);
						//$("#DEL_CARGO_NO").val(item.del_cargo_do);
						$("#DEL_CARGO_STATUS").val(1);
						$("#DEL_CARGO_VESSEL_AGENT").val(item.del_cargo_vessel_agent);
						$("#DEL_CARGO_VESSEL_AGENT_NAME").val(item.del_cargo_vessel_agent_name);
						$("#DEL_CARGO_BRANCH_CODE").val(item.del_cargo_branch_code);
						$("#DEL_CARGO_PBM_ID").val(item.del_cargo_pbm_id);
						$("#DEL_CARGO_PBM_NAME").val(item.del_cargo_pbm_name);
						$("#DEL_CARGO_VESSEL_PKK").val(item.del_cargo_vessel_pkk);
					});

					$('#show-detail').removeClass('hidden_content');
					arrData.DETAIL.forEach(function(detail, index){
						var owner_name = (detail.del_cargo_dtl_owner_name)? detail.del_cargo_dtl_owner_name : "";
						var owner_id = (detail.del_cargo_dtl_owner)? detail.del_cargo_dtl_owner : "";
						var no_bl = (detail.del_cargo_dtl_si_no)? detail.del_cargo_dtl_si_no : "";
						var jumlah = (detail.del_cargo_dtl_qty)? detail.del_cargo_dtl_qty : "";
						var sifat_id = (detail.del_cargo_dtl_character_id)? detail.del_cargo_dtl_character_id : "";
						var sifat_name = (detail.del_cargo_dtl_character_name)? detail.del_cargo_dtl_character_name : "";
						var kemasan_pkg_id = (detail.del_cargo_dtl_pkg_parent_id)? detail.del_cargo_dtl_pkg_parent_id : "";
						var kemasan_id = (detail.del_cargo_dtl_pkg_id)? detail.del_cargo_dtl_pkg_id : "";
						var kemasan_name = (detail.del_cargo_dtl_pkg_name)? detail.del_cargo_dtl_pkg_name : "";
						var barang_id = (detail.del_cargo_dtl_cmdty_id)? detail.del_cargo_dtl_cmdty_id : "";
						var barang_name = (detail.del_cargo_dtl_cmdty_name)? detail.del_cargo_dtl_cmdty_name : "";
						var satuan_id = (detail.del_cargo_dtl_unit_id)? detail.del_cargo_dtl_unit_id : "";
						var satuan_name = (detail.del_cargo_dtl_unit_name)? detail.del_cargo_dtl_unit_name : "";
						var via_id = (detail.del_cargo_dtl_via)? detail.del_cargo_dtl_via : "";
						var via_name = (detail.del_cargo_dtl_via_name)? detail.del_cargo_dtl_via_name : "";
						var tanggal_del = (detail.del_cargo_dtl_del_date)? detail.del_cargo_dtl_del_date : "";
						var stacking_id = (detail.del_cargo_dtl_stack_area)? detail.del_cargo_dtl_stack_area : "";
						var stacking_name = (detail.del_cargo_dtl_stack_area_name)? detail.del_cargo_dtl_stack_area_name : "";
						var del_dtl_id = (detail.del_cargo_dtl_id)? detail.del_cargo_dtl_id : "";
						var del_hdr_id = (detail.del_cargo_hdr_id)? detail.del_cargo_hdr_id : "";

						$('#detail-list tbody').append(
							'<tr>' +
								'<td style="display: none;" class="tbl_cargo_dtl_id">'+ del_dtl_id +'</td>' +
								'<td style="display: none;" class="tbl_cargo_dtl_hdr_id">'+ del_hdr_id +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_owner_id">'+ owner_id +'</td>' +
								'<td class="tbl_cargo_dtl_owner_name">'+ owner_name +'</td>' +

								'<td class="tbl_cargo_dtl_bl">'+ no_bl +'</td>' +

								'<td class="tbl_cargo_dtl_qty">'+jumlah +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_character_id">'+ sifat_id +'</td>' +
								'<td class="tbl_cargo_dtl_character_name">'+ sifat_name +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_pkg_id">'+ kemasan_id +'</td>' +
								'<td class="tbl_cargo_dtl_pkg_name">'+ kemasan_name +'</td>' +
								'<td style="display: none;" class="tbl_cargo_dtl_pkg_parent_id">'+ kemasan_pkg_id +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_cmdty_id">'+ barang_id +'</td>' +
								'<td class="tbl_cargo_dtl_cmdty_name">'+ barang_name +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_unit_id">'+ satuan_id +'</td>' +
								'<td class="tbl_cargo_dtl_unit_name">'+ satuan_name +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_via_id">'+ via_id +'</td>' +
								'<td class="tbl_cargo_dtl_via_name">'+ via_name +'</td>' +

								'<td style="display: none;" class="tbl_cargo_dtl_stack_area">'+ stacking_id +'</td>' +
								'<td class="tbl_cargo_dtl_stack_area_name">'+ stacking_name +'</td>' +

								'<td class="tbl_cargo_dtl_del_date">'+ tanggal_del +'</td>' +
							'</tr>'
						);
					});

					var record = <?php echo json_encode($docType); ?>;
					data.FILE.forEach(function(file, index){
						if (data.FILE.length != 0) {

							counterdoc++;
							var newRow = $("<tr>");
							var cols = "";						

							cols += '';
							cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE'+counterdoc+'" name="DOC_TYPE'+counterdoc+'" class="form-control" maxlength="40" disabled><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

							cols += '<div class="col-xs-4"><label>Nomor Dokumen</label><input id="DOC_NO'+counterdoc+'" name="DOC_NO'+counterdoc+'" value="'+file.doc_no+'" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40" disabled></div>';

							cols += '<div class="col-xs-5"><label>Nama File</label></div><div class="col-xs-5"><a href="'+apiUrl+file.doc_path+'" target="_blank">'+file.doc_name+'</a></div>';


							newRow.append(cols);

							$(".list_file").append(newRow);

							var toAppend = '';
							for(var i=0;i<record.length;i++){
								var isSelect = (record[i]['reff_id'] == file.doc_type) ? 'selected' : '';
								toAppend += '<option value="'+record[i]['reff_id']+'" '+ isSelect +'>'+record[i]['reff_name']+'</option>';
							}
							$('#DOC_TYPE'+counterdoc).append(toAppend);
						}
					});

				}
			}
		});
	}

</script>
