<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename={$filename}.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<div class="row" id="gridRequest">
	<div class="col-lg-12">
		<div class="main-box clearfix">


			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table id="mastertable" class="table table-hover">
						<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">Tgl Transaksi</th>
								<th rowspan="2">Total Trx</th>
								<th rowspan="2">Jumlah</th>
								<th colspan="2">Bank BNI</th>
								<th colspan="2">Bank Mandiri</th>
								<th colspan="2">Bank BRI</th>
								<th rowspan="2">Receipt</th>
								<th rowspan="2">Receipt Null</th>
							</tr>
							<tr>
								<th>Qty</th>
								<th>Amount</th>
								<th>Qty</th>
								<th>Amount</th>
								<th>Qty</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody id=show_data>
							<?php foreach ($list as $data) : ?>
								<tr>
									<th><?php echo $data['id']; ?> </th>
									<th><?php echo (string) date('d-m-Y H:i:s', strtotime($data['trx_date'])); ?> </th>
									<th><?php echo 'Rp ' . format_rupiah(str_replace(',', '', $data['total_trx'])); ?> </th>
									<th><?php echo $data['jumlah']; ?> </th>
									<th><?php echo $data['bni_qty']; ?> </th>
									<th><?php echo $data['bni_amount']; ?> </th>
									<th><?php echo $data['bri_qty']; ?> </th>
									<th><?php echo $data['bri_amount']; ?> </th>
									<th><?php echo $data['mandiri_qty']; ?> </th>
									<th><?php echo $data['mandiri_amount']; ?> </th>
									<th><?php echo $data['receipt']; ?> </th>
									<th><?php echo $data['receipt_null']; ?> </th>
								<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
