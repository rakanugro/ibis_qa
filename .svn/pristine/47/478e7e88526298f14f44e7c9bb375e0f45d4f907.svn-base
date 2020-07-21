
<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$FILENAME.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
 <h2>Report <?=$ACTION?> <?php //echo $supir[0]->nama_perusahaan ?></h2>
<table class="fullwidth">
<thead>
<tr>
<th>No</th>
<th>VESSEL</th><th>VOYAGE_IN</th><th>VOYAGE_OUT</th><th>NO_CONTAINER</th><th>SIZE</th><th>TYPE</th><th>STATUS</th><th>HZ</th><th>KODE_STATUS</th><th>POD</th><th>WEIGHT</th>
<th><? IF($TYPE=='I'){?>GATE_OUT<?}else ?>GATE_IN</th><th>NO_POL</th><th>YARD_ALLOCATION</th><th>DATE_PLACEMENT</th><th>YARD_PLACEMENT</th><th>BAY_PLAN</th><th><? IF($TYPE=='I'){?>DISCH_CONFIRM<?}ELSE?>LOADING_CONFIRM</th><th>CUSTOMER_NAME</th><th>NO_NOTA</th><th>NPE</th><th>PEB</th><th>SPPB</th>
</tr>
</thead>
<tbody>
<?
$row=1;
foreach ($data as $key) {?>
<tr>
<td><?=$row;?></td><td><?=$key->vessel_name;?></td><td><?=$key->voyage_in;?></td><td><?=$key->voyage_out;?></td><td><?=$key->no_container;?></td><td><?=$key->sz_cont;?></td>
<td><?=$key->ty_cont;?></td><td><?=$key->st_cont;?></td><td><?=$key->hz;?></td><td><?=$key->kode_status;?></td><td><?=$key->pod;?></td><td><?=$key->weight;?></td><td><? IF($TYPE=='I'){

echo $key->tgl_gate_out;}else{ echo $key->tgl_gate_in;}?></td><td><?=$key->nopol;?></td>
<td><?=$key->block_."-".$key->slot_."-".$key->row_;?></td><td><?=$key->tgl_placement;?></td><td><?=$key->block_."-".$key->slot_."-".$key->row_."-".$key->tier_;?></td><td><?=$key->bay;?></td><td><?=$key->date_confirm;?></td><td><?=$key->customer_name;?></td><td><?=$key->no_nota;?></td><td><?=$key->npe;?></td><td><?=$key->peb;?></td><td><?=$key->sppb;?></td>
</tr>
    <?
    $row++;
}
?>
</tbody>
</table>
