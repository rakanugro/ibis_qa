
<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$FILENAME.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
<tr>
	<td colspan=4 align="left">PT. IPC TERMINAL PETIKEMAS</td>
	<td colspan=4 align="right">Periode : <?echo $trx_date." s/d ".$trx_date1;?></td>
</tr>
<tr>
	<td colspan=4 align="left"></td>
	
</tr>

			<tr>
				<th colspan=8>
					<i>Laporan E-Care E-Service</i>
				</th>
				</tr>
				<tr>
				<th colspan=8>
					<?=$custname;?>
				</th>
			</tr>
				<tr>
				<th colspan=8>
					<?//=$terminal;?>
				</th>
				</tr>
		</table>
		<br>
		<table border="1">
		  <tr>
			<th>No.</th>
			<th>Nama Pengguna Jasa</th>
			<th>Nomor Tiket</th>
			<th>Judul Permasalahan</th>
			<th>Isi Permasalahan</th>
			<th>Status</th>
			<th>Tanggal Pengajuan</th>
			<th>Tanggal Penyelesaian</th>
		  </tr>
<?php 
$i = 1;
foreach ($data as $row) {
    ?>
                    <tr>
                        <td><?=$i ?></td>
                        <td><?=$row->customer_name ?></td>
                        <td><?=$row->ticket_number ?></td>
                        <td><?=$row->ticket_title ?></td>
                        <td><?=$row->ticket_message ?></td>
                        <td><?=$row->ticket_status ?></td>
						<td style="mso-number-format:'@';"><?=$row->submit_date ?></td>
						<td style="mso-number-format:'@';"><?=$row->closed_date ?></td>
                    </tr>
    <?php
    $i++;
}
?>
</table>
