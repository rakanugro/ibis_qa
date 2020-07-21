
<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$FILENAME.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
<tr>
	<td colspan=3 align="left">PT. IPC TERMINAL PETIKEMAS</td>
	<td colspan=2 align="right">Periode : <?echo $trx_date." s/d ".$trx_date1;?></td>
</tr>
<tr>
	<td colspan=3 align="left"></td>
	
</tr>

			<tr>
				<th colspan=5>
					<i>Laporan Periodik Response Time per Request E-Service</i>
				</th>
				</tr>
				<tr>
				<th colspan=5>
					<?=$terminal;?>
				</th>
				</tr>
				<tr>
				<th colspan=5>
					<?=$custname;?>
				</th>
			</tr>
		</table>
		<br>
		<table border="1">
		  <tr>
			<th>No.</th>
			<th>Nama Pengguna Jasa</th>
			<th>No Request</th>
			<th>Jenis</th>
			<th>Response Time</th>
		  </tr>
<?php 
$i = 1;
foreach ($data as $row) {
    ?>
                    <tr>
                        <td><?=$i ?></td>
                        <td><?=$row->customer_name ?></td>
                        <td><?=$row->request ?></td>
                        <td><?=$row->modul ?></td>
                        <td><?=$row->response_time ?></td>
                    </tr>
    <?php
    $i++;
}
?>
</table>
