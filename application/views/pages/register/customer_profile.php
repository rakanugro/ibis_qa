<?php
	if($register['IS_SHIPPING_AGENT']=='Y')
	{
		$customer_type = 'SHIPPING AGENT';
	}
	else if($register['IS_SHIPPING_LINE']=='Y')
	{
		$customer_type = 'SHIPPING LINE';
	}
	else if($register['IS_PBM']=='Y')
	{
		$customer_type = 'PBM';
	}
	else if($register['IS_FF']=='Y')
	{
		$customer_type = 'FREIGHT FORWARDER';
	}
	else if($register['IS_EMKL']=='Y')
	{
		$customer_type = 'EMKL';
	}
	else if($register['IS_PPJK']=='Y')
	{
		$customer_type = 'PPJK';
	}
	else if($register['IS_CONSIGNEE']=='Y')
	{
		$customer_type = 'CARGO OWNER';
	}
?>
<style>
h2 {

}
</style>
							<div class="row" id="user-profile">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2  align="left"><b>Informasi Umum</b></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="main-box clearfix">
												<ul class="fa-ul">
													<li><i class="fa-li fa fa-truck"></i>ID Customer: <?=$register["CUSTOMER_ID"] ?></li>
													<li><i class="fa-li fa fa-truck"></i>Name: <?=$register["NAME"] ?></li>
													<li><i class="fa-li fa fa-tasks"></i>NPWP: <?=$register["NPWP"] ?></li>
													<li><i class="fa-li fa fa-tasks"></i>Business Type: <?=$customer_type ?></li>
												</ul>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="main-box clearfix">												
												<ul class="fa-ul">
													<li><i class="fa-li fa fa-truck"></i>Email: <a href="mailto:<?=$register["EMAIL"] ?>"><?=$register["EMAIL"] ?></a></li>
													<li><i class="fa-li fa fa-tasks"></i>Phone: <?=$register["PHONE"] ?></li>
													<li><i class="fa-li fa fa-tasks"></i>Address: <?=$register["ADDRESS"] ?></li>
												</ul>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><b>Daftar Pemimpin dan Pengurus Perusahaan</b></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="tabs-wrapper profile-tabs">
												
												<div class="tab-content">
													<div class="tab-pane fade in active" id="tab-list_bod">
														<div class="col-lg-12 col-md-12 col-sm-12">
															<table class="table">
																<thead>
																	<tr>
																		<th class="text-center"><span>No</span></th>
																		<th class="text-center"><span>Nama</span></a></th>
																		<th class="text-center"><span>Jabatan</span></a></th>
																		<th class="text-center"><span>Alamat</span></a></th>
																		<th class="text-center"><span>Handphone</span></a></th>
																		<th class="text-center"><span>Email</span></a></th>
																		<th class="text-center"><span>No Tanda Pengenal</span></a></th>
																		<th>&nbsp;</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		$i=1;
																		foreach ($ceo as $t){
																	?>
																		<tr>
																			<td><?=$i?></td>
																			<td><?=$t["NAME_CEO"]?></td>
																			<td>CEO</td>
																			<td><?=$t["ADDRESS_CEO"]?></td>
																			<td><?=$t["HANDPHONE_CEO"]?> / <?=$t["PHONE_CEO"]?></td>
																			<td><?=$register["EMAIL_BOD"] ?></td>
																			<td><?php
																					if($t["KTP_CEO"]!="")
																					{
																					?>
																					KTP: <?=$t["KTP_CEO"]?> <br>
																					<?php 
																					}
																					?>
																					<?php
																					if($t["PASSPORT_CEO"]!="")
																					{
																					?>
																					Passport: <?=$t["PASSPORT_CEO"]?>
																					<?php 
																					}
																					?></td>
																		</tr>
																	<?php
																			$i++;
																		}
																	?>
																	
																	<?php 
																		foreach ($bod as $t){
																	?>
																		<tr>
																			<td><?=$i?></td>
																			<td><?=$t["NAME_BOD"]?></td>
																			<td><?=$t["TITLE_BOD"]?></td>
																			<td><?=$t["ADDRESS_BOD"]?></td>
																			<td><?=$t["HANDPHONE_BOD"]?> / <?=$t["PHONE_BOD"]?></td>
																			<td><?=$register["EMAIL_BOD"] ?></td>
																			<td></td>
																		</tr>																		
																	<?php
																		$i++;
																		}
																	?>															
																	<?php 
																		foreach ($am as $t){
																	?>
																		<tr>
																			<td><?=$i?></td>
																			<td><?=$t["NAME_AM"]?></td>
																			<td><?=$t["TITLE_AM"]?></td>
																			<td><?=$t["ADDRESS_AM"]?></td>
																			<td><?=$t["HANDPHONE_AM"]?> / <?=$t["PHONE_AM"]?></td>
																			<td><?=$register["EMAIL_AM"] ?></td>
																			<td></td>
																		</tr>																		
																	<?php
																		$i++;
																		}
																	?>
																</tbody>
															</table>
														</div>
														
													</div><!-- tab-list_bod -->
												</div><!-- tab-content -->		
											</div><!-- tabs wrapper -->
										</div><!-- main box  body-->
										
									</div><!-- main box -->
								</div><!-- column -->		

								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><b>Company Hierarchy</b></h2>
										</header>
								
										<div class="main-box-body clearfix">	
											<div class="col-lg-12 col-md-12 col-sm-12">
												<label>Headquater : 
												<?php
												if($customer_hq['CUSTOMER_ID']!=""){
												?>
												<a href="<?php echo ROOT."customer_profile/index/".$customer_hq['CUSTOMER_ID']?>" target="_blank"><?php echo $customer_hq['NAME']?></a>
												<?php
												}
												?>
												</label><br>
												<label>Branch : <br>
													<?php
													foreach($customer_branch as $rowcbranch)
													{
														echo '<a href="'.ROOT.'customer_profile/index/'.$rowcbranch['CUSTOMER_ID'].'" target="_blank">'.$rowcbranch['NAME'].'</a><br>';
													}
												?></label><br>
												<label>Subsidiary : <br>
													<?php
														foreach($customer_child as $rowcchild)
														{
															echo '<a href="'.ROOT.'customer_profile/index/'.$rowcchild['CUSTOMER_ID'].'" target="_blank">'.$rowcchild['NAME'].'</a><br>';
														}
													?>
													</label><br>
											</div>														
										</div><!-- main box  body-->					
									</div><!-- main box -->
								</div><!-- column -->

								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix page-break">
											<h2><b>Revenue &amp; Throughput</b></h2>
										</header>
										
										<div class="main-box-body clearfix">
										<header class="main-box-header clearfix">
											<h4><b>Revenue Company Last Month</b></h4>
											
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<label>Revenue Per Jenis Layanan</label>
														<div class="main-box-body clearfix">
															<div id="revenue-area-service"></div>
														</div>
														<table class="table">
															<thead>
																<tr>
																	<th class="text-center"><span>Layanan</span></th>
																	<th class="text-center"><span>Revenue</span></a></th>
																	<th>&nbsp;</th>
																</tr>
															</thead>
															<tbody>
																<?php 
																foreach($service_revenue as $key=>$value)
																{
																?>
																	<tr>
																		<td><?php echo $key?></td>
																		<td align="right"><?php echo number_format($value,0,".",",")?></td>
																	</tr>
																<?php
																}
																?>
															</tbody>
														</table>														
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<label>Revenue Per Lokasi</label>
														<div class="main-box-body clearfix">
															<div id="revenue-area-location"></div>
														</div>	
														<table class="table">
															<thead>
																<tr>
																	<th class="text-center"><span>Lokasi</span></th>
																	<th class="text-center"><span>Revenue</span></a></th>
																	<th>&nbsp;</th>
																</tr>
															</thead>
															<tbody>
																<?php 
																foreach($location_revenue as $key=>$value)
																{
																?>
																	<tr>
																		<td><?php echo $key?></td>
																		<td align="right"><?php echo number_format($value,0,".",",")?></td>
																	</tr>
																<?php
																}
																?>
															</tbody>
														</table>														
													</div>
												</div>
											</div>
											
										</header>				
										</div>
										
										<div class="main-box-body clearfix">
											<header class="main-box-header clearfix page-break">
												<h2><b>Revenue Company</b></h2>
											</header>
											<?php 
												$attributes = array('name' => 'customerproform','id'=>'customerproform','role'=>'form');
												echo form_open($action,$attributes);
											?>
												<div class="row no-print">
													<div class="col-lg-6 col-md-6 col-sm-6">
														<div class="form-group">
															<label>From</label>
															<?php
																echo form_dropdown('start_month', $opt_start_month, $start_month ,"class='form-control' style='width:300px'");
															?>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6">
														<div class="form-group">
															<label>to</label>
															<?php
																echo form_dropdown('end_month', $opt_end_month, $end_month ,"class='form-control' style='width:300px'");
															?>															
														</div>
													</div>
												</div>
												
												<div class="row no-print">
													<div class="col-lg-12">
														<div class="form-group">
															<label>Show</label><br>
															<div class="row">
																<div class="col-lg-6 col-md-6 col-sm-6">
																<input type="checkbox" name="show_all" id="show_all" value="All"> All
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6">
																<input type="checkbox" name="show_cust[]" value="hq"> Headquater
																</div>
															</div>
															<div class="row">
																<div class="col-lg-6 col-md-6 col-sm-6">
																<input type="checkbox" name="show_cust[]" value="br"> Branch
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6">
																<input type="checkbox" name="show_cust[]" value="sb"> Subsidiary
																</div>
															</div>															
														</div>
													</div>
												</div>
												
												<div class="form-group no-print">
													<button type="button" id="submitButton" class="btn btn-success">Submit</button>
												</div>
												
												<div id="company_list_h">
												</div>
											<?php 
												echo form_close();
											?>
										</div><!-- main box  body-->										
									</div><!-- main box -->
								</div><!-- column -->
								
							</div><!-- row -->
							
						</div>
					</div>
	
	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?=CSS_?>libs/morris.css" type="text/css" />
	
	<!-- this page specific scripts -->
	<script src="<?=JS_?>jquery.knob.js"></script>
	<script src="<?=JS_?>raphael-min.js"></script>
	<script src="<?=JS_?>morris.js"></script>
	
