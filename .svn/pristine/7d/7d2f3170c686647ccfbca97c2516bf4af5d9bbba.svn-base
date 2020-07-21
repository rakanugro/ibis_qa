<?php
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1>Customer List</h1>
<table class="fullwidth" border="1">
<thead>
	<th class="text-center"><span>No</span></th>
	<th class="text-center"><span>Customer ID</span></th>
	<th class="text-center"><span>Pelanggan</span></a></th>
	<th class="text-center"><span>Cabang Pendaftaran Pertama</span></a></th>
	<th class="text-center"><span>Jenis Pelanggan</span></a></th>
	<th class="text-center"><span>NPWP</span></a></th>
	<th class="text-center"><span>Address</span></a></th>
	<th class="text-center"><span>Email</span></a></th>
	<th class="text-center"><span>Phone</span></a></th>
	<th class="text-center"><span>CEO Name</span></a></th>
	<th class="text-center"><span>CEO Phone</span></a></th>
	<th class="text-center"><span>CEO Email</span></a></th>
	<th class="text-center"><span>PIC Name</span></a></th>
	<th class="text-center"><span>PIC Phone</span></a></th>
	<th class="text-center"><span>PIC Email</span></a></th>	
	<th class="text-center"><span>Status Approval</span></a></th>
	<th class="text-center"><span>Status Customer</span></a></th>
</thead>
<tbody>
	<?php 
	
	$i = 0;
	$no =1;
	
	$c = $table->num_rows();
	while( $i < $c && $x = $table->row_array($i++) ){
		if($x['REGISTRATION_COMPANY_ID']!=$this->session->userdata('registrationcompanyid_phd')&&$this->session->userdata('group_phd')!="a")
		{
			$bgcolor = "yellow";
		}
		else
		{
			$bgcolor = "";
		}
?>
	
	<tr>
		<td>
			<?=$no;?>
		</td>
		<td>
			'<?=$x['CUSTOMER_ID'];?>
		</td>
		<td class="text-left">
			<?=$x['NAME'];?>
		</td>
		<td class="text-left" bgcolor = "<?=$bgcolor?>">
			<?=$x['CABANG_PENDAFTARAN'];?>
		</td>
		<td class="text-left">
			<?php
				if($x['IS_SHIPPING_AGENT']=="Y")
				{
					echo "SHIPPING AGENT";
				}
				else if($x['IS_EMKL']=="Y")
				{
					echo "EMKL";
				}else if($x['IS_CONSIGNEE']=="Y")
				{
					echo "CARGO OWNER";
				}else if($x['IS_PBM']=="Y")
				{
					echo "PBM";
				}	
				else if($x['IS_RUPA']=="Y")
				{
					echo "KHUSUS RUPA2";
				}
			?>
		</td>
		<td class="text-left">
			<?=$x['NPWP'];?>
		</td>
		<td class="text-left">
			<?=$x['ADDRESS'].",".$x['KELURAHAN'].",".$x['KECAMATAN'].",".$x['CITY'].",".$x['PROVINCE'].",".$x['POSTAL_CODE'];?>
		</td>	
		<td class="text-left">
			<?=$x['EMAIL'];?>
		</td>
		<td class="text-left">
			'<?=$x['PHONE'];?>
		</td>	
		<td class="text-left">
			<?=$x['NAME_CEO'];?>
		</td>	
		<td class="text-left">
			'<?=$x['HANDPHONE_CEO'];?>
		</td>	
		<td class="text-left">
			<?=$x['EMAIL_CEO'];?>
		</td>
		<td class="text-left">
			<?=$x['NAME_PIC'];?>
		</td>	
		<td class="text-left">
			'<?=$x['HANDPHONE_PIC'];?>
		</td>
		<td class="text-left">
			<?=$x['EMAIL_PIC'];?>
		</td>		
		<td align="center">
		<?php
			switch($x['STATUS_APPROVAL'])
			{
				case "W":
					echo "<span class=\"label label-warning\">Waiting Approve</span>";
				break;
				case "P":
					echo "<span class=\"label label-warning\">Approve/Syn In Progress</span>";
				break;	
				case "A":
					echo "<span class=\"label label-success\">Approved</span>";
				break;	
				case "R":
					echo "<span class=\"label label-danger\">Reject</span> <span class=\"label label-danger fa fa-th-list\" title=\"".$x['REJECT_NOTES']."\">&nbsp</span>";
				break;	
				case "FP":
					echo "<span class=\"label label-danger\">Failed Sync</span>";
				break;	
				case "N":
					echo "<span class=\"label label-warning\">DRAFT</span>";
				break;
				default:
					echo "<span class=\"label label-warning\">".$x['STATUS_APPROVAL']."</span>";
				break;
			}
		?>															
		</td>
		<td align="center">
		<?php
			switch($x['STATUS_CUSTOMER'])
			{
				case "A":
					echo "<span class=\"label label-success\">ACTIVE</span>";
				break;
				case "I":
					echo "<span class=\"label label-warning\">INACTIVE</span>";
				break;
				default:
					echo "<span class=\"label label-warning\">".$x['STATUS_CUSTOMER']."</span>";
				break;
			}
		?>															
		</td>
	</tr>
<?
	$no++;
	}
?>
</tbody>
</table>
