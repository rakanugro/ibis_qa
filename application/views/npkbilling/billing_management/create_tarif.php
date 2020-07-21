<style type="text/css">
	.hidden_content { display: none; }
</style>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>Simulasi Tariff</b></h2>
				</header>
				
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-12">
						<label>Booking Type</label>				
						<select id="BOOKING_TYPE" name="BOOKING_TYPE" class="form-control">
							<option value="not-selected"> -- Please Choose Booking Type -- </option>
							<?php foreach($booking_type as $boty){ ?>
								<option value="<?=$boty->nota_id?>"><?=$boty->nota_name?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="booking-type-selected" class="hidden_content">

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>Header</b></h2>
					</header>
					
					<div class="main-box-body clearfix">
						<div class="form-group col-xs-6">
							<label>Terminal</label>
							<select id="TERMINAL_ID" name="TERMINAL_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Terminal  -- </option>
							</select>
						</div>
						<div class="form-group col-xs-6">
							<label>Tipe Perdagangan</label>
							<select name="TRADE_TYPE" id="TRADE_TYPE" class="form-control">
								<option value="not-selected"> -- Please Choose Trade Type -- </option>
								<?php foreach($trade_type as $trty){ ?>
									<option value="<?=$trty->reff_id?>"><?=$trty->reff_name?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group pbm col-xs-12 hidden_content">
							<label>PBM</label>
							<select name="PBM_ID" id="PBM_ID" class="form-control">
								<option value="not-selected"> -- Please Choose PBM -- </option>
								<?php foreach($pbm as $ter){ ?>
									<option value="<?=$ter->customer_id?>"><?=$ter->name?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group date-in col-xs-6 hidden_content">
							<label for="exampleAutocomplete">Date In</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input id="DATE_IN" name="DATE_IN" type="text" class="form-control" id="datepickerDate" placeholder="Tanggal PEB/PIB">
							</div>
						</div>
						<div class="form-group date-out col-xs-6 hidden_content">
							<label for="exampleAutocomplete">Date Out</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input id="DATE_OUT" name="DATE_OUT" type="text" class="form-control" id="datepickerDate" placeholder="Tanggal PEB/PIB">
							</div>
						</div>
						<!-- <div class="form-group col-xs-12">
							<label>Nama Customer</label>
							<input name="" id="" type="text" class="form-control" value="NAMA CUSTOMER INI" disabled>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12 hidden_content" id='international_content'>
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>International</b></h2>
					</header>

					<div class="main-box-body clearfix">
						<div class="form-group col-xs-6">
							<label for="exampleAutocomplete">No PEB/PIB</label>
							<input type="text" id="DEL_PIB_PEB_NO" name="DEL_PIB_PEB_NO" class="form-control" title="Masukkan No PEB" placeholder="No PEB/PIB" required>
						</div>
						<div class="form-group col-xs-6">
							<label for="exampleAutocomplete">Tanggal PEB/PIB</label>
							<div class="input-group">
								<i class="input-group-addon"><i class="fa fa-calendar"></i></i>
								<input id="DEL_PIB_PEB_DATE" name="DEL_PIB_PEB_DATE" type="text" class="form-control" id="datepickerDate" placeholder="Tanggal PEB/PIB">
								<div class="input-group-btn">
									<button type="button" class="btn btn-danger"><i class="fa fa-fw fa-search" aria-hidden="true" onclick="search_no_peb()"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="form-group col-xs-12">
							<label for="exampleTooltip">No NPE/SPPB</label>
							<input id="DEL_NPE_SPPB_NO" name="DEL_NPE_SPPB_NO" type="text" class="form-control" id="exampleTooltip" placeholder="No NPE/SPPB" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>Detail</b></h2>
					</header>

					<div class="main-box-body clearfix">
						<div class="form-group type-kegiatan col-xs-12 hidden_content">
							<label>Tipe Kegiatan</label>
							<select name="TYPE_KEGIATAN" id="TYPE_KEGIATAN" class="form-control">
								<option value="not-selected"> -- Please Choose Tipe Kegiatan -- </option>
								<?php foreach($tipe_kegiatan as $tikeg){ ?>
									<option value="<?=$tikeg->reff_id?>"><?=$tikeg->reff_name?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group truck-losing col-xs-12 hidden_content">
							<label>Truck Loosing</label>
							<select name="TRUCK_LOSING" id="TRUCK_LOSING" class="form-control">
								<option value="not-selected"> -- Please Choose Truck Loosing -- </option>
								<option value="Y">Yes</option>
								<option value="N">No</option>
							</select>
						</div>
						<div class="form-group col-xs-12">
							<label>Kemasan</label>
							<select name="PKG_ID" id="DTL_PKG_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Package -- </option>
								<?php foreach($package as $pkg){ ?>
									<option value="<?=$pkg->package_id?>"><?=$pkg->package_name?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-xs-4 hidden_content">
							<label>Kemasan Tamp</label>
							<input type="text" name="DTL_PKG_TMP" id="DTL_PKG_TMP" class="form-control">
						</div>
						<div class="form-group barang col-xs-12">
							<label>Barang</label>
							<select name="CMDTY_ID" id="DTL_CMDTY_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Commodity -- </option>
							</select>
						</div>
						<div class="form-group stacking col-xs-12 hidden_content" >
							<label>Area Stacking</label>
							<select name="DTL_STACK_AREA_ID" id="DTL_STACK_AREA_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Stacking Area -- </option>
							</select>
						</div>
						<div class="form-group size col-xs-4 hidden_content">
							<label>Size</label>
							<select name="SIZE_ID" id="DTL_SIZE_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Size -- </option>
								<?php foreach($size as $sz){ ?>
									<option value="<?=$sz->cont_size?>"><?=$sz->cont_desc?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group type col-xs-4 hidden_content">
							<label>Tipe</label>
							<select name="TYPE_ID" id="DTL_TYPE_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Tipe -- </option>
								<?php foreach($tipe as $tp){ ?>
									<option value="<?=$tp->cont_type?>"><?=$tp->cont_type_desc?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group status col-xs-4 hidden_content">
							<label>Status</label>
							<select name="STATUS_ID" id="DTL_STATUS_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Status -- </option>
								<?php foreach($status as $sts){ ?>
									<option value="<?=$sts->cont_status?>"><?=$sts->cont_status_desc?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-xs-4">
							<label>Satuan</label>
							<select name="UNIT_ID" id="DTL_UNIT_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Satuan -- </option>
								<?php foreach($satuan as $stn){ ?>
									<option value="<?=$stn->unit_id?>"><?=$stn->unit_name?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-xs-4">
							<label>Sifat</label>
							<select name="CHARACTER_ID" id="DTL_CHARACTER_ID" class="form-control">
								<option value="not-selected"> -- Please Choose Sifat -- </option>
								<?php foreach($sifat as $sft){ ?>
									<option value="<?=$sft->character_id?>"><?=$sft->character_name?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-xs-4">
							<label>Quantity</label>
							<input type="number" id="DTL_QTY" class="form-control" placeholder="Quantity">
						</div>
						<div class="form-group example-twitter-oss pull-right">
							<button class="btn btn-danger" type="button" id="list-detail" onclick="add_detail()">
								<i class="glyphicon glyphicon-plus">Add</i>
							</button>
						</div>
					</div>

					<div class="main-box-body clearfix">
						<table class="table table-striped table-hover" id="detail-list">
							<thead>
								<tr>
									<th>Tipe Kegiatan</th>
									<th>Truck Loosing</th>
									<th>Kemasan</th>
									<th>Barang</th>
									<th>Status</th>
									<th>Size</th>
									<th>Type</th>
									<th>Satuan</th>
									<th>Sifat</th>
									<th>Stacklng Area</th>
									<th>Quantity</th>
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
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>Alat</b></h2>
					</header>

					<div class="main-box-body clearfix">
						<div class="form-group col-xs-12">
							<label>Layanan</label>
							<select id="EQ_GROUP_TARIFF" name="EQ_GROUP_TARIFF" class="form-control">
								<option value="not-selected"> -- Please Choose Layanan  -- </option>
							</select>
						</div>
						<div class="form-group col-xs-12">
							<label>Nama Alat</label>
							<select id="EQ_TYPE_ID_RENT" name="EQ_TYPE_ID_RENT" class="form-control">
								<option value="not-selected"> -- Please Choose Nama Alat  -- </option>
								<?php foreach($alat as $alt){ ?>
									<option value="<?=$alt->equipment_type_id?>"><?=$alt->equipment_type_name?></option>
								<?php } ?>
							</select>
							<input type="hidden" class="form-control" id="EQ_TYPE_NAME_RENT" name="EQ_TYPE_NAME_RENT" readonly>
						</div>
						<div class="form-group col-xs-12">
							<label for="exampleTooltip">Satuan</label>
							<select id="EQ_UNIT_ID_RENT" name="EQ_UNIT_ID_RENT" class="form-control">
								<option value="not-selected"> -- Please Choose  Satuan  -- </option>
								<?php foreach($satuan as $stn){ ?>
									<option value="<?=$stn->unit_id?>"><?=$stn->unit_name?></option>
								<?php } ?>
							</select>
							<input type="hidden" class="form-control" id="EQ_UNIT_NAME_RENT" name="EQ_UNIT_NAME_RENT" readonly>
						</div>
						<div class="form-group col-xs-12">
							<label for="exampleTooltip">Jumlah</label>
							<input id="EQ_QTY_RENT" name="EQ_QTY_RENT" type="number" class="form-control" placeholder="Jumlah">
						</div>
						<div class="form-group col-xs-12">
							<label for="exampleTooltip">Jumlah / Durasi Pemakaian</label>
							<input id="EQ_QTY_PKG" name="EQ_QTY_PKG" type="number" class="form-control" placeholder="Jumlah / Durasi Pemakaian ">
						</div>
						<div class="form-group col-xs-12">
							<label>Kemasan</label>
							<select id="PACKAGE_ID_RENT" name="PACKAGE_ID_RENT" class="form-control">
								<option value="not-selected"> -- Please Choose Kemasan  -- </option>
								<?php foreach($package as $pkg){ ?>
									<option value="<?=$pkg->package_id?>"><?=$pkg->package_name?></option>
								<?php } ?>
							</select>
							<input type="hidden" class="form-control" id="PACKAGE_NAME_RENT" name="PACKAGE_NAME_RENT" readonly>
						</div>
						<div class="form-group example-twitter-oss pull-right">
							<button class="btn btn-danger" type="button" id="list-rental" onclick="add_rental()">
								<i class="glyphicon glyphicon-plus">Add</i>
							</button>
						</div>

						<table class="table table-striped table-hover" id="detail-rental">
							<thead>
								<tr>
									<th>Layanan</th>
									<th>Nama Alat</th>
									<th>Satuan</th>
									<th>Jumlah</th>
									<th>Jumlah / Durasi Pemakaian</th>
									<th>Kemasan</th>
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
							<button class="btn btn-danger" onclick="calculate()"><i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp;Calculate</button>			
						</div>
					</div>
				</div>
			</div>
		</div>	

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>Detail Tagihan</b></h2>
					</header>

					<div class="main-box-body clearfix">
						<table class="table table-striped table-hover" id="detail-tagihan-penumpukan">
							<thead>
								<tr><th style="background-color: #272d33;color: white" colspan="7">Penumpukan</th></tr>
							</thead>
							
							<thead>
								<tr>
									<th>Layanan</th>
									<th>Kemasan</th>
									<th>Barang</th>
									<th>Jumlah</th>
									<th>Tarif Dasar</th>
									<th>Satuan</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

						<table class="table table-striped table-hover" id="detail-tagihan-alat">
							<thead>
								<tr><th style="background-color: #272d33;color: white" colspan="8">Alat</th></tr>
							</thead>
							<thead>
								<tr>
									<th>Layanan</th>
									<th>Nama Alat</th>
									<th>Satuan Alat</th>
									<th>Kemasan</th>
									<th>Jumlah Alat</th>
									<th>Jumlah / Durasi Pemakaian</th>
									<th>Tarif Dasar</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

						<div class="row">
								<div class="col-xs-7"></div>
								<div class="col-xs-5">
									<table width="100%">
										<thead>
											<tr><th colspan="2" style="border-bottom: 1px solid silver;">Total</th></tr>
										</thead>
										<tbody>
											<tr>
												<td style="padding: 30px 0 0 0">DPP :</td>
												<td style="padding: 30px 10px 0 10px"><input type="text" class="form-control" id="dpp"></td>
											</tr>
											<tr>
												<td>PPN 10% :</td>
												<td style="padding: 10px 10px 0 10px"><input type="text" class="form-control" id="ppn"></td>
											</tr>
											<tr>
												<td>TOTAL :</td>
												<td style="padding: 10px 10px 0 10px"><input type="text" class="form-control" id="total"></td>
											</tr>
										</tbody>		
									</table>
								</div>
						</div>	
					</div>

				</div>
			</div>
		</div>

	</div>

<script>

	var counterDetail = 0;
	var counterRental = 0;
	var counterRetribution = 0;

	$(document).ready(function() {

		$('#BOOKING_TYPE').on('change', function(){
			$('#booking-type-selected').removeClass('hidden_content');	
		});
		
		$('#DEL_PIB_PEB_DATE').datepicker({
			format: 'dd-mm-yyyy'
		});
		
		$('#DATE_IN').datepicker({
			format: 'dd-mm-yyyy'
		});

		$('#DATE_OUT').datepicker({
			format: 'dd-mm-yyyy'
		});

		// TRADE TYPE

			$('#TRADE_TYPE').on('change', function(){
				var trade_type = $(this).val();		
				trade_type == 'I' ? $('#international_content').removeClass('hidden_content') : $('#international_content').addClass('hidden_content');
			});

		// END TRADE TYPE

		// BOOKING TYPE

			$('#BOOKING_TYPE').on('change', function(){
				var booking_type = $(this).val();
				
				// Get current date 
				var today = new Date();
				var dd = String(today.getDate()).padStart(2, '0');
				var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
				var yyyy = today.getFullYear();

				today = dd + '-' + mm + '-' + yyyy;
				// End current date

				if (booking_type == '14') {  // RECEIVING CARGO
					$('#DATE_IN').val(today);
					$('#DATE_OUT').val(today);
					$('.date-out').removeClass('hidden_content');
					// $('.open-stack').removeClass('hidden_content');
					$('.date-in').removeClass('hidden_content');
					$('.stacking').removeClass('hidden_content');
					// $('.etd').addClass('hidden_content');
					$('.type-kegiatan').addClass('hidden_content');
					$('.pbm').addClass('hidden_content');
					$('.truck-losing').addClass('hidden_content');	

				} else if (booking_type == '15') { //DELIVERY CARGO
					$('#DATE_IN').val(today);
					$('#DATE_OUT').val(today);
					$('.date-out').removeClass('hidden_content');
					// $('.open-stack').removeClass('hidden_content');
					$('.date-in').removeClass('hidden_content');
					$('.stacking').removeClass('hidden_content');
					// $('.etd').addClass('hidden_content');
					$('.type-kegiatan').addClass('hidden_content');
					$('.pbm').addClass('hidden_content');
					$('.truck-losing').addClass('hidden_content');

				} else if (booking_type == '13') { // BM CARGO
					$('#DATE_IN').val('');
					$('#DATE_OUT').val('');		
					$('.type-kegiatan').removeClass('hidden_content');
					$('.truck-losing').removeClass('hidden_content');
					$('.pbm').removeClass('hidden_content');
					$('.date-in').addClass('hidden_content');
					$('.etd').addClass('hidden_content');
					$('.date-out').addClass('hidden_content');
					$('.open-stack').addClass('hidden_content');
					$('.stacking').addClass('hidden_content');
				}
			});
			
		// END BOOKING TYPE

			$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
				counterDetail--;
				$(this).closest("tr").remove();       
			});

			$("table#detail-rental").on("click", ".btn-delete-detail-rental", function (event) {
				counterRental--;
				$(this).closest("tr").remove();       
			});

		// END RENTAL 

		///////////////////////////////////////////
		///			  LOAD DATA - AJAX			///
		///////////////////////////////////////////

			$('#DTL_PKG_ID').on('change', function(){
				var pkg_id	= $(this).val();
				var url		= "<?=ROOT?>npkbilling/tarif_simulation/get_commodity";

				// PACKAGE PETIKEMAS ONLY

					if (pkg_id == '8') { 
						$('.size').removeClass('hidden_content');
						$('.type').removeClass('hidden_content');
						$('.status').removeClass('hidden_content');
						$('.barang').addClass('hidden_content');										
					} else if (pkg_id == 'not-selected') {
						return 0;									
					} else {
						$('.size').addClass('hidden_content');
						$('.type').addClass('hidden_content');
						$('.status').addClass('hidden_content');
						$('.barang').removeClass('hidden_content');
					}

				// END PACKAGE PETIKEMAS ONLY

				$.blockUI();	
				$('#DTL_CMDTY_ID option#tempcc').remove();
				$('#DTL_CMDTY_ID').html("");
				$.ajax({
					type: 'POST', 
					url: url,
					dataType: 'json',
					data: { 
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
						package_id : pkg_id 
					},
					success:function(data){
						for (let index = 0; index < data.length; index++) {
							var options =	"<option pgkid='"+data[index]['package_id']+"' value='"+data[index]['commodity_id']+"'>" +
												"BARANG: "+data[index]['commodity_name']+" || KEMASAN: "+data[index]['package_name'] +
											"</option>";					
							$('#DTL_CMDTY_ID').append(options);	
						}
						console.log(options);

						$.unblockUI();
					}
				});			

			});

			$('#DTL_PKG_ID').on('change', function() {
				var DTL_PKG_ID = $(this).val();
				$('#DTL_PKG_TMP').val(DTL_PKG_ID);
			});

			$('#DTL_CMDTY_ID').on('change', function() {
				var DTL_CMDTY_ID = $(this).val();
				var parent_id =  $(this).find('option:selected').attr('pgkid');
				$('#DTL_PKG_TMP').val(parent_id);
			});

			//GROUP_TARIFF
			$.ajax({
			    type: "GET",
			   	url: "<?=ROOT?>npkbilling/tarif_simulation/layanan_alat",
				success: function(data){
					var obj = JSON.parse(data);
			
					var toAppend = '';
					for(var i=0;i<obj.length;i++){
						toAppend += '<option value="'+obj[i]['group_tariff_id']+'">'+obj[i]['comp_nota_name']+'</option>';
					}
					
					$('#EQ_GROUP_TARIFF').append(toAppend);
				}
			});

			//stacking type
			$.ajax({
			    type: "GET",
			   	url: "<?=ROOT?>npkbilling/tarif_simulation/stacking_area",
				success: function(data){
					var obj = JSON.parse(data);
			
					var toAppend = '';
					for(var i=0;i<obj.length;i++){
						toAppend += '<option value="'+obj[i]['reff_id']+'">'+obj[i]['reff_name']+'</option>';
					}
					
					$('#DTL_STACK_AREA_ID').append(toAppend);
				}
			});

			//terminal
			$.ajax({
			    type: "GET",
			   	url: "<?=ROOT?>npkbilling/mdm/get_terminalList",
				success: function(data){
					var obj = JSON.parse(data);
					var toAppend = '';

					for(var i=0;i<obj.length;i++){
						toAppend += '<option value="' + obj[i]['ID_TERMINAL'] + '" brchid="' + obj[i]['BRANCH_ID'] + '" brchcode="' + obj[i]['BRANCH_CODE'] + '">' + obj[i]['TERMINAL_NAME'] + '</option>';
					}
					
					$('#TERMINAL_ID').append(toAppend);
				}
			});

		///////////////////////////////////////////
		///			END LOAD DATA - AJAX		///
		///////////////////////////////////////////

	});

	function to_idr(bilangan) {
        var	number_string = bilangan.toString(),
            sisa 	= number_string.length % 3,
            rupiah 	= number_string.substr(0, sisa),
            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah; 
    }

	function add_detail() {
		counterDetail++;
		var BOOKING_TYPE		= $('#BOOKING_TYPE').val();
		var TYPE_KEGIATAN		= $('#TYPE_KEGIATAN').val();
		var TRUCK_LOSING		= $('#TRUCK_LOSING').val();
		var DTL_PKG_ID			= $('#DTL_PKG_TMP').val();
		var DTL_CMDTY_ID		= $('#DTL_CMDTY_ID').val();
		var DTL_SIZE_ID			= $('#DTL_SIZE_ID').val();
		var DTL_TYPE_ID			= $('#DTL_TYPE_ID').val();
		var DTL_STATUS_ID		= $('#DTL_STATUS_ID').val();
		var DTL_UNIT_ID			= $('#DTL_UNIT_ID').val();
		var DTL_CHARACTER_ID	= $('#DTL_CHARACTER_ID').val();
		var DTL_QTY				= $('#DTL_QTY').val();
		var DTL_STACK_AREA_ID	= $('#DTL_STACK_AREA_ID').val();

		if (BOOKING_TYPE == 13) {
			if (TYPE_KEGIATAN == 'not-selected') {
				alert('Please Choose Tipe Kegiatan');
				return false;
			}else if(TRUCK_LOSING == 'not-selected'){
				alert('Please Choose Truck Loosing');
				return false;
			}else if(!DTL_PKG_ID){
				alert('Please Choose Kemasan');
				return false;
			}else if(DTL_CMDTY_ID == 'not-selected'){
				alert('Please Choose Barang');
				return false;
			}else if(DTL_UNIT_ID == 'not-selected'){
				alert('Please Choose Satuan');
				return false;
			}else if(DTL_CHARACTER_ID == 'not-selected'){
				alert('Please Choose Sifat');
				return false;
			}else if(DTL_QTY == ''){
				alert('Please Choose Quantity');
				return false;
			}
		}else if(BOOKING_TYPE == 15){
			if(!DTL_PKG_ID){
				alert('Please Choose Kemasan');
				return false;
			}else if(DTL_CMDTY_ID == 'not-selected'){
				alert('Please Choose Barang');
				return false;
			}else if(DTL_STACK_AREA_ID == 'not-selected'){
				alert('Please Choose Area Stacking');
				return false;
			}else if(DTL_UNIT_ID == 'not-selected'){
				alert('Please Choose Satuan');
				return false;
			}else if(DTL_CHARACTER_ID == 'not-selected'){
				alert('Please Choose Sifat');
				return false;
			}else if(DTL_QTY == ''){
				alert('Please Choose Quantity');
				return false;
			}
		}else if(BOOKING_TYPE == 14){
			if(!DTL_PKG_ID){
				alert('Please Choose Kemasan');
				return false;
			}else if(DTL_CMDTY_ID == 'not-selected'){
				alert('Please Choose Barang');
				return false;
			}else if(DTL_STACK_AREA_ID == 'not-selected'){
				alert('Please Choose Area Stacking');
				return false;
			}else if(DTL_UNIT_ID == 'not-selected'){
				alert('Please Choose Satuan');
				return false;
			}else if(DTL_CHARACTER_ID == 'not-selected'){
				alert('Please Choose Sifat');
				return false;
			}else if(DTL_QTY == ''){
				alert('Please Choose Quantity');
				return false;
			}
		}

		
		var TYPE_KEGIATAN_NAME = TYPE_KEGIATAN == 'not-selected' ? '' : $('#TYPE_KEGIATAN option:selected').text();
		var TRUCK_LOSING_NAME = TRUCK_LOSING == 'not-selected' ? '' : $('#TRUCK_LOSING option:selected').text();
		var DTL_PKG_ID_NAME = DTL_PKG_ID == 'not-selected' ? '' : $('#DTL_PKG_ID option:selected').text();
		var DTL_UNIT_ID_NAME = DTL_UNIT_ID == 'not-selected' ? '' : $('#DTL_UNIT_ID option:selected').text();
		var DTL_SIZE_ID_NAME = DTL_SIZE_ID == 'not-selected' ? '' : $('#DTL_SIZE_ID option:selected').text();
		var DTL_TYPE_ID_NAME = DTL_TYPE_ID == 'not-selected' ? '' : $('#DTL_TYPE_ID option:selected').text();
		var DTL_STATUS_ID_NAME = DTL_STATUS_ID == 'not-selected' ? '' : $('#DTL_STATUS_ID option:selected').text();
		var DTL_CMDTY_ID_NAME = DTL_CMDTY_ID == 'not-selected' ? '' : $('#DTL_CMDTY_ID option:selected').text();
		var DTL_CHARACTER_ID_NAME = DTL_CHARACTER_ID == 'not-selected' ? '' : $('#DTL_CHARACTER_ID option:selected').text();
		var DTL_STACK_AREA = DTL_STACK_AREA_ID == 'not-selected' ? '' : $('#DTL_STACK_AREA_ID option:selected').text();

		// $('#TYPE_KEGIATAN').prop('selectedIndex',0);
		// $('#TRUCK_LOSING').prop('selectedIndex',0);
		// $('#DTL_PKG_ID').prop('selectedIndex',0);
		// $('#DTL_CMDTY_ID').prop('selectedIndex',0);
		// $('#DTL_SIZE_ID').prop('selectedIndex',0);
		// $('#DTL_TYPE_ID').prop('selectedIndex',0);
		// $('#DTL_STATUS_ID').prop('selectedIndex',0);
		// $('#DTL_UNIT_ID').prop('selectedIndex',0);
		// $('#DTL_CHARACTER_ID').prop('selectedIndex',0);
		// $('#DTL_STACK_AREA_ID').prop('selectedIndex',0);
		// $('#DTL_QTY').val('');

		$('#detail-list tbody').append(
			'<tr>' +
				'<td class="TBL_TYPE_KEGIATAN" style="display:none;">'+ TYPE_KEGIATAN +'</td>' +
				'<td class="TBL_TYPE_KEGIATAN_NAME">'+ TYPE_KEGIATAN_NAME +'</td>' +
				'<td class="TBL_TRUCK_LOSING" style="display:none;">'+ TRUCK_LOSING +'</td>' +
				'<td class="TBL_TRUCK_LOSING_NAME">'+ TRUCK_LOSING_NAME +'</td>' +
				'<td class="TBL_DTL_PKG_ID" style="display:none;">'+ DTL_PKG_ID +'</td>' +
				'<td class="TBL_DTL_PKG_ID_NAME">'+ DTL_PKG_ID_NAME +'</td>' +
				'<td class="TBL_DTL_CMDTY_ID" style="display:none;">'+ DTL_CMDTY_ID +'</td>' +
				'<td class="TBL_DTL_CMDTY_ID_NAME">'+ DTL_CMDTY_ID_NAME +'</td>' +
				'<td class="TBL_DTL_SIZE_ID" style="display:none;">'+ DTL_SIZE_ID +'</td>' +
				'<td class="TBL_DTL_SIZE_ID_NAME">'+ DTL_SIZE_ID_NAME +'</td>' +
				'<td class="TBL_DTL_TYPE_ID" style="display:none;">'+ DTL_TYPE_ID +'</td>' +
				'<td class="TBL_DTL_TYPE_ID_NAME">'+ DTL_TYPE_ID_NAME +'</td>' +
				'<td class="TBL_DTL_STATUS_ID" style="display:none;">'+ DTL_STATUS_ID +'</td>' +
				'<td class="TBL_DTL_STATUS_ID_NAME">'+ DTL_STATUS_ID_NAME +'</td>' +
				'<td class="TBL_DTL_UNIT_ID" style="display:none;">'+ DTL_UNIT_ID +'</td>' +
				'<td class="TBL_DTL_UNIT_ID_NAME">'+ DTL_UNIT_ID_NAME +'</td>' +
				'<td class="TBL_DTL_CHARACTER_ID" style="display:none;">'+ DTL_CHARACTER_ID +'</td>' +
				'<td class="TBL_DTL_CHARACTER_ID_NAME">'+ DTL_CHARACTER_ID_NAME +'</td>' +
				'<td class="TBL_DTL_STACKING_AREA_ID" style="display:none;">'+ DTL_STACK_AREA_ID +'</td>' +
				'<td class="TBL_DTL_STACKING_AREA">'+ DTL_STACK_AREA +'</td>' +
				'<td class="TBL_DTL_QTY">'+ DTL_QTY +'</td>' +
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail"><i class="fa fa-trash-o"></i></a>' +
				'</td>' +
			'</tr>'
		);	
	}

	function add_rental() {
		counterRental++;
		var EQ_LAYANAN_ID 	= $('#EQ_GROUP_TARIFF').val();
		var EQ_TYPE_ID 		= $('#EQ_TYPE_ID_RENT').val();
		var EQ_UNIT_ID 		= $('#EQ_UNIT_ID_RENT').val();
		var EQ_QTY 			= $('#EQ_QTY_RENT').val();
		var EQ_QTY_PKG 		= $('#EQ_QTY_PKG').val();
		var PACKAGE_ID 		= $('#PACKAGE_ID_RENT').val();

		if (EQ_LAYANAN_ID == 'not-selected') {
			alert('Please Choose Layanan');
			return false;
		}else if(EQ_TYPE_ID == 'not-selected'){
			alert('Please Choose Nama Alat');
			return false;
		}else if(EQ_UNIT_ID == 'not-selected'){
			alert('Please Choose Satuan');
			return false;
		}else if(EQ_QTY == ''){
			alert('Please Choose Jumlah');
			return false;
		}else if(EQ_QTY_PKG == ''){
			alert('Please Choose Durasi Pemakaian');
			return false;
		}


		var EQ_TYPE_ID			= ($('#EQ_TYPE_ID_RENT').val() != "not-selected")? $('#EQ_TYPE_ID_RENT').val() : "";
		var EQ_UNIT_ID			= ($('#EQ_UNIT_ID_RENT').val() != "not-selected")? $('#EQ_UNIT_ID_RENT').val() : "";
		var EQ_QTY				= $('#EQ_QTY_RENT').val();
		var EQ_QTY_PKG			= $('#EQ_QTY_PKG').val();
		var PACKAGE_ID			= ($('#PACKAGE_ID_RENT').val() != "not-selected")? $('#PACKAGE_ID_RENT').val() : "";
		var PACKAGE_NAME		= ($('#PACKAGE_ID_RENT').val() != "not-selected")? $('#PACKAGE_ID_RENT option:selected').text() : "";
		var EQ_LAYANAN_ID		= ($('#EQ_GROUP_TARIFF').val() != "not-selected")? $('#EQ_GROUP_TARIFF').val() : "";
		var EQ_LAYANAN 			= ($('#EQ_GROUP_TARIFF').val() != "not-selected")? $('#EQ_GROUP_TARIFF option:selected').text() : "";
		
		$('#detail-rental').append(
		
			'<tr>' +
				'<td class="TBL_EQ_GROUP_TARIFF_ID" style="display:none;">'+ EQ_LAYANAN_ID +'</td>' +
				'<td class="TBL_EQ_GROUP_TARIFF_NAME">'+ EQ_LAYANAN +'</td>' +
				'<td class="TBL_EQ_TYPE_ID" style="display:none;">'+ EQ_TYPE_ID +'</td>' +
				'<td class="TBL_EQ_TYPE_NAME">'+ $('#EQ_TYPE_ID_RENT option:selected').text() +'</td>' +
				'<td class="TBL_EQ_UNIT_ID" style="display:none;">'+EQ_UNIT_ID +'</td>' +
				'<td class="TBL_EQ_UNIT_NAME">'+ $('#EQ_UNIT_ID_RENT option:selected').text() +'</td>' +
				'<td class="TBL_EQ_QTY">'+ EQ_QTY +'</td>' +
				'<td class="TBL_EQ_QTY_PKG">'+ EQ_QTY_PKG +'</td>' +
				'<td class="TBL_PACKAGE_ID" style="display:none;">'+ PACKAGE_ID +'</td>' +
				'<td class="TBL_PACKAGE_NAME">'+ PACKAGE_NAME +'</td>' +
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail-rental"><i class="fa fa-trash-o"></i></a>' +
				'</td>' +
			'</tr>'
		);	
	}

	function calculate() {
		var details = [];
		var alats = [];

		// RANDOM CHARACTER
			var random_ascii;		
			var random_string 	= '';
			var ascii_low 		= 65;
			var ascii_high 		= 90
			var random_number	= Math.random().toString();
			for(let i = 0; i < 2; i++) {
				random_ascii = Math.floor((Math.random() * (ascii_high - ascii_low)) + ascii_low);
				random_string += String.fromCharCode(random_ascii)
			}
		// END RANDOM CHARACKTER

		var booking_number	= random_string+'-'+random_number.substring(8);
		var no_bl			= 'BL-'+random_number.substring(15);

		$('#detail-list tbody tr').each(function(){
			var type_kegiatan	= $(this).find('.TBL_TYPE_KEGIATAN').html(); 
			var type_kegiatan_name	= $(this).find('.TBL_TYPE_KEGIATAN_NAME').html(); 
			var truck_losing 	= $(this).find('.TBL_TRUCK_LOSING').html();
			var pkg_id 			= $(this).find('.TBL_DTL_PKG_ID').html();  
			var pkg_name		= $(this).find('.TBL_DTL_PKG_ID_NAME').html();  
			var cmdty_id		= $(this).find('.TBL_DTL_CMDTY_ID').html();
			var cmdty_name		= $(this).find('.TBL_DTL_CMDTY_ID_NAME').html();
			var size_id 		= $(this).find('.TBL_DTL_SIZE_ID').html(); 
			var size_name 		= $(this).find('.TBL_DTL_SIZE_ID_NAME').html(); 
			var type_id 		= $(this).find('.TBL_DTL_TYPE_ID').html();
			var type_name 		= $(this).find('.TBL_DTL_TYPE_ID_NAME').html();
			var status_id 		= $(this).find('.TBL_DTL_STATUS_ID').html();  
			var status_name 	= $(this).find('.TBL_DTL_STATUS_ID_NAME').html();  
			var unit_id			= $(this).find('.TBL_DTL_UNIT_ID').html();  
			var unit_name		= $(this).find('.TBL_DTL_UNIT_ID_NAME').html();  
			var character_id 	= $(this).find('.TBL_DTL_CHARACTER_ID').html();  
			var character_name 	= $(this).find('.TBL_DTL_CHARACTER_ID_NAME').html();  
			var stacking_area_id = $(this).find('.TBL_DTL_STACKING_AREA_ID').html();  
			var stacking_area 	= $(this).find('.TBL_DTL_STACKING_AREA').html();  
			var qty				= $(this).find('.TBL_DTL_QTY').html(); 			

			var temp = {
				"DTL_BM_TYPE_NAME": (type_kegiatan != 'not-selected') ? type_kegiatan : '', 
				"DTL_BM_TYPE": (type_kegiatan_name != 'not-selected') ? type_kegiatan_name : '',
				"DTL_BL": (no_bl != 'not-selected') ? no_bl : '',
				"DTL_PKG_ID": (pkg_id != 'not-selected') ? pkg_id : '',
				"DTL_PKG_NAME": (pkg_name != 'not-selected') ? pkg_name : '',
				"DTL_CMDTY_ID": (cmdty_id != 'not-selected') ? cmdty_id : '',
				"DTL_CMDTY_NAME": (cmdty_name != 'not-selected') ? cmdty_name : '',
				"DTL_CHARACTER": (character_id != 'not-selected') ? character_id : '',
				"DTL_CHARACTER_NAME": (character_name != 'not-selected') ? character_name : '',
				"DTL_CONT_SIZE": (size_id != 'not-selected') ? size_id : '',
				"DTL_CONT_SIZE_NAME": (size_name != 'not-selected') ? size_name : '',
				"DTL_CONT_TYPE": (type_id != 'not-selected') ? type_id : '',
				"DTL_CONT_TYPE_NAME": (type_name != 'not-selected') ? type_name : '',
				"DTL_CONT_STATUS": (status_id != 'not-selected') ? status_id : '',
				"DTL_CONT_STATUS_NAME": (status_name != 'not-selected') ? status_name : '',
				"DTL_UNIT_ID": (unit_id != 'not-selected') ? unit_id : '',
				"DTL_UNIT_NAME": (unit_name != 'not-selected') ? unit_name : '',
				"DTL_QTY": qty,
				"DTL_TL": (truck_losing != 'not-selected') ? truck_losing : '',
				"DTL_DATE_IN": $('#DATE_IN').val(),
				"DTL_DATE_OUT": $('#DATE_OUT').val(),
				"DTL_DATE_OUT_OLD": "",
				"DTL_STACK_AREA": (stacking_area != 'not-selected') ? stacking_area : '',
				"DTL_STACK_AREA_ID": (stacking_area_id != 'not-selected') ? stacking_area_id : '',
				"DTL_PFS": "Y"

			}
			details.push(temp);
		});

		$('#detail-rental tbody tr').each(function(){
			var eq_type_id 			= $(this).find('.TBL_EQ_TYPE_ID').html(); 
			var eq_type_name 		= $(this).find('.TBL_EQ_TYPE_NAME').html(); 
			var eq_qty 				= $(this).find('.TBL_EQ_QTY').html();
			var eq_qty_pkg 			= $(this).find('.TBL_EQ_QTY_PKG').html();
			var eq_unit_id 			= $(this).find('.TBL_EQ_UNIT_ID').html();  
			var eq_unit_name 		= $(this).find('.TBL_EQ_UNIT_NAME').html();  
			var eq_pkg_id			= $(this).find('.TBL_PACKAGE_ID').html(); 
			var eq_pkg_name			= $(this).find('.TBL_PACKAGE_NAME').html(); 
			var eq_group_tariff_id	= $(this).find('.TBL_EQ_GROUP_TARIFF_ID').html(); 
			var eq_group_tariff_name= $(this).find('.TBL_EQ_GROUP_TARIFF_NAME').html(); 

			var temp = {

				"EQ_ID": "",
				"REQ_NO": "",
				"EQ_GTRF_ID": eq_group_tariff_id,
				"GROUP_TARIFF_NAME": eq_group_tariff_name,
				"EQ_TYPE_ID": eq_type_id,
				"EQ_TYPE_NAME": eq_type_name,
				"EQ_UNIT_ID": eq_unit_id,
				"EQ_UNIT_NAME": eq_unit_name,
				"EQ_QTY": eq_qty,
				"EQ_PKG_ID": eq_pkg_id,
				"EQ_QTY_PKG": eq_qty_pkg,
				"PACKAGE_NAME": eq_pkg_name
			}
			alats.push(temp);
		});

		arrData = 
			{
				"action": "getSimulasiTarif",
				"HEADER": {
					"P_NOTA_ID": ($('#BOOKING_TYPE').val() != 'not-selected') ? $('#BOOKING_TYPE').val() : '',
					"P_BRANCH_ID": $('#TERMINAL_ID').find('option:selected').attr('brchid'),
					"P_BRANCH_CODE": $('#TERMINAL_ID').find('option:selected').attr('brchcode'),
					"P_CUSTOMER_ID": "<?=$this->session->userdata('custid_phd')?>",
					"TERMINAL_CODE": $('#TERMINAL_ID').val(),
					"P_BOOKING_NUMBER": booking_number,
					"P_TRADE": ($('#TRADE_TYPE').val() != 'not-selected') ? $('#TRADE_TYPE').val() : '',
					"P_REALIZATION": "N",
					"DATE_IN": $('#DATE_IN').val(),
					"DATE_OUT": $('#DATE_OUT').val(),
					"P_RESTITUTION": "N",
					"P_PBM_ID": $('#PBM_ID').val(),
					"P_USER_ID": "<?=$this->session->userdata('userid_simop')?>",

				},
				"DETAIL": (details.length > 0) ? details : [],
				"EQUIP": (alats.length > 0) ? alats : []
			}

		console.log(arrData);
		//return false;
		$.blockUI();

		if(details.length == 0){
			$.unblockUI();
			alert('Detail Harus diisi !!');
			return false;
		}

		$.ajax({
			url: "<?=ROOT?>npkbilling/tarif_simulation/get_tarif_simulation",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				var resp 	= JSON.parse(data.data);
				var details = [];
				var d_alats = [];
				console.log(data);
				console.log(resp);
				if (data.success === 'S') {
					if (resp['result_flag'] != 'F') {
						$('#detail-tagihan-penumpukan tbody tr').remove();
						$('#detail-tagihan-alat tbody tr').remove();

						var notification = new NotificationFx({
							message : '<p>Data Berhasil Dikalkulasi</p><br/>',
							layout : 'growl',
							effect : 'jelly',
							type : 'success' // notice, warning, error or success
						}); 

						for (let index = 0; index < resp['Detail'].length; index++) {
							if (resp['Detail'][index]['dtl_group_tariff_id'] == 12 || resp['Detail'][index]['dtl_group_tariff_id'] == 13) {
								d_alats.push(resp['Detail'][index]);
							} else {
								details.push(resp['Detail'][index]);
							}
						}
						
						for (let index = 0; index < details.length; index++) {
							$('#detail-tagihan-penumpukan tbody').append(
								'<tr>' +
									'<td>'+ details[index]['dtl_service_type'] +'</td>' +
									'<td>'+ details[index]['dtl_package'] +'</td>' +
									'<td>'+ details[index]['dtl_commodity'] +'</td>' +
									'<td>'+ details[index]['dtl_qty'] +'</td>' +
									'<td>'+ details[index]['dtl_tariff'] +'</td>' +
									'<td>'+ details[index]['dtl_unit_name'] +'</td>' +
									'<td>'+ details[index]['dtl_total_tariff'] +'</td>' +
								'</tr>'
							);
						}
						
						for (let index = 0; index < d_alats.length; index++) {
							$('#detail-tagihan-alat tbody').append(
								'<tr>' +
									'<td>'+ d_alats[index]['dtl_group_tariff_name'] +'</td>' +
									'<td>'+ d_alats[index]['dtl_equipment'] +'</td>' +
									'<td>'+ d_alats[index]['dtl_unit_name'] +'</td>' +
									'<td>'+ d_alats[index]['dtl_package'] +'</td>' +
									'<td>'+ d_alats[index]['qty'] +'</td>' +
									'<td>'+ d_alats[index]['dtl_qty'] +'</td>' +
									'<td>'+ d_alats[index]['dtl_total_tariff'] +'</td>' +
									'<td>'+ d_alats[index]['dtl_ppn'] +'</td>' +
								'</tr>'
							);
						}

						$('#dpp').val(to_idr(resp['Header'][0]['dpp_uper']));
						$('#ppn').val(to_idr(resp['Header'][0]['ppn_uper']));
						$('#total').val(to_idr(resp['Header'][0]['total_uper']));
						

						setTimeout(function(){ 
							notification.dismiss();	
						}, 3000);	
					} else {
						var notification = new NotificationFx({
							message : '<p>'+resp['result_msg']+'</p><br/>',
							layout : 'growl',
							effect : 'jelly',
							type : 'error' // notice, warning, error or success
						});

						setTimeout(function(){ 
							notification.dismiss();	
						}, 7000);
					}
						
					$.unblockUI();
				} 
			}
		});	
	}

</script>

