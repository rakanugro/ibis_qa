<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
			</header>
			
			<div class="main-box-body clearfix">
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Nomor Request</label>
					<input name="LUMPS_NO" id="LUMPS_NO" type="text" class="form-control" placeholder="Nomor Request" value="<?=$lumpsum_views['HEADER'][0]->lumps_no?>" readonly>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Nama Customer</label>
					<input name="LUMPS_CUST_NAME" id="LUMPS_CUST_NAME" type="text" class="form-control" placeholder="Nama Customer" value="<?=$lumpsum_views['HEADER'][0]->lumps_cust_name?>" readonly>
				</div>
				<div class="form-group col-xs-6">
					<label for="datepickerDate">Tanggal Request</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						<input id="LUMPS_DATE" name="LUMPS_DATE" type="text" class="form-control" value="<?=$lumpsum_views['HEADER'][0]->lumps_date?>" readonly>
					</div>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">Nomor Kontrak</label>
					<input name="LUMPS_CONTRACT_NO" id="LUMPS_CONTRACT_NO" type="text" class="form-control" value="<?=$lumpsum_views['HEADER'][0]->lumps_contract_no?>" readonly>
				</div>
				<div class="form-group col-xs-6">
					<label for="exampleTooltip">NPWP Customer</label>
					<input name="CUST_ADDRESS" id="NPWP_CUST" type="text" class="form-control" value="<?=$lumpsum_views['HEADER'][0]->lumps_cust_npwp?>" readonly>
                </div>
                <div class="form-group col-xs-6">
					<label for="exampleTooltip">Alamat Customer</label>
					<input name="CUST_NPWP" id="CUST_NPWP" type="text" class="form-control" value="<?=$lumpsum_views['HEADER'][0]->lumps_cust_address?>" readonly>
				</div>
				<div class="form-group col-xs-12">
					<label>Tipe Kegiatan</label>
					<select id="LUMPS_BOOKING_TYPE" name="LUMPS_BOOKING_TYPE" class="form-control" disabled>
						<option value="<?=$lumpsum_views['HEADER'][0]->lumps_booking_type?>"><?=$lumpsum_views['HEADER'][0]->lumps_booking_type_name?></option>
					</select>
					<input type="hidden" id="LUMPS_BOOKING_TYPE_NAME" name="LUMPS_BOOKING_TYPE_NAME" class="form-control">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 ">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail</b></h2>
			</header>

			<div class="main-box-body clearfix">
				<table class="table table-striped table-hover" id="list-detail">
					<?php $i = 0; foreach ($lumpsum_views['DETAIL'] as $dtl) { ?>
						<div class="form-group example-twitter-oss new-row">
							<div class="form-group col-xs-3">
								<label for="exampleTooltip">Nomor BL</label>
								<input name="DTL_BL1" id="DTL_BL1" type="text" class="form-control" value="<?=$lumpsum_views['DETAIL'][$i]->dtl_bl?>" readonly>
							</div>
							<div class="form-group col-xs-3">
								<label>Kemasan</label>
								<select id="DTL_PKG_ID1" name="DTL_PKG_ID1" class="form-control" disabled>
									<option value="<?=$lumpsum_views['DETAIL'][$i]->dtl_pkg_id?>"><?=$lumpsum_views['DETAIL'][$i]->dtl_pkg_name?></option>
								</select>
							</div>
							<div class="form-group col-xs-3">
								<label for="exampleTooltip">Quantity</label>
								<input name="DTL_QTY1" id="DTL_QTY1" type="number" class="form-control" value="<?=$lumpsum_views['DETAIL'][$i]->dtl_qty?>" readonly>
							</div>
							<div class="form-group col-xs-3">
								<label>Satuan</label>
								<select name="UNIT_ID" id="DTL_UNIT_ID1" class="form-control" disabled>
									<option value="<?=$lumpsum_views['DETAIL'][$i]->dtl_unit_id?>"><?=$lumpsum_views['DETAIL'][$i]->dtl_unit_name?></option>
								</select>
							</div>
						</div>
					<?php $i++; } ?>
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
					<button class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Back</button>					
				</div>
			</div>
		</div>
	</div>
</div>	

<script>
	function goBack() {
		window.history.back();
	}
</script>