<script>	
$(document).ready(function() {
	//sql injection protection
	$(":input").keyup(function(event) {
		// $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
		$(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
	});
});
</script>

	<script>
	
	$(function($) {
		//validation
		$("#submitButton").click(function(){
			//$("#customerproform").submit();
              //alert('test');
              $.blockUI();
              //var url = "<?=ROOT?>customer_profile/search_revenue_n_throughput";
			  var url = "<?=ROOT?>customer_profile/generate_chart";
              var customer_id = "<?=$register["CUSTOMER_ID"] ?>";
              var start_month = $( "select[name='start_month'] option:selected" ).val();
              var end_month = $( "select[name='end_month'] option:selected" ).val();
			  var show_cust = '';

			  $.each($("input[name='show_cust[]']:checked"), function() {
				  if(show_cust=="")
					  show_cust = $(this).val();
				  else 
					  show_cust = show_cust + ',' + $(this).val();
			  });
		  
              //alert(search_input);
              $("#company_list_h").load(url,{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                            customer_id:customer_id,show_cust:show_cust,start_month:start_month,end_month:end_month},function() {
                            $.unblockUI();
                          });
		});		
	})

	</script>	
	
<script>	
$(document).ready(function() {
	
		$("#show_all").change(function(){
			if(this.checked) {
				 $('input:checkbox').prop('checked', true);
			}
			else {
				 $('input:checkbox').prop('checked',false);
			}
		});
	
		graphBar = Morris.Bar({
			element: 'revenue-area-service',
			data:  <?=$graph_datas?>,
			barColors: function (row, series, type) {
					console.log("-> "+JSON.stringify(row), series, type);
					if(row.x == 0) return "#0288d1";
					else if(row.x == 1) return "#607d8b";
					else if(row.x == 2) return "#fec04c";
					else return "#1AB244";
					},
			xkey: 'service',
			ykeys: <?=$y_keys?>,
			labels:  <?=$labels?>,
			xLabelMargin: 0,
			resize: true
		});
		
		
		graphBar2 = Morris.Bar({
			element: 'revenue-area-location',
			data:  <?=$graph_datas2?>,
			barColors: function (row, series, type) {
					console.log("-> "+JSON.stringify(row), series, type);
					if(row.x == 0) return "#0288d1";
					else if(row.x == 1) return "#607d8b";
					else if(row.x == 2) return "#fec04c";
					else if(row.x == 3) return "#1AB244";
					else if(row.x == 4) return "#4286f4";
					else if(row.x == 5) return "#4f7482";
					else if(row.x == 6) return "#9246a3";
					else if(row.x == 7) return "#e084a3";
					else if(row.x == 8) return "#487f33";
					else if(row.x == 9) return "#ad6f1f";
					else if(row.x == 10) return "#d380f7";
					else if(row.x == 11) return "#993b41";
					else if(row.x == 12) return "#b71620";
					else if(row.x == 13) return "#cece5c";
					else if(row.x == 14) return "#d8c4c3";
					else if(row.x == 15) return "#3d0f0c";
					else if(row.x == 16) return "#352632";
					else return "#994626";
					},
			xkey: 'location',
			ykeys: <?=$y_keys2?>,
			labels:  <?=$labels2?>,
			xLabelMargin: 0,
			resize: true
		});		
});
</script>