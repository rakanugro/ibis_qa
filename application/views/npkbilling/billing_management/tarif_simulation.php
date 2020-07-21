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
	
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>Header</b></h2>
				</header>
				
				<div class="main-box-body clearfix">
					<div class="form-group col-xs-6">
						<label>Terminal</label>
						<select name="TERMINAL_NAME" id="TERMINAL_NAME" class="form-control">
							<option value="not-selected"> -- Please Choose Terminal -- </option>
							<?php foreach($terminal as $ter){ ?>
								<option value="<?=$ter->terminal_code?>"><?=$ter->terminal_name?></option>
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
					<div class="form-group col-xs-6">
						<label>Tipe Perdagangan</label>
						<select name="TRADE_TYPE" id="TRADE_TYPE" class="form-control">
							<option value="not-selected"> -- Please Choose Trade Type -- </option>
							<?php foreach($trade_type as $trty){ ?>
								<option value="<?=$trty->reff_id?>"><?=$trty->reff_name?></option>
							<?php } ?>
						</select>
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
					<div class="form-group barang col-xs-12">
						<label>Barang</label>
						<select name="CMDTY_ID" id="DTL_CMDTY_ID" class="form-control">
							<option value="not-selected"> -- Please Choose Commodity -- </option>
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
								<option value="<?=$sft->reff_id?>"><?=$sft->reff_name?></option>
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
								<th>Satuan</th>
								<th>Size</th>
								<th>Type</th>
								<th>Status</th>
								<th>Sifat</th>
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
		<div class="col-lg-6">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>Sewa Alat</b></h2>
				</header>

				<div class="main-box-body clearfix">
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
								<th>Nama Alat</th>
								<th>Satuan</th>
								<th>Jumlah</th>
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

		<div class="col-lg-6">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<b>Sewa Retribusi</b></h2>
				</header>

				<div class="main-box-body clearfix">
					<div class="form-group col-xs-12">
						<label>Nama Alat</label>
						<select id="EQ_TYPE_ID_RETRI" name="EQ_TYPE_ID_RETRI" class="form-control">
							<option value="not-selected"> -- Please Choose Nama Alat  -- </option>
							<?php foreach($alat as $alt){ ?>
								<option value="<?=$alt->equipment_type_id?>"><?=$alt->equipment_type_name?></option>
							<?php } ?>
						</select>
						<input type="hidden" class="form-control" id="EQ_TYPE_NAME_RETRI" name="EQ_TYPE_NAME_RETRI" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Satuan</label>
						<select id="EQ_UNIT_ID_RETRI" name="EQ_UNIT_ID_RETRI" class="form-control">
							<option value="not-selected"> -- Please Choose  Satuan  -- </option>
							<?php foreach($satuan as $stn){ ?>
								<option value="<?=$stn->unit_id?>"><?=$stn->unit_name?></option>
							<?php } ?>
						</select>
						<input type="hidden" class="form-control" id="EQ_UNIT_NAME_RETRI" name="EQ_UNIT_NAME_RETRI" readonly>
					</div>
					<div class="form-group col-xs-12">
						<label for="exampleTooltip">Jumlah</label>
						<input id="EQ_QTY_RETRI" name="EQ_QTY_RETRI" type="number" class="form-control" placeholder="Jumlah">
					</div>
					<div class="form-group col-xs-12">
						<label>Kemasan</label>
						<select id="PACKAGE_ID_RETRI" name="PACKAGE_ID_RETRI" class="form-control">
							<option value="not-selected"> -- Please Choose Kemasan  -- </option>
							<?php foreach($package as $pkg){ ?>
								<option value="<?=$pkg->package_id?>"><?=$pkg->package_name?></option>
							<?php } ?>
						</select>
						<input type="hidden" class="form-control" id="PACKAGE_NAME_RETRI" name="PACKAGE_NAME_RETRI" readonly>
					</div>
					<div class="form-group example-twitter-oss pull-right">
						<button class="btn btn-danger" type="button" id="list-retribution" onclick="add_retribution()">
							<i class="glyphicon glyphicon-plus">Add</i>
						</button>
					</div>

					<table class="table table-striped table-hover" id="detail-retribution">
						<thead>
							<tr>
								<th>Nama Alat</th>
								<th>Satuan</th>
								<th>Jumlah</th>
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

<script>

	var counterDetail = 0;
	var counterRental = 0;
	var counterRetribution = 0;

	$(document).ready(function() {
		
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

				if (booking_type == '14') { 
					$('#DATE_IN').val(today);
					$('#DATE_OUT').val(today);
					$('.date-in').removeClass('hidden_content');
					// $('.etd').removeClass('hidden_content');
					$('.date-out').removeClass('hidden_content');
					// $('.open-stack').addClass('hidden_content');
					$('.type-kegiatan').addClass('hidden_content');
					$('.truck-losing').addClass('hidden_content');										
				} else if (booking_type == '15') {
					$('#DATE_IN').val(today);
					$('#DATE_OUT').val(today);
					$('.date-out').removeClass('hidden_content');
					// $('.open-stack').removeClass('hidden_content');
					$('.date-in').removeClass('hidden_content');
					// $('.etd').addClass('hidden_content');
					$('.type-kegiatan').addClass('hidden_content');
					$('.truck-losing').addClass('hidden_content');										
				} else if (booking_type == '13') {
					$('#DATE_IN').val('');
					$('#DATE_OUT').val('');		
					$('.type-kegiatan').removeClass('hidden_content');
					$('.truck-losing').removeClass('hidden_content');
					$('.date-in').addClass('hidden_content');
					$('.etd').addClass('hidden_content');
					$('.date-out').addClass('hidden_content');
					$('.open-stack').addClass('hidden_content');
				}
			});
			
		// END BOOKING TYPE

		// DETAIL

			$("#list-detail").prop('disabled', true);
			$('#DTL_QTY').click(function(){
				var DTL_PKG_ID			= $('#DTL_PKG_ID').val();
				var DTL_CMDTY_ID		= $('#DTL_CMDTY_ID').val();
				var DTL_UNIT_ID			= $('#DTL_UNIT_ID').val();
				var DTL_CHARACTER_ID	= $('#DTL_CHARACTER_ID').val();

				if (DTL_PKG_ID == 'not-selected') {
					alert('Please choose Kemasan !');
					$('#DTL_PKG_ID').focus();
				}else if (DTL_CMDTY_ID == 'not-selected') {
					alert('Please choose Barang !');
					$('#DTL_CMDTY_ID').focus();
				}else if (DTL_UNIT_ID == 'not-selected') {
					alert('Please choose Satuan !');
					$('#DTL_UNIT_ID').focus();
				}else if (DTL_CHARACTER_ID == 'not-selected') {
					alert('Please choose Sifat !');
					$('#DTL_CHARACTER_ID').focus();
				}

				$('#DTL_QTY').keyup(function(){
					if ($('#DTL_QTY').val() != '')
						$("#list-detail").prop('disabled', false);
					else
						$("#list-detail").prop('disabled', true);
				});
			});

			$("table#detail-list").on("click", ".btn-delete-detail", function (event) {
				counterDetail--;
				$(this).closest("tr").remove();       
			});

		// END DETAIL

		// RENTAL

			$("#list-rental").prop('disabled', true);
			$('#PACKAGE_ID_RENT').click(function(){
				var EQ_TYPE_ID_RENT = $('#EQ_TYPE_ID_RENT').val();
				var EQ_UNIT_ID_RENT = $('#EQ_UNIT_ID_RENT').val();
				var EQ_QTY_RENT 	= $('#EQ_QTY_RENT').val();
				var PACKAGE_ID_RENT = $('#PACKAGE_ID_RENT').val();
				
				if (EQ_TYPE_ID_RENT == 'not-selected') {
					alert('Please choose Tipe Kegiatan !');
					$('#EQ_TYPE_ID_RENT').focus()
				} else if (EQ_UNIT_ID_RENT == 'not-selected') {
					alert('Please choose unit !');
					$('#EQ_UNIT_ID_RENT').focus()
				}else if (EQ_QTY_RENT == '') {
					alert('Please choose Quantity !');
					$('#EQ_QTY_RENT').focus()
				}
				
				$('#PACKAGE_ID_RENT').change(function(){
					if ($('#PACKAGE_ID_RENT').val() != 'not-selected')
						$("#list-rental").prop('disabled', false);
					else
						$("#list-rental").prop('disabled', true);
				});
			});

			$("table#detail-rental").on("click", ".btn-delete-detail-rental", function (event) {
				counterRental--;
				$(this).closest("tr").remove();       
			});

		// END RENTAL

		// RETRIBUTION

			$("#list-retribution").prop('disabled', true);
			$('#PACKAGE_ID_RETRI').click(function(){
				var EQ_TYPE_ID_RETRI 	= $('#EQ_TYPE_ID_RETRI').val();
				var EQ_UNIT_ID_RETRI 	= $('#EQ_UNIT_ID_RETRI').val();
				var EQ_QTY_RETRI 		= $('#EQ_QTY_RETRI').val();
				var PACKAGE_ID_RETRI 	= $('#PACKAGE_ID_RETRI').val();
				
				if (EQ_TYPE_ID_RETRI == 'not-selected') {
					alert('Please choose Tipe Kegiatan !');
					$('#EQ_TYPE_ID_RETRI').focus()
				} else if (EQ_UNIT_ID_RETRI == 'not-selected') {
					alert('Please choose unit !');
					$('#EQ_UNIT_ID_RETRI').focus()
				}else if (EQ_QTY_RETRI == '') {
					alert('Please choose Quantity !');
					$('#EQ_QTY_RETRI').focus()
				}
				
				$('#PACKAGE_ID_RETRI').change(function(){
					if ($('#PACKAGE_ID_RETRI').val() != 'not-selected')
						$("#list-retribution").prop('disabled', false);
					else
						$("#list-retribution").prop('disabled', true);
				});
			});

			$("table#detail-retribution").on("click", ".btn-delete-detail-retribution", function (event) {
				counterRetribution--;
				$(this).closest("tr").remove();       
			});

		// END RETRIBUTION 

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
							var options =	"<option id='tempcc' value='"+data[index]['commodity_id']+"'>" +
												"BARANG: "+data[index]['commodity_name']+" || KEMASAN: "+data[index]['package_name'] +
											"</option>";					
							$('#DTL_CMDTY_ID').append(options);	
						}

						$.unblockUI();
					}
				});			

			});

		///////////////////////////////////////////
		///			END LOAD DATA - AJAX		///
		///////////////////////////////////////////

	});

	function add_detail() {
		counterDetail++;
		var TYPE_KEGIATAN		= $('#TYPE_KEGIATAN').val();
		var TRUCK_LOSING		= $('#TRUCK_LOSING').val();
		var DTL_PKG_ID			= $('#DTL_PKG_ID').val();
		var DTL_CMDTY_ID		= $('#DTL_CMDTY_ID').val();
		var DTL_SIZE_ID			= $('#DTL_SIZE_ID').val();
		var DTL_TYPE_ID			= $('#DTL_TYPE_ID').val();
		var DTL_STATUS_ID		= $('#DTL_STATUS_ID').val();
		var DTL_UNIT_ID			= $('#DTL_UNIT_ID').val();
		var DTL_CHARACTER_ID	= $('#DTL_CHARACTER_ID').val();
		var DTL_QTY				= $('#DTL_QTY').val();
		
		var TYPE_KEGIATAN_NAME = TYPE_KEGIATAN == 'not-selected' ? '' : $('#TYPE_KEGIATAN option:selected').text();
		var TRUCK_LOSING_NAME = TRUCK_LOSING == 'not-selected' ? '' : $('#TRUCK_LOSING option:selected').text();
		var DTL_PKG_ID_NAME = DTL_PKG_ID == 'not-selected' ? '' : $('#DTL_PKG_ID option:selected').text();
		var DTL_UNIT_ID_NAME = DTL_UNIT_ID == 'not-selected' ? '' : $('#DTL_UNIT_ID option:selected').text();
		var DTL_SIZE_ID_NAME = DTL_SIZE_ID == 'not-selected' ? '' : $('#DTL_SIZE_ID option:selected').text();
		var DTL_TYPE_ID_NAME = DTL_TYPE_ID == 'not-selected' ? '' : $('#DTL_TYPE_ID option:selected').text();
		var DTL_STATUS_ID_NAME = DTL_STATUS_ID == 'not-selected' ? '' : $('#DTL_STATUS_ID option:selected').text();
		var DTL_CMDTY_ID_NAME = DTL_CMDTY_ID == 'not-selected' ? '' : $('#DTL_CMDTY_ID option:selected').text();
		var DTL_CHARACTER_ID_NAME = DTL_CHARACTER_ID == 'not-selected' ? '' : $('#DTL_CHARACTER_ID option:selected').text();

		$('#TYPE_KEGIATAN').prop('selectedIndex',0);
		$('#TRUCK_LOSING').prop('selectedIndex',0);
		$('#DTL_PKG_ID').prop('selectedIndex',0);
		$('#DTL_CMDTY_ID').prop('selectedIndex',0);
		$('#DTL_SIZE_ID').prop('selectedIndex',0);
		$('#DTL_TYPE_ID').prop('selectedIndex',0);
		$('#DTL_STATUS_ID').prop('selectedIndex',0);
		$('#DTL_UNIT_ID').prop('selectedIndex',0);
		$('#DTL_CHARACTER_ID').prop('selectedIndex',0);
		$('#DTL_QTY').val('');

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
				'<td class="TBL_DTL_QTY">'+ DTL_QTY +'</td>' +
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail"><i class="fa fa-trash-o"></i></a>' +
				'</td>' +
			'</tr>'
		);	
	}

	function add_rental() {
		counterRental++;
		var EQ_TYPE_ID			= $('#EQ_TYPE_ID_RENT').val();
		var EQ_UNIT_ID			= $('#EQ_UNIT_ID_RENT').val();
		var EQ_QTY				= $('#EQ_QTY_RENT').val();
		var PACKAGE_ID			= $('#PACKAGE_ID_RENT').val();
		
		$('#detail-rental').append(
		
			'<tr>' +
				'<td class="TBL_EQ_TYPE_ID" style="display:none;">'+ EQ_TYPE_ID +'</td>' +
				'<td class="TBL_EQ_TYPE_NAME">'+ $('#EQ_TYPE_ID_RENT option:selected').text() +'</td>' +
				'<td class="TBL_EQ_UNIT_ID" style="display:none;">'+EQ_UNIT_ID +'</td>' +
				'<td class="TBL_EQ_UNIT_NAME">'+ $('#EQ_UNIT_ID_RENT option:selected').text() +'</td>' +
				'<td class="TBL_EQ_QTY">'+ EQ_QTY +'</td>' +
				'<td class="TBL_PACKAGE_ID" style="display:none;">'+ PACKAGE_ID +'</td>' +
				'<td class="TBL_PACKAGE_NAME">'+ $('#PACKAGE_ID_RENT option:selected').text() +'</td>' +
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail-rental"><i class="fa fa-trash-o"></i></a>' +
				'</td>' +
			'</tr>'
		);	
	}

	function add_retribution() {
		counterRetribution++;
		var EQ_TYPE_ID		= $('#EQ_TYPE_ID_RETRI').val();
		var EQ_UNIT_ID		= $('#EQ_UNIT_ID_RETRI').val();
		var EQ_QTY			= $('#EQ_QTY_RETRI').val();
		var PACKAGE_ID		= $('#PACKAGE_ID_RETRI').val();
		
		$('#detail-retribution').append(
		
			'<tr>' +
				'<td class="TBL_EQ_TYPE_ID" style="display:none;">'+ EQ_TYPE_ID +'</td>' +
				'<td class="TBL_EQ_TYPE_NAME">'+ $('#EQ_TYPE_ID_RETRI option:selected').text() +'</td>' +
				'<td class="TBL_EQ_UNIT_ID" style="display:none;">'+EQ_UNIT_ID +'</td>' +
				'<td class="TBL_EQ_UNIT_NAME">'+ $('#EQ_UNIT_ID_RETRI option:selected').text() +'</td>' +
				'<td class="TBL_EQ_QTY">'+ EQ_QTY +'</td>' +
				'<td class="TBL_PACKAGE_ID" style="display:none;">'+ PACKAGE_ID +'</td>' +
				'<td class="TBL_PACKAGE_NAME">'+ $('#PACKAGE_ID_RETRI option:selected').text() +'</td>' +
				'<td>' +
					'<a class="btn btn-primary btn-delete-detail-retribution"><i class="fa fa-trash-o"></i></a>' +
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
			var truck_losing 	= $(this).find('.TBL_TRUCK_LOSING').html();
			var pkg_id 			= $(this).find('.TBL_DTL_PKG_ID').html();  
			var cmdty_id		= $(this).find('.TBL_DTL_CMDTY_ID').html();
			var size_id 		= $(this).find('.TBL_DTL_SIZE_ID').html(); 
			var type_id 		= $(this).find('.TBL_DTL_TYPE_ID').html();
			var status_id 		= $(this).find('.TBL_DTL_STATUS_ID').html();  
			var unit_id			= $(this).find('.TBL_DTL_UNIT_ID').html();  
			var character_id 	= $(this).find('.TBL_DTL_CHARACTER_ID').html();  
			var qty				= $(this).find('.TBL_DTL_QTY').html(); 			

			var temp = {
				"DTL_BL": (no_bl != 'not-selected') ? no_bl : '',
				"DTL_PKG_ID": (pkg_id != 'not-selected') ? pkg_id : '',
				"DTL_CMDTY_ID": (cmdty_id != 'not-selected') ? cmdty_id : '',
				"DTL_CHARACTER": (character_id != 'not-selected') ? character_id : '',
				"DTL_CONT_SIZE": (size_id != 'not-selected') ? size_id : '',
				"DTL_CONT_TYPE": (type_id != 'not-selected') ? type_id : '',
				"DTL_CONT_STATUS": (status_id != 'not-selected') ? status_id : '',
				"DTL_UNIT_ID": (unit_id != 'not-selected') ? unit_id : '',
				"DTL_QTY": qty,
				"DTL_TL": (truck_losing != 'not-selected') ? truck_losing : '',
				"DTL_DATE_IN": $('#DATE_IN').val(),
				"DTL_DATE_OUT": $('#DATE_OUT').val()
			}
			details.push(temp);
		});

		$('#detail-rental tbody tr').each(function(){
			var eq_type_id 	= $(this).find('.TBL_EQ_TYPE_ID').html(); 
			var eq_qty 		= $(this).find('.TBL_EQ_QTY').html();
			var eq_unit_id 	= $(this).find('.TBL_EQ_UNIT_ID').html();  
			var eq_pkg_id	= $(this).find('.TBL_PACKAGE_ID').html(); 

			var temp = {
				"EQ_TYPE_ID": eq_type_id,
				"EQ_QTY": eq_qty,
				"EQ_UNIT_ID": eq_unit_id,
				"EQ_GTRF_ID": "12",
				"EQ_PKG_ID": eq_pkg_id
			}
			alats.push(temp);
		});

		$('#detail-retribution tbody tr').each(function(){
			var eq_type_id 	= $(this).find('.TBL_EQ_TYPE_ID').html(); 
			var eq_qty 		= $(this).find('.TBL_EQ_QTY').html();
			var eq_unit_id 	= $(this).find('.TBL_EQ_UNIT_ID').html();  
			var eq_pkg_id	= $(this).find('.TBL_PACKAGE_ID').html(); 

			var temp = {
				"EQ_TYPE_ID": eq_type_id,
				"EQ_QTY": eq_qty,
				"EQ_UNIT_ID": eq_unit_id,
				"EQ_GTRF_ID": "13",
				"EQ_PKG_ID": eq_pkg_id
			}
			alats.push(temp);
		});

		arrData = 
			{
				"action": "getSimulasiTarif",
				"HEADER": {
					"P_NOTA_ID": ($('#BOOKING_TYPE').val() != 'not-selected') ? $('#BOOKING_TYPE').val() : '',
					"P_BRANCH_ID": "12",
					"P_CUSTOMER_ID": "<?=$this->session->userdata('custid_phd')?>",
					"P_BOOKING_NUMBER": booking_number,
					"P_TRADE": ($('#TRADE_TYPE').val() != 'not-selected') ? $('#TRADE_TYPE').val() : '',
					"P_REALIZATION": "N",
					"P_USER_ID": "<?=$this->session->userdata('userid_simop')?>"
				},
				"DETAIL": (details.length > 0) ? details : [],
				"EQUIP": (alats.length > 0) ? alats : []
			}
	
		console.log(arrData);

		$.blockUI();

		$.ajax({
			url: "<?=ROOT?>npkbilling/tarif_simulation/get_tarif_simulation",
			type: 'POST',
			dataType: 'json',
			data: { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				data: JSON.stringify(arrData)
			},
			success: function( data ) {
				// resp = JSON.parse(data.data);
				// console.log(resp);
				console.log(data);
				if (data.success === 'S') {
					var notification = new NotificationFx({
						message : '<p>Data Berhasil Dikalkulasi</p><br/>',
						layout : 'growl',
						effect : 'jelly',
						type : 'success' // notice, warning, error or success
					}); 

					setTimeout(function(){ 
						notification.dismiss();	
					}, 3000);

					$.unblockUI();	
				} else {
					// var notification = new NotificationFx({
					// 	message : '<p>Data Gagal Disimpan</p><br/>',
					// 	layout : 'growl',
					// 	effect : 'jelly',
					// 	type : 'error' // notice, warning, error or success
					// });
					$.unblockUI();
					alert('Data Gagal Disimpan;');
					// setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/request_lumpsum"; }, 3000);
				}
			}
		});	
	}

</script>

