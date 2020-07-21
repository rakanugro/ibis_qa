										<div class="main-box-body clearfix" id="table">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th class="text-center"><span>No</span></th>
															<th class="text-center"><span>Atribut</span></a></th>
															<th class="text-center"><span>Value</span></a></th>
															<th class="text-center"><span>Status</span></a></th>
															<th>&nbsp;</th>
														</tr>
													</thead>
													<tbody>
													<?
														$i = 0;
														$c = $table->num_rows();
														while( $i < $c && $x = $table->row_array($i++) ){
													?>
														<tr>
															<td>
																<?=($i);?>
															</td>
															<td class="text-left">
																<?=$this->options_model->getContent('BLACKLISTATRIBUTE','ID',$x['BLACKLIST_ATTRIBUTE']);?>
															</td>
															<td class="text-left">
																<?=$x['BLACKLIST_VALUE'];?>
															</td>
															<td>
																<?php
																
																if($x['ACTIVE']=='Y')
																	echo "<span class=\"label label-success\">ACTIVE</span>";
																else
																	echo "<span class=\"label label-warning\">INACTIVE</span>";
																
																?>
															</td>															
															<td>
																<a href="#" class="table-link" onclick="edit('<?=$x['BLACKLIST_ID'];?>')">
																	<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
																	</span>
																</a>
																<?php
																if($x['ACTIVE']=='Y')
																{
																?>
																	<a href="javascript:void(0)" class="table-link" onclick="del('<?=$x['BLACKLIST_ID'];?>','<?=$this->options_model->getContent('BLACKLISTATRIBUTE','ID',$x['BLACKLIST_ATTRIBUTE']);?>:<?=$x['BLACKLIST_VALUE'];?>')">
																		<span class="fa-stack">
																			<i class="fa fa-square fa-stack-2x"></i>
																			<i class="fa fa-power-off fa-stack-1x fa-inverse"></i>
																		</span>
																	</a>
																<?php
																}
																else
																{
																?>
																	<a href="javascript:void(0)" class="table-link" onclick="activated('<?=$x['BLACKLIST_ID'];?>','<?=$this->options_model->getContent('BLACKLISTATRIBUTE','ID',$x['BLACKLIST_ATTRIBUTE']);?>:<?=$x['BLACKLIST_VALUE'];?>')">
																		<span class="fa-stack">
																			<i class="fa fa-square fa-stack-2x"></i>
																			<i class="fa fa-check fa-stack-1x fa-inverse"></i>
																		</span>
																	</a>
																<?php																
																}
																?>																
															</td>
														</tr>
													<?
														}
													?>
													</tbody>
												</table>
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
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$currentpage-1;?>/<?=$searchterm?>/<?=$otherterm?>"><i class="fa fa-chevron-left"></i></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$page;?>/<?=$searchterm?>/<?=$otherterm?>"><?=$page++;?></a></li>
													<li><a href="<?=ROOT.$moduleuri;?>/gotopageblacklist/<?=$currentpage+1;?>/<?=$searchterm?>/<?=$otherterm?>"><i class="fa fa-chevron-right"></i></a></li>
												</ul>
											</div>
											
										</div>