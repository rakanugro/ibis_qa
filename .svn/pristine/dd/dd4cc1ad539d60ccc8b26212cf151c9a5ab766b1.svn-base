							<div class="row">
							
								<div class="col-lg-12">
									<div class="main-box">
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th class="text-center"><span>No</span></th>
															<th class="text-center"><span>Customer ID</span></th>
															<th class="text-center"><span>Pelanggan</span></a></th>
															<th class="text-center"><span>Cabang Pendaftaran Pertama</span></a></th>
															<th class="text-center"><span>Jenis Pelanggan</span></a></th>
															<th class="text-center"><span>NPWP</span></a></th>
															<th class="text-center"><span>Status Approval</span></a></th>
															<th class="text-center"><span>Status Customer</span></a></th>
															<th>&nbsp;</th>
														</tr>
													</thead>
													<tbody>
													<?
													//print_r($data); die();
														$i = 0;
														if($currentpage=="")
														{
															$currentpage=1;
														}
														$no = (($currentpage-1)*$limit)+1;
														
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
																<?=$x['CUSTOMER_ID'];?>
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
																	}else if($x['IS_RUPA']=="Y")
																	{
																		echo "RUPA-RUPA";
																	}	
																?>
															</td>
															<td class="text-left">
																<?=$x['NPWP'];?>
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
															<td>
																<?php
																if($this->session->userdata('group_phd') != 'm')
																{
																?>
																<a href="#" class="table-link" onclick="edit('<?=$x['CUSTOMER_ID'];?>')">
																	<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
																	</span>
																</a>
																<?php
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
											</div>
											<div class="table-responsive">
											<ul class="pagination">	
												<li><button type="button" id="downloadButton" class="btn btn-success">Download Excel</button></li>
											</ul>
											</div>
											<ul class="pull-left pagination">	
												<li><a>Rows <?=$pageinfo['STARTNUM'];?> - <?=$pageinfo['ENDNUM'];?> of <?=$pageinfo['TOTAL'];?>. Page <?=$currentpage;?> of <?=ceil($pageinfo['TOTAL']/$limit);?>.</a></li>
											</ul>
											<div>
												<ul class="pagination pull-right">
												<?  $page = 1;
													if($searchterm=="")
														$searchterm = "empty";
													if ($currentpage > 3) {$page = $currentpage-2;} ?>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopage/list/<?=$currentpage-1;?>/<?=$searchterm?>/<?=$jenis_pelangganterm?>/<?=$service_typeterm?>/<?=$status_approvalterm?>/<?=$status_customerterm?>/<?=$lokasi_pelangganterm?>/<?=$cfsterm?>"><i class="fa fa-chevron-left"></i></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopage/list/<?=$page;?>/<?=$searchterm?>/<?=$jenis_pelangganterm?>/<?=$service_typeterm?>/<?=$status_approvalterm?>/<?=$status_customerterm?>/<?=$lokasi_pelangganterm?>/<?=$cfsterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopage/list/<?=$page;?>/<?=$searchterm?>/<?=$jenis_pelangganterm?>/<?=$service_typeterm?>/<?=$status_approvalterm?>/<?=$status_customerterm?>/<?=$lokasi_pelangganterm?>/<?=$cfsterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopage/list/<?=$page;?>/<?=$searchterm?>/<?=$jenis_pelangganterm?>/<?=$service_typeterm?>/<?=$status_approvalterm?>/<?=$status_customerterm?>/<?=$lokasi_pelangganterm?>/<?=$cfsterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopage/list/<?=$page;?>/<?=$searchterm?>/<?=$jenis_pelangganterm?>/<?=$service_typeterm?>/<?=$status_approvalterm?>/<?=$status_customerterm?>/<?=$lokasi_pelangganterm?>/<?=$cfsterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopage/list/<?=$page;?>/<?=$searchterm?>/<?=$jenis_pelangganterm?>/<?=$service_typeterm?>/<?=$status_approvalterm?>/<?=$status_customerterm?>/<?=$lokasi_pelangganterm?>/<?=$cfsterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopage/list/<?=$currentpage+1;?>/<?=$searchterm?>/<?=$jenis_pelangganterm?>/<?=$service_typeterm?>/<?=$status_approvalterm?>/<?=$status_customerterm?>/<?=$lokasi_pelangganterm?>/<?=$cfsterm?>"><i class="fa fa-chevron-right"></i></a></li>
												</ul>
											</div>
											
										</div>
									
									</div>
								</div>
								
							</div>
	<!-- this page specific inline scripts lol-->
	<script>
	
	function edit(cust_id){
		window.location.href= "<?=ROOT;?>register/index/"+cust_id;
	}
	
	function del(cust_id){
		if (confirm('Anda yakin akan menghapus data ini?')){
			//alert('Menghapus data...');
			//window.location.href= "<?=ROOT;?>register/delete/"+cust_id+"/<?=htmlentities("register/list_customer")?>";
			//alert ("<?=ROOT;?>/register/delete/"+cust_id+"/<?=htmlentities("register/list_customer")?>");
		}
	}
	
	$("#searchBox").keypress(function(e) {
		if(e.which == 13) {	//enter key
			change();
		}
	});
	
	$("#addCustomerButton").click(function(){
		window.location.href= "<?=ROOT;?>register/index/";
	})	
	
	function change(){
		var jp =  $("select[name=customer_type] option:selected").val();
		var st =  $("select[name=service_type] option:selected").val();
		var sa =  $("select[name=status_approval] option:selected").val();
		var sc =  $("select[name=status_customer] option:selected").val();
		var cl =  $("select[name=customer_location] option:selected").val();
		
		if ($("input[name='cfs_type']").is(":checked"))
		{
			var cfs = $("input[name='cfs_type']").val();
		}
		else
			var cfs = "";

		var q = $("#searchBox").val();
		var q = q.trim();
		var q = q.replace("'", "%27"); 
		var q = q.replace("'", "%27"); 
		var q = q.replace("'", "%27"); 
		var q = q.replace("'", "%27"); 
		var q = q.replace("'", "%27"); 
		var q = q.replace("'", "%27"); 
		
		if(q=="")
			q = "empty";
		if(jp=="")
			jp = "empty";		
		if(st=="")
			st = "empty";		
		if(sa=="")
			sa = "empty";		
		if(sc=="")
			sc = "empty";		
		if(cl=="")
			cl = "empty";
		if(cfs=="")
			cfs = "empty";		
		
		window.location.href= "<?=ROOT;?>register/list_customer/list/"+q+"/"+jp+"/"+st+"/"+sa+"/"+sc+"/"+cl+"/"+cfs;
	}
	
	$(function($) {
		$("#downloadButton").click(function(){
			var jp =  $("select[name=customer_type] option:selected").val();
			var st =  $("select[name=service_type] option:selected").val();
			var sa =  $("select[name=status_approval] option:selected").val();
			var sc =  $("select[name=status_customer] option:selected").val();
			var cl =  $("select[name=customer_location] option:selected").val();
			
			if ($("input[name='cfs_type']").is(":checked"))
			{
				var cfs = $("input[name='cfs_type']").val();
			}
			else
				var cfs = "";
		
			var q = $("#searchBox").val();
			var q = q.trim();
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			var q = q.replace("'", "%27"); 
			
			if(q=="")
				q = "empty";
			if(jp=="")
				jp = "empty";		
			if(st=="")
				st = "empty";			
			if(sa=="")
				sa = "empty";		
			if(sc=="")
				sc = "empty";	
			if(cl=="")
				cl = "empty";
			if(cfs=="")
				cfs = "empty";			
			
			window.location.href= "<?=ROOT;?>register/list_customer/download_excell/"+q+"/"+jp+"/"+st+"/"+sa+"/"+sc+"/"+cl+"/"+cfs;
		});
	})	
	</script>