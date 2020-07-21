<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1>Customer Rank</h1>
<table class="fullwidth" border="1">
<thead>
	<td>No</td>
	<td>Customer ID</td>
	<td>Nama Perusahaan</td>
	<td>Registration Branch</td>
	<td>Throughput (TEUs)</td>
	<td>Revenue (IDR)</td>
</thead>
<tbody>
<?php
	foreach($data_table as $d){
		?>
	<tr>
		<td><?php echo $d['NO']?></td>
		<td><?php echo $d['ID']?></td>
		<td><?php echo $d['NAME']?></td>
		<td><?php echo $d['BRANCH']?></td>
		<td><?php echo $d['TRGH']?></td>
		<td><?php echo $d['REV']?></td>
	</tr>
		<?php
	}
?>
</tbody>
</table>
