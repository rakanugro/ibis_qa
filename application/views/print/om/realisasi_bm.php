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
           <td COLSPAN="7"></td>
           <td COLSPAN="2" align="left" width="80px">No. Uper</td>
		   <td COLSPAN="1" align="left" width="10px">:</td>
           <td COLSPAN="2" align="left" width="170px"><?=$vars['NO_NOTA'];?></td>
          </tr>
		  
		<tr>
		  <td COLSPAN="7"></td>
           <td COLSPAN="2" align="left">Tgl. Uper</td>
			<td COLSPAN="1" align="left" width="10px">:</td>
           <td COLSPAN="2" align="left" width="170px"><?=date('d M Y');?></td>
		</tr>
		
		<?
			if (!empty($vars['NOTAPREV'])){?>
				  <tr>
					<td COLSPAN="7"></td>
           <td COLSPAN="2" align="left">Koreksi dari Nota</td>
			<td COLSPAN="1" align="left" width="10px">:</td>
           <td COLSPAN="2" align="left" width="170px"><?=$vars['NOTAPREV'];?></td>
				  </tr>
			<?php
			}
			?>
		   <tr>
			<td COLSPAN="7"></td>
           <td COLSPAN="2" align="left">No. Req</td>
			<td COLSPAN="1" align="left" width="10px">:</td>
           <td COLSPAN="2" align="left" width="170px"><?=$vars['ID_REQ'];?></td>
		  </tr>
		
		         <tr>
                <td></td>
                </tr>
	</table>

	  <div style="font-size:11pt" align="center"> <strong><?=$vars['TITLE'];?></strong><br /></div>
	<table  border="0" cellspacing="0" cellpadding="0">

		  <tr>
			<td COLSPAN="2">PEMILIK / PEMAKAI JASA</td>
			<td width="10px">:</td>
            <td COLSPAN="5" align="left"><?=$vars['CUST_NAME'];?></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">PEMILIK ALAMAT</td>
			<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['CUST_ADDR'];?></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">NPWP</td>
			<td width="10px">:</td>
		  <td COLSPAN="5" align="left"><?=$vars['CUST_NPWP'];?></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">NAMA KAPAL</td>
			<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['VESSEL'];?></td>
		  </tr>
				<tr>
			<td COLSPAN="2">VOYAGE</td>
			<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['VOYAGE'];?></td>
		  </tr>

		  <tr>
			<td COLSPAN="2">ETA / ETD</td>
				<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['ETA'];?> / <?=$vars['ETD'];?></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">KADE</td>
			<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['KADE'];?></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">KEGIATAN</td>
			<td width="10px">:</td>
			<td COLSPAN="5" align="left"><?=$vars['KEGIATAN'];?></td>
		  </tr>
		  <tr>
			<td COLSPAN="2">&nbsp;</td>
		<td width="10px"></td>
			<td COLSPAN="5" align="left">&nbsp;</td>
		  </tr>
	</table>
	<table border="1" cellspacing="0" cellpadding="0" align="center">
		<tr align="center">
			<td width="70"><strong>ACTIVITY</strong></td>
			<td width="20"><strong>NO</strong></td>
			<td width="70"><strong>NO BL</strong></td>
			<td width="120"><strong>JENIS BARANG</strong></td>
			<td width="50"><strong>KEMASAN</strong></td>
			<td width="30"><strong>QTY</strong></td>
			<td width="30"><strong>TON</strong></td>
			<td width="30"><strong>CUBIC</strong></td>
			<td width="30"><strong>HZ</strong></td>
			<td width="30"><strong>DS</strong></td>
			<td width="50"><strong>HSCODE</strong></td>
			<td width="30"><strong>TL</strong></td>
		</tr>
	<?php
		$i = 1;
		$jml = count($vars['detailImp']);
		$jmlex = count($vars['detailExp']);
		$jmleq = count($vars['detailEq']);
		foreach ($vars['detailImp'] as $d){
	?>
		<tr align="center">
			<?php if($i == 1) { ?>
				<td width="70" rowspan="<?=$jml?>"><?=$d['RPR_ACTIVITY'];?></td>
			<?php } ?>
			<td width="20"><?=$i++;?>&nbsp;</td>
			<td width="70"><?=$d['BL_NUMBER'];?></td>
			<td width="120" align="center">&nbsp;<?=$d['CARGO_NAME'];?></td>
			<td width="50"><?=$d['PKG_NAME'];?>&nbsp;</td>
			<td width="30" align="center"><?=$d['QTY'];?>&nbsp;</td>
			<td width="30" align="center"><?=$d['TON'];?>&nbsp;</td>
			<td width="30" align="center"><?=$d['CUBIC'];?>&nbsp;</td>
			<td width="30" align="center"><?=$d['HZ'];?>&nbsp;</td>
			<td width="30" align="center"><?=$d['DS'];?>&nbsp;</td>
			<td width="50" align="center"><?=$d['HS_CODE'];?>&nbsp;</td>
			<td width="30" align="center"><?=$d['TL_FLAG'];?>&nbsp;</td>
		</tr>
	<?php
		}
		$i = 1;
		foreach ($vars['detailExp'] as $dex){
	?>
			<tr align="center">
				<?php if($i == 1) { ?>
					<td width="70" rowspan="<?=$jml?>"><?=$dex['RPR_ACTIVITY'];?></td>
				<?php } ?>
				<td width="20"><?=$i++;?>&nbsp;</td>
				<td width="70"><?=$dex['BL_NUMBER'];?></td>
				<td width="120" align="center">&nbsp;<?=$dex['CARGO_NAME'];?></td>
				<td width="50"><?=$dex['PKG_NAME'];?>&nbsp;</td>
				<td width="30" align="center"><?=$dex['QTY'];?>&nbsp;</td>
				<td width="30" align="center"><?=$dex['TON'];?>&nbsp;</td>
				<td width="30" align="center"><?=$dex['CUBIC'];?>&nbsp;</td>
				<td width="30" align="center"><?=$dex['HZ'];?>&nbsp;</td>
				<td width="30" align="center"><?=$dex['DS'];?>&nbsp;</td>
				<td width="50" align="center"><?=$dex['HS_CODE'];?>&nbsp;</td>
				<td width="30" align="center"><?=$dex['TL_FLAG'];?>&nbsp;</td>
			</tr>
	<?php } ?>
	</table>
	<br />
	<br />
		<table cellspacing="0" cellpadding="0">
	<?php
		$n = 1;
		foreach ($vars['detailEq'] as $deq){
	?>
			<tr align="center">
				<td width="80" align="left"><?=$deq['EQ_NAME'];?></td>
				<td width="50" align="right"><?=$deq['UTIL'];?>&nbsp;</td>
				<td width="50"><?=$deq['UNIT'];?></td>
			</tr>
	<?php } ?>
	<tr>
		  <td width="430" align="right" colspan="2">&nbsp;</td>
		</tr>
        </table>	
	<br />
	  <br /><br />
	  <table border="0">
		<tr  align="center">
			<td width="240" colspan="2">&nbsp;</td>
			<td width="50" rowspan="7">&nbsp;</td>
			<td width="300" colspan="6"><?=$vars['COMPANY'];?> , <?=$vars['DNOTA'];?></td>
		</tr>
		<br />
		<tr  align="center">
		  <td width="320" colspan="2"><?=$vars['officer1']['OFFICER_POSITION'];?> </td>
		  <td width="320" colspan="2"><?=$vars['officer2']['OFFICER_POSITION'];?> </td>
		</tr>
		<tr  align="center">
		  <td width="320" colspan="2">&nbsp; </td>
		  <td width="320" colspan="2"></td>
		</tr>
		<tr  align="center">
		  <td width="320" colspan="2">&nbsp; </td>
		  <td width="320" colspan="2"></td>
		</tr>
		<tr  align="center">
			<td width="320" colspan="2">&nbsp;</td>
		  <td width="320" colspan="2">&nbsp;</td>
		</tr>
			<br />
		<br />
		<br />
		<br />
		<br />
		<tr  align="center">
			<td width="320" colspan="2">
				<br /><br /><?=$vars['officer1']['OFFICER_NAME'];?><br />
				(-----------------------------------)
			</td>
			<td width="320" colspan="2">
				<br /><br /><?=$vars['officer2']['OFFICER_NAME'];?><br />
				(-----------------------------------)
			</td>
		</tr>
		<tr>
			<td width="150" align="right">NIPP :</td>
			<td width="135" align="left"><?=$vars['officer1']['OFFICER_NIPP'];?></td>
			<td width="190" align="right">NIPP :</td>
			<td width="135" align="left"><?=$vars['officer2']['OFFICER_NIPP'];?></td>
		</tr>
	</table>
</td></tr></table>
