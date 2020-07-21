								
		<div class="main-box-body clearfix">
			<div class="tabs-wrapper profile-tabs">
				
				<div class="tab-content">
					<div class="tab-pane fade in active" id="tab-list_bod">
						<div class="col-lg-12 col-md-5 col-sm-6">
							<input type="hidden" id="start_month" id="start_month" value="<?=$start_month?>">
							<input type="hidden" id="end_month" id="end_month" value="<?=$end_month?>">
							<table class="table">
								<thead>
									<tr>
										<th class="text-center"><span>Nama Perusahaan</span></th>
										<th class="text-center"><span>Hirarki</span></a></th>
										<th class="text-center"><span>Throughput (Ton)</span></a></th>
										<th class="text-center"><span>Revenue (IDR)</span></a></th>
										<th class="text-center"><span>Shown</span></a></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-left">All</td>
										<td class="text-left"></td>
										<td class="text-left"></td>
										<td class="text-left"></td>
										<td class="text-left"><input type="checkbox" id="customer_all" name="customer_all" id="customer_all"/></td>
									</tr>
									<?php
										$i=1;
										foreach ($customer_profile as $cp){
											if($i==1)
											{
												$checked = "checked";
											}
											else
												$checked = "";
											
											if($cp["HIRARKI"]!=$hirarki)	
											{
									?>
												<tr>
													<td class="text-left"><b><?=$cp["HIRARKI"]?></b></td>
													<td class="text-left"></td>
													<td class="text-left"></td>
													<td class="text-left"></td>
													<td class="text-left"></td>
												</tr>		
									<?
											}
											$hirarki=$cp["HIRARKI"];
									?>
											<tr>
												<td class="text-left"><?=$cp["NAME"]?></td>
												<td class="text-left"><?=$cp["HIRARKI"]?></td>
												<td class="text-right"><?=number_format($cp["THROUGHPUT"],0,",",".")?></td>
												<td class="text-right"><?=number_format($cp["REVENUE"],0,",",".")?></td>
												<td class="text-left"><input type="checkbox" id="customer_id<?=$i?>" name="customer_id[]" value="<?=$cp["CUSTOMER_ID"]?>" <?=$checked?>/></td>
											</tr>
									<?php
											$i++;
										}
									?>
								</tbody>
							</table>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Data shown as</label>
								<?php
									echo form_dropdown('chart_type', $opt_chart_type, $chart_type ,"class='form-control' style='width:300px'");
								?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Data</label>
								<?php
									echo form_dropdown('data_type', $opt_data_type, $data_type ,"class='form-control' style='width:300px'");
								?>															
							</div>
						</div>
					</div>						
					</div><!-- tab-list_bod -->
				</div><!-- tab-content -->		
			</div><!-- tabs wrapper -->
			<div class="row">
			<div class="form-group">
				<button type="button" id="generateChart" class="btn btn-success">Generate Chart</button>
			</div>
			
			<div id="chartResults">
			</div>
		</div><!-- main box  body-->

<script>
$(document).ready(function() {
	$("#customer_all").change(function(){
		if(this.checked) {
			 $('input:checkbox').prop('checked', true);
		}
		else {
			 $('input:checkbox').prop('checked',false);
		}
	});

	$("#generateChart").click(function(){
		//$("#customerproform").submit();
		  //alert('test');
		  $.blockUI();
		  var url = "<?=ROOT?>customer_profile/generate_chart";
		  var start_month = $( "#start_month" ).val();
          var end_month = $( "#end_month" ).val();
          var chart_type = $( "select[name='chart_type']" ).val();
          var data_type = $( "select[name='data_type']" ).val();
          var customer_id = '';
		  
		  $.each($("input[name='customer_id[]']:checked"), function() {
			  if(customer_id=="")
				  customer_id = $(this).val();
			  else 
				  customer_id = customer_id + ',' + $(this).val();
		  });
		  
		  //alert(search_input);
		  $("#chartResults").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
									start_month:start_month,end_month:end_month,customer_id:customer_id,chart_type:chart_type,data_type:data_type},function() {
						$.unblockUI();
					  });			
	});
});
</script>