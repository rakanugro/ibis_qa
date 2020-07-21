
	<div class="col-lg-12" class="<?=$revenue_line?>">
		<div class="main-box">			
			<div class="main-box-body clearfix">
				<div id="revenue-area"></div>
			</div>
			<table class="table" width="100%">
				<thead>
					<tr>
						<th class="text-center" rowspan="2"><span>Tahun</span></th>
						<th class="text-center" colspan="12"><span>Bulan</span></a></th>
						<th>&nbsp;</th>
					</tr>
					<tr>
						<th class="text-center"><span>Januari</span></a></th>
						<th class="text-center"><span>Februari</span></a></th>
						<th class="text-center"><span>Maret</span></a></th>
						<th class="text-center"><span>April</span></a></th>
						<th class="text-center"><span>Mei</span></a></th>
						<th class="text-center"><span>Juni</span></a></th>
						<th class="text-center"><span>Juli</span></a></th>
						<th class="text-center"><span>Agustus</span></a></th>
						<th class="text-center"><span>September</span></a></th>
						<th class="text-center"><span>Oktober</span></a></th>
						<th class="text-center"><span>November</span></a></th>
						<th class="text-center"><span>Desember</span></a></th>
						<th>&nbsp;</th>
					</tr>					
				</thead>
				<tbody>
					<?php 
					foreach($graph_year as $value)
					{
					?>
						<tr>
							<td><?php echo $value?></td>
							<?php
							$i=0;
							for($i==1;$i<12;$i++)
							{
							?>
								<td align="right"><font size="1"><?php echo number_format($value_per_month[$value."-".($i+1)],0,".",",")?></font></td>
							<?php
							}
							?>
							<td>&nbsp;</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			
			<header class="main-box-header clearfix no-print">
			<button type="button" class="btn btn-success pull-left" id="printcustomer"><i class=""></i> &nbsp; Print Customer Profile</button>
			</header>	
		</div>
	</div>

<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
	size: landscape;
}

.page-break	{ display: block; page-break-before: always; }

.no-print, .no-print *
{
	display: none !important;
}
</style>
<script>	
$(document).ready(function() {
		graphArea2 = Morris.Line({
			element: 'revenue-area',
			behaveLikeLine: true,
			data: <?=$graph_datas?>,
			lineColors: ['#0288d1', '#607d8b', '#689f38', '#8e44ad', '#c0392b', '#f39c12','#0288d1', '#607d8b', '#689f38', '#8e44ad', '#c0392b', '#f39c12'],
			xkey: 'month',
			ykeys: <?=$y_keys?>,
			labels: <?=$labels?>,			
			parseTime: false,
			resize: true
		});
		
		$('#printcustomer').click(function(){
			window.print();
		});		
});
</script>