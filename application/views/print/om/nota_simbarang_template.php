<table width="95%"><tr><td>
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
	<table border="0" cellspacing="0" cellpadding="0">
	  <tr>
                    <td colspan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="710">
                    </td>
                </tr>
		<tr>
			<td colspan="3" width="20"><font size="8"><b>NO</b></font></td>
			<td width="120" align="right"><font size="8"><b>JENIS BARANG</b></font></td>
			<td width="120" align="center"><font size="8"><b>KEMASAN</b></font></td>
			<td width="120" align="center"><font size="8"><b>JUMLAH</b></font></td>
			<td width="100" align="center"><font size="8"><b>SATUAN</b></font></td>
			<td width="100" colspan="2" align="center"><font size="8"><b>TARIF</b></font></td>
			<td width="120" align="center"><font size="8"><b>BIAYA</b></font></td>
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
			<td width="20"><?=$i++;?>&nbsp;</td>
			<td width="120" align="right">&nbsp;<?=$d['CARGO_NAME'];?></td>
			<td width="120" align="center"><?=$d['PKG_NAME'];?>&nbsp;</td>
			<td width="120" align="center"><?=$d['QTY'];?>&nbsp;</td>
			<td width="100" align="center"><?=$d['UNIT'];?>&nbsp;</td>
			<td width="100" colspan="2" align="center"><?=$d['TARIFF'];?>&nbsp;</td>
			<td width="120" align="center"><?=$d['TOTAL_TARIFF'];?>&nbsp;</td>
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
		<!--tr>
		  <td rowspan="5" width="110" align="left">&nbsp;</td>
		  <td width="350" align="right">ADMINISTRASI &nbsp;&nbsp;</td>
		  <td width="80" align="right"><?=$vars['ADM_NOTA'];?>&nbsp;</td>
		</tr-->

		<tr>
		   <td colspan="7" rowspan="7"><img height="125" width="125" src="$barcode_location" /></td>
		      <td width="195" colspan="3" align="right"><font size="10">JUMLAH:</font></td>
		   <td width="120" colspan="2" align="right"><font size="10"><?=$vars['SUBTOTAL'];?>&nbsp;</font></td>
		</tr>
		<tr>
		  <td width="195" colspan="3" align="right"><font size="10">PPN 10 % :</font></td>
		    <td width="120" colspan="2" align="right"><font size="10"><?=$vars['PPN'];?>&nbsp;</font></td>
		</tr>
		<tr>
		   <td width="195" colspan="3" align="right"><font size="10">MATERAI:</font></td>
		  <td width="120" colspan="2" align="right"><font size="10"><?=$vars['MATERAI'];?>&nbsp;</font></td>
		</tr>
		<tr>
		   <td width="195" colspan="3" align="right"><font size="10">JUMLAH TAGIHAN:</font></td>
		    <td width="120" colspan="2" align="right"><font size="10"><?=$vars['TOTAL'];?>&nbsp;</font></td>
		</tr>
		<tr>
		  <td width="430" align="right" colspan="2">&nbsp;</td>
		</tr>

	  </table>
	  <br /><br />
	  <table border="0">		
	  <tr>
					<td width="100%"><p>#<?=$vars['TERBILANG'];?></p></td>
					</tr>
					<tr>
					<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="2">&nbsp;</td>
					</tr>
		<tr  align="center">
			<td width="240" colspan="2">&nbsp;</td>
			<td width="50" rowspan="7">&nbsp;</td>
			<td width="300" colspan="2"><?=$vars['COMPANY'];?> , <?=$vars['DNOTA'];?></td>
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
