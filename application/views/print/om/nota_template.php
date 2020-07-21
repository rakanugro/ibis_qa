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
           <td COLSPAN="7"></td>
           <td COLSPAN="2" align="left" width="80px">No. Nota</td>
		   <td COLSPAN="1" align="left" width="10px">:</td>
           <td COLSPAN="2" align="left" width="170px"><?=$vars['NO_NOTA'];?></td>
          </tr>
		  <tr>
          <td COLSPAN="7"></td>
          <td COLSPAN="2" align="left">No. Doc</td>
		  <td COLSPAN="1" align="left" width="10px">:</td>
          <td COLSPAN="2" align="left" width="220px"><?=$vars['ID_REQ'];?></td>
          </tr>
		   <tr>
           <td COLSPAN="7"></td>
           <td COLSPAN="2" align="left">Tgl. Nota</td>
			<td COLSPAN="1" align="left" width="10px">:</td>
           <td COLSPAN="2" align="left" width="170px"><?=$vars['TRX_DATE'];?></td>
                </tr>  
			<tr>
              <td COLSPAN="7"></td>
              <td COLSPAN="2" align="left">No. faktur</td>
			  <td COLSPAN="1" align="left" width="10px">:</td>
              <td COLSPAN="2" align="left" width="170px"><?=$vars['NO_NOTA'];?></td>
            </tr>
			                <tr>
                <td></td>
                </tr>
				<tr>
                    <td COLSPAN="15" align="center"><font size="14"><b>NOTA JASA KEPELABUHANAN</b></font></td>
                </tr>
                <!--<tr>
                    <td colspoan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="700">
                    </td>
                </tr>-->
				<tr><td></td></tr>
                <tr>
                    <td COLSPAN="2"></td>
                    <td COLSPAN="10" align="right"><font size="12"><b><?=$vars['SERVICETYPE_NAME'];?></b>  </font></td>
                </tr>
                <tr>
                <td></td>
                </tr>
		
		  <tr>
            <td COLSPAN="2">PEMILIK / PEMAKAI JASA</td>
			<td width="10px">:</td>
            <td COLSPAN="5" align="left"><?=$vars['CUST_NAME'];?></td>
            <td colspan="2"></td>
            <td colspan="4" align="right" ><?=$vars['SERVICETYPE_NAME'];?></td>
          </tr>
		   <tr>
            <td COLSPAN="2">ALAMAT</td>
			<td width="10px">:</td>
            <td COLSPAN="5" align="left"><?=$vars['CUST_ADDR'];?></td>
            <td colspan="2" ></td>
            <td colspan="4" align="right" ></td>
          </tr>
		  <tr>
            <td COLSPAN="2">NPWP</td>
			<td width="10px">:</td>
            <td COLSPAN="5" align="left"><?=$vars['CUST_NPWP'];?></td>
            <td colspan="2"></td>
          </tr>
                <tr>
                    <td COLSPAN="2">NAMA KAPAL/VOY/TANGGAL</td>
					<td width="10px">:</td>
                    <td COLSPAN="7" align="left"><?=$vars['VESSEL'];?>/ <?=$vars['VOY_IN'];?> - <?=$vars['VOY_OUT'];?></td>
                </tr>
				 <tr>
                    <td COLSPAN="2">BL Number - Date</td>
					<td width="10px">:</td>
                    <td COLSPAN="7" align="left"><?=$vars['BL_NUMBER'];?> - <?=$vars['BL_DATE'];?></td>
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
                <tr>
                <td colspan="12"></td>
                </tr> 
                <tr>
                    <td colspan="14">
                        <hr style="border: 2px dashed #C0C0C0" color="#FFFFFF" size="6" width="710">
                    </td>
                </tr>
                <tr>
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
			<td width="150"><?=$d['URAIAN'];?>&nbsp;</td>
			<td width="100" align="left"><?=$d['CARGO_NAME'];?>&nbsp;</td>
			<td width="65" align="center"><?=$d['QTY'];?>&nbsp;</td>
			<td width="65" align="center"><?=$d['UNIT'];?>&nbsp;</td>
			<td width="65" align="center"><?=$d['TGL_AWAL'];?>&nbsp;<br/><?=$d['TGL_AKHIR'];?>&nbsp;</td>
			<td width="65" align="center"><?=$d['TOTHARI']?>&nbsp;</td>
			<td width="80" colspan="2" align="center"><? $trf = number_format($d['TARIF']);
											 echo $trf;	
											?>&nbsp;
			</td>
			<td width="115" align="center"><?=number_format($d['TOTTARIF']);?>&nbsp;</td>
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
					<tr>
                        <td width="195" colspan="3" align="right"><font size="10">PPN 10 % :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10"><?=number_format($vars['PPN']);?>&nbsp;</font></td>
                    </tr>
					<tr>
                        <td width="195" colspan="3" align="right"><font size="10">JUMLAH TAGIHAN :</font></td>
                        <td width="120" colspan="2" align="right"><font size="10"><?=number_format($vars['TOTAL']);?>&nbsp;</font></td>
                    </tr>
					
					<tr>
					<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="2">&nbsp;</td>
					</tr>

					<tr>
					<td colspan="2">&nbsp;</td>
					</tr>
					
		<tr>
		  <td width="430" align="right" colspan="2">&nbsp;</td>
		</tr>
<tr>
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
					<!--tr>
					<td colspan="2">&nbsp;</td>
					</tr>

					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr-->
	<tr height="20">
					<td width="100%">
					<p>Nota sebagai faktur pajak berdasarkan Peraturan Dirjen Pajak</p>
					</td>
					</tr>
					<tr>
					<td width="100%">
					<p> PER-33/PJ/2014 tanggal 30 Desember 2014</p>
					</td>
					</tr>
					<tr>
					<td colspan="2">&nbsp;</td>
					</tr>
					<tr height="200">
					</tr>
					<tr height="50">
					<td colspan="0" align="right">
					</td>
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