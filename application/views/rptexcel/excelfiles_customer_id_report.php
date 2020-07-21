
<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$FILENAME.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
<tr>
	<td colspan=5 align="left">PT. IPC TERMINAL PETIKEMAS</td>
	<td colspan=4 align="right">Tgl Proses : <?=date('d-M-Y H:i');?></td>
</tr>
<tr>
	<td colspan=5 align="left"></td>
	
</tr>

			<tr>
				<th colspan=9>
					<i>Laporan Data Customer E Service</i>
				</th>
				</tr>
				<tr>
				<th colspan=9>
					<?//$terminal;?>
				</th>
				</tr>
		</table>
		<br>
		<table border="1">
		  <tr>
			<th>No.</th>
			<th>Customer Id</th>
			<th>Nama Pengguna Jasa</th>
			<th>Alamat</th>
			<th>NPWP</th>
			<th>Jenis Perusahaan</th>
			<th>Nomor Telepon</th>
			<th>User List</th>
			<th>Aktivitas User</th>
		  </tr>
<?php 
$i = 1;
foreach ($data as $row) {
    ?>
                    <tr>
                        <td><?=$i ?></td>
                        <td style="mso-number-format:'@';"><?=$row->customer_id ?></td>
                        <td><?=$row->customer_name ?></td>
                        <td><?=$row->address ?></td>
                        <td><?=$row->npwp ?></td>
                        <td><?=$row->jenis_perusahaan ?></td>
                        <td style="mso-number-format:'@';"><?=$row->phone ?></td>
						<td><?=$row->user_list ?></td>
						<td><?=$row->aktivitas ?></td>
                    </tr>
    <?php
    $i++;
}
?>
</table>
