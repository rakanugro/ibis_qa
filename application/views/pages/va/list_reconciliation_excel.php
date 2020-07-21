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
								<th>Kode Bayar</th>
								<th>Nama Cabang</th>
								<th>Bank</th>
								<th>Status Bank</th>
								<th>Status Merchant</th>
								<th>Jumlah Tagihan</th>
								<th>No Receipt</th>
							</tr>
						</thead>
						<tbody id=show_data>
							<?php foreach ($list as $data) : ?>
								<tr>
									<th><?php echo $data['id']; ?> </th>
									<th><?php echo (string) date('d-m-Y', strtotime($data['trx_date'])); ?> </th>
									<th><?php echo (string) $data['payment_code']; ?> </th>
									<th><?php echo $data['biller']; ?> </th>
									<th><?php echo $data['bank_name']; ?> </th>
									<th><?php echo $data['status_bank'] == 'S' ? 'Success' : $data['status_bank']; ?> </th>
									<th><?php echo $data['status_merchant']; ?> </th>
									<th><?php echo 'Rp ' . format_rupiah(str_replace(',', '', $data['amount'])); ?> </th>
									<th><?php echo $data['jkm_number']; ?> </th>
								<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
