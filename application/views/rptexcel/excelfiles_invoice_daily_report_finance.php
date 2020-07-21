
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
				<tr>
				<th colspan=11>
					Layanan <?=$service;?>
				</th>
				</tr>				
		</table>
		<br>
		<table border="1">
		  <tr>
			<th>NO</th>
			<th>PAYMENT CODE</th>
			<th>PAID VIA</th>
			<th>ID NOTA</th>
			<th>ID REQ</th>
			<th>TAGIHAN</th>
			<th>PPN</th>
			<th>TOTAL</th>
			<th>TGL REQ</th>
			<th>TGL PAYMENT</th>
			<th>VESSEL</th>
			<th>VOYAGE IN</th>
			<th>VOYAGE OUT</th>
			<th>BIAYA ADM</th>
			<th>BIAYA MATERAI</th>
			<th>BIAYA BATAL MUAT</th>
			<th>BIAYA BATAL DOKUMEN</th>
			<th>BIAYA LOLO</th>
			<th>BIAYA MASA 1 1</th>
			<th>BIAYA MASA 1 2</th>
			<th>BIAYA MASA 2</th>
			<th>CONTAINERS</th>
		  </tr>
<?php 
$i = 1;
foreach ($data as $row) {
    ?>
                    <tr>
                        <td><?=$i ?></td>
						<td style="mso-number-format:\@"><?=$row->PAYMENT_CODE ?></td>
						<td><?=$row->PAID_VIA ?></td>
						<td style="mso-number-format:\@"><?=$row->ID_NOTA ?></td>	
						<td><?=$row->ID_REQ ?></td>
						<td><?=$row->TAGIHAN ?></td>
						<td><?=$row->PPN ?></td>
						<td><?=$row->TOTAL ?></td>
						<td style="mso-number-format:\@"><?=$row->TGL_REQ ?></td>
						<td style="mso-number-format:\@"><?=$row->TGL_PAYMENT ?></td>
						<td><?=$row->VESSEL ?></td>
						<td><?=$row->VOYAGE_IN ?></td>
						<td><?=$row->VOYAGE_OUT ?></td>
						<td><?=$row->BIAYA_ADM ?></td>
						<td><?=$row->BIAYA_MATERAI ?></td>
						<td><?=$row->BIAYA_BATAL_MUAT ?></td>
						<td><?=$row->BIAYA_BATAL_DOKUMEN ?></td>
						<td><?=$row->BIAYA_LOLO ?></td>
						<td><?=$row->BIAYA_MASA_1_1 ?></td>
						<td><?=$row->BIAYA_MASA_1_2 ?></td>
						<td><?=$row->BIAYA_MASA_2 ?></td>
						<td><?=$row->CONTAINERS ?></td>
                    </tr>
    <?php
    $i++;
}
?>
</table>
