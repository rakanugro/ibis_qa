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
								<th>No</th>
								<th>Tgl Transaksi</th>
								<th>No Pelanggan</th>
								<th>Bank</th>
								<th>No JKM</th>
								<th>Status Pembayaran</th>
								<th>Status Merchant</th>
								<th>Jumlah Tagihan</th>
								<th>Payment Code</th>
							</tr>
						</thead>
						<tbody id=show_data>
							<?php foreach ($list as $data) : ?>
								<tr>
									<th><?php echo $data['id']; ?> </th>
									<th><?php echo (string) date('d-m-Y H:i:s', strtotime($data['trx_date'])); ?> </th>
									<th><?php echo $data['customer']; ?> </th>
									<th><?php echo $data['bank_name']; ?> </th>
									<th><?php echo $data['jkm_number']; ?> </th>
									<th><?php echo $data['status_payment']; ?> </th>
									<th><?php echo $data['status_merchant']; ?> </th>
									<th><?php echo $data['amount'] == '' ? 'Rp. 0' : 'Rp ' . format_rupiah(str_replace(',', '', $data['amount'])); ?> </th>
									<th><?php echo (string) $data['payment_code']; ?> </th>
								<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
