
<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$FILENAME.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
<tr>
	<td colspan=5 align="left">PT. IPC TERMINAL PETIKEMAS</td>
	<td colspan=5 align="right">Periode : <?echo $trx_date." s/d ".$trx_date1;?></td>
</tr>
<tr>
	<td colspan=5 align="left"></td>
	
</tr>

			<tr>
				<th colspan=10>
					<i>Laporan Periodik Troughput E-Service</i>
				</th>
				</tr>
				<tr>
				<th colspan=10>
					<?=$terminal;?>
				</th>
				</tr>
				<tr>
				<th colspan=10>
					<?=$custname;?>
				</th>
			</tr>
		</table>
		<br>
		<table border="1">
		  <tr>
			<th rowspan=2>No.</th>
			<th rowspan=2>Nama Pengguna Jasa</th>
			<th colspan=2>Receiving</th>
			<th colspan=2>Delivery</th>
			<th colspan=2>Loading Cancel</th>
			<th colspan=2>Delivery Extension</th>
		  </tr>
		  <tr>
			<th>20</th>
			<th>40</th>
			<th>20</th>
			<th>40</th>
			<th>20</th>
			<th>40</th>
			<th>20</th>
			<th>40</th>
		  </tr>
<?php 
$i = 1;
foreach ($data as $row) {
    ?>
                    <tr>
                        <td><?=$i ?></td>
                        <td><?=$row->customer_name ?></td>
                        <td><?=$row->receiving_20 ?></td>
                        <td><?=$row->receiving_40 ?></td>
                        <td><?=$row->delivery_20 ?></td>
                        <td><?=$row->delivery_40 ?></td>
                        <td><?=$row->load_cancel_20 ?></td>
						<td><?=$row->load_cancel_40 ?></td>
						<td><?=$row->delivery_ext_20 ?></td>
						<td><?=$row->delivery_ext_40 ?></td>
                    </tr>
    <?php
    $i++;
}
?>
</table>
