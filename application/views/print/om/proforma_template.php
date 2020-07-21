<?
//var_dump($vars);die;
?>
<table width="100%"><tr><td>
	<table  border="0" cellspacing="0" cellpadding="0">
	<tr>
                    <td width="120"></td><td COLSPAN="12" align="left"><font size="12"><b><?=$vars['HOLDING'];?> | <?=$vars['COMPANY'];?></b></font></td>
                </tr>
                <tr>
                    <td width="120"></td><td COLSPAN="12" align="left"><b></b></td>
                </tr>
                <tr>
                    <td width="120"></td><td COLSPAN="12" align="left"><b>NPWP :</b></td>
                </tr>
							                <tr>
                <td></td>
                </tr>
				<tr>
                    <td COLSPAN="15" align="center"><font size="14"><b>PROFORMA</b></font></td>
                </tr>
	</table>
	<br/>
	<br/>
	<br/>
	<br/>
	<table  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td COLSPAN="2">Customer </td>
			<td width="10px">:</td>
			 <td COLSPAN="5" align="left"><?=$vars['CUST_NAME'];?></td>
			 <td colspan="2" ></td>
            <td colspan="4" align="right" ></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">Vessel - Voyage</td>
			<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['VESSEL'];?> <?=$vars['VOY_IN'];?>/<?=$vars['VOY_OUT'];?></td>
			 <td colspan="2" ></td>
            <td colspan="4" align="right" ></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">BL Number - Date</td>
			<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['BL_NUMBER'];?> - <?=$vars['BL_DATE'];?></td>
			<td colspan="2" ></td>
            <td colspan="4" align="right" ></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">Movement Type</td>
			<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['SERVICETYPE_NAME'];?></td>
			<td colspan="2" ></td>
            <td colspan="4" align="right" ></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">Period Date</td>
			<td width="10px">:</td>
			<td  width="280" align="left"><?=$vars['TRX_DATE'];?></td>
			<td colspan="2" ></td>
            <td colspan="4" align="right" ></td>
		  </tr>
		  <tr>
			<td width="130">&nbsp;</td>
			<td width="5"></td>
			<td width="280" align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td width="130">&nbsp;</td>
			<td width="5"></td>
			<td width="280" align="left">&nbsp;</td>
		  </tr>
	</table>
	<table border="0" cellspacing="0" cellpadding="0">
	 <tr>
                    <td colspan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="710">
                    </td>
                </tr>
		<tr align="center">
			<th colspan="3" width="150"><font size="8"><b>Keterangan</b></font></th>
                    <th width="100" align="left"><font size="8"><b>Cargo Name</b></font></th>
                    <th width="65" align="center"><font size="8"><b>Qty</b></font></th>
                    <th width="65" align="center"><font size="8"><b>Unit</b></font></th>
                    <th width="65" align="center"><font size="8"><b>Start<br/>End</b></font></th>
                    <th width="65" align="center"><font size="8"><b>Hari</b></font></th>
                    <th width="80" colspan="2" align="center"><font size="8"><b>Tarif</b></font></th>
                    <th width="115"  align="center"><font size="8"><b>Total</b></font></th>
		</tr>
	     <tr>
                    <td colspan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="710">
                    </td>
                </tr>
	<?php
		$i = 1;
		foreach ($vars['detail'] as $d){
	?>
		<tr>
			<td width="150" align="center"><?=$d['JENIS_BIAYA'];?>&nbsp;</td>
			<td width="100"><?=$d['CARGO_NAME'];?>&nbsp;</td>
			<td width="65" align="center"><?=$d['QTY'];?>&nbsp;</td>
			<td width="65" align="center"><?=$d['UNITTYPE'];?>&nbsp;</td>
			<td width="65" align="center"><?=$d['STACKIN_DATE'];?>&nbsp;<br/><?=$d['STACKOUT_DATE'];?>&nbsp;</td>
			<td width="60" align="center"><?=$d['TOTHR']?>&nbsp;</td>
			<td width="80" align="center"><? $trf = number_format($d['TARIFF']);echo $trf;?>&nbsp;</td>
			<td width="115" align="center"><?=number_format($d['TOTAL_TARIFF']);?>&nbsp;</td>
		</tr>
	<?php
		}
	?>	
	 <tr>
                    <td colspan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="710">
                    </td>
                </tr>
	</table>
	<br />
	<br />
	<br />
<table style="page-break-inside: avoid;">  
		<tr>
		  <td colspan="7" rowspan="7"><img height="125" width="125" src="$barcode_location" /></td>
                        <td width="195" colspan="3" align="right"><font size="10">ADMINITRASI :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10"><?=number_format($vars['ADMINISTRASI']);?>&nbsp;</font></td>
		</tr>

		<tr>
		  <td width="195" colspan="3" align="right"><font size="10">JUMLAH :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10"><?=number_format($vars['SUBTOTAL']);?>&nbsp;</font></td>
		</tr>
	<?if($vars['TARIF_MINIMUM'] > $vars['SUBTOTAL']){?>
		<tr>
		  <td width="195" colspan="3" align="right"><font size="10">TARIF MINIMUM :</font></td>
          <td width="120" colspan="2" align="right"><font size="10"><?=number_format($vars['TARIF_MINIMUM']);?>&nbsp;</font></td>
		</tr>
	<?}?>
		<tr>
		 <td width="195" colspan="3" align="right"><font size="10">PPN 10 % :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10"><?=number_format($vars['PPN']);?>&nbsp;</font></td>
		</tr>
		<tr>
		<td width="195" colspan="3" align="right"><font size="10">MATERAI :</font></td>
        <td width="120" colspan="2" align="right"><font size="10"><?=number_format($vars['MATERAI']);?>&nbsp;</font></td>
		</tr>
		<tr>
		  <td width="195" colspan="3" align="right"><font size="10">JUMLAH TAGIHAN :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10"><?=number_format($vars['TOTAL']);?>&nbsp;</font></td>
		</tr>	
		<tr>
		  <td width="430" align="right" colspan="2">&nbsp;</td>
		</tr>
	  </table>
	  <br /><br />
	  <table border="0">
	<tr height="20">
					<td width="100%"><p>#<?=$vars['TERBILANG'];?></p></td>
					</tr>
					<tr>
					<td width="100%">
					<p>USER : <?=$vars['USER_CREATED'];?></p>
					</td>
					</tr>
					<tr>
					<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="2">&nbsp;</td>
					</tr>
					<tr align="center" height="50">
					<td align="center" width="350">
					Banten,<?=date('d M Y');?><br>
					<br>
					<br>
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img width="85px" /><br>
					
					<?=$vars['MGR1_NAME'];?>
					<BR/>
					(-----------------------------------)
					</td>
					<td align="center" width="350">
					Banten,<?=date('d M Y');?><br>
					<br>
					<br>
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img width="85px" /><br>
					
					<?=$vars['MGR2_NAME'];?>
					<BR/>
					(-----------------------------------)
					</td>
					</tr>
					<tr>
			<td width="160" align="right">NIPP :</td>
			<td width="135" align="left"><?=$vars['MGR1_NIPP'];?></td>
			<td width="220" align="right">NIPP :</td>
			<td width="135" align="left"><?=$vars['MGR2_NIPP'];?></td>
		</tr>
	</table>
</td></tr></table>