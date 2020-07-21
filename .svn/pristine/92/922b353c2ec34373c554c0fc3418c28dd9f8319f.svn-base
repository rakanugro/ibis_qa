
<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$FILENAME.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
<tr>
	<td colspan=3 align="left">PT. IPC TERMINAL PETIKEMAS</td>
	<td colspan=3 align="right">Periode : <?echo $trx_date." s/d ".$trx_date1;?></td>
</tr>
<tr>
	<td colspan=3 align="left"></td>
	
</tr>

			<tr>
				<th colspan=6>
					<i>Laporan Periodik Revenue E-Service</i>
				</th>
				</tr>
				<tr>
				<th colspan=6>
					<?=$terminal;?>
				</th>
				</tr>
				<tr>
				<th colspan=6>
					<?=$custname;?>
				</th>
			</tr>
		</table>
		<br>
		<table border="1">
		  <tr>
			<th>No.</th>
			<th>Nama Pengguna Jasa</th>
			<th>Receiving</th>
			<th>Delivery</th>
			<th>Loading Cancel</th>
			<th>Delivery Extension</th>
		  </tr>
<?php 
$i = 1;
foreach ($data as $row) {
    ?>
                    <tr>
                        <td><?=$i ?></td>
                        <td><?=$row->customer_name ?></td>
                        <td><?=$row->receiving ?></td>
                        <td><?=$row->delivery ?></td>
                        <td><?=$row->load_cancel ?></td>
						<td><?=$row->delivery_ext ?></td>
                    </tr>
    <?php
    $i++;
}
?>
</table>
