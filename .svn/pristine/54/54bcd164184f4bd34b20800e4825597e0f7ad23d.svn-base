
<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$FILENAME.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
<tr>
	<td colspan=6 align="left">PT. IPC TERMINAL PETIKEMAS</td>
	<td colspan=5 align="right">Tgl Proses : <?=date('d-M-Y H:i');?></td>
</tr>
<tr>
	<td colspan=6 align="left"></td>
	
</tr>

			<tr>
				<th colspan=11>
					<i>Laporan Harian Penerbitan Nota BANK LUNAS</i>
				</th>
				</tr>
				<tr>
				<th colspan=11>
					<?=$terminal;?>
				</th>
				</tr>
		</table>
		<br>
		<table border="1">
		  <tr>
			<th>No.</th>
			<th>Payment Code</th>
			<th>Invoice</th>
			<th>No. Dokumen</th>
			<th>Customer</th>
			<th>Curr</th>
			<th>Tgl Lunas</th>
			<th>Layanan</th>
			<th>No. Pajak</th>
			<th>Pendapatan</th>
			<th>PPN</th>
			<th>Total</th>
			<th>Bank</th>
		  </tr>
<?php 
$i = 1;
foreach ($data as $row) {
    ?>
                    <tr>
                        <td><?=$i ?></td>
                        <td style="mso-number-format:\@"><?=$row->payment_code ?></td>
                        <td style="mso-number-format:\@"><?=$row->no_nota ?></td>
                        <td><?=$row->no_request ?></td>
                        <td><?=$row->cust_name ?></td>
                        <td><?=$row->sign_currency ?></td>
                        <td><?=$row->date_paid ?></td>
                        <td><?=$row->description ?></td>
                        <td style="mso-number-format:\@"><?=$row->no_faktur_pajak ?></td>
                        <td><?=$row->total ?></td>
                        <td><?=$row->ppn ?></td>
                        <td><?=$row->kredit ?></td>
                        <td><?=$row->receipt_account ?></td>
                    </tr>
    <?php
    $i++;
}
?>
</table>
