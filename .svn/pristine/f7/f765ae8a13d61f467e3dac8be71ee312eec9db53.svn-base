
<script>
    $(function(){
      var urldetail = "<?=ROOT?>port_cooperation/get_list_restcontainer";
      $("#rowdetail").load(urldetail,{VESSEL:vessel,VOYAGE_IN:voyage_in,VOYAGE_OUT:voyage_out,TERMINAL:terminal,CALL_SIGN:call_sign,
                        ID_VESVOY:id_vesvoy,REQUEST_NO:req_no,ID_JOINT:id_joint_vessel,ID_POL:id_pol},function(data){ });        
    });        
</script>

<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Kontainer</a></li>
										<li><a href="<?=ROOT?>port_cooperation/request_restitusi">Permintaan Restitusi</a></li>
										<li class="active"><span>Tambah Permintaan</span></li>
									</ol>
									
									<h1>Tambah Permintaan Restitusi</h1>
								</div>
							</div>
							
					<div class="row">
						<div class="col-lg-10">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2>Data Permintaan</h2>
								</header>
								
									<div class="main-box-body clearfix">
									<!--<form role="form">-->                                        
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete"><b style="font-decoration:italics">No Request Restitusi</b> </label>
											<input type="text" class="form-control" id="no_request" Readonly value="<?php echo $rowhead['ID_REQ']; ?>">
										</div>
                                        
										<div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Kapal </label>
											<input type="text" class="form-control" id="vessel" value="<?=$rowhead['VESSEL']?>"  Readonly>
											<input type="hidden" class="form-control" id="call_sign" placeholder="autocomplete" >
											<input type="hidden" class="form-control" id="id_joint_vessel" placeholder="autocomplete" >
                                            <input type="text" id="voyage_in" placeholder="voyage in"  size="8" Readonly value="<?=$rowhead['VOYAGE_IN']?>"> 
                                            <input type="text" id="voyage_out" placeholder="voyage_out"  size="8" Readonly value="<?=$rowhead['VOYAGE_OUT']?>">
										</div>
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">Terminal </label>
											<input type="text" class="form-control" id="terminal" Readonly value="<?=$rowhead['ID_TERMINAL']?>">
										</div>
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">POD </label>
											<input type="text" class="form-control" id="id_pod" Readonly >
										</div>
                                        <div class="form-group example-twitter-oss">
											<label for="exampleAutocomplete">POL </label>
											<input type="text" class="form-control" id="id_pol" Readonly >
										</div>
								</div>								
							</div>
						</div>	
						
					</div>
					
						</div>
					</div>
					<div class="row" id="rowdetail">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Daftar Kontainer</h2>
								</header>
								
								<div class="main-box-body clearfix">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><span>No Kontainer</span></a></th>
                                                    <th><span>Ukuran</span></a></th>
                                                    <th><span>IsoCode</span></a></th>
                                                    <th><span>Status</span></a></th>
                                                    <th><span>Gate In</span></a></th>
                                                    <th><span>Load</span></a></th>
                                                    <th><span>Disch</span></a></th>
                                                    <th><span>Gate Out</span></a></th>
												</tr>
											</thead>
											<tbody>
                                                <?php foreach( $rowdetail as $rd) { ?>
												<tr>
													<td>
														<a href="#"><?=$rd['NO_CONTAINER']?></a>
													</td>
													<td>
														<?=$rd['SIZE_']?>
													</td>
													<td>
														<a href="#"><?=$rd['TYPE_']?></a>
													</td>
													<td>
														<a href="#"><?=$rd['STATUS_']?></a>
													</td>
													<td>
														<?=$rd['GATE_IN']?>
													</td>
													<td>
														<a href="#"><?=$rd['LOAD_DATE']?></a>
													</td>
													<td>
														<a href="#"><?=$rd['DISCH_DATE']?></a>
													</td>
                                                    <td>
														<a href="#"><?=$rd['GATE_OUT']?></a>
													</td>
												</tr>
                                                <?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>