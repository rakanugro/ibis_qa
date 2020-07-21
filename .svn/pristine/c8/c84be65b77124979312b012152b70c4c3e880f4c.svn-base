
			<div id="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12">
								<div id="content-header" class="clearfix">
									<div class="pull-left">
										<ol class="breadcrumb">
											<li><a href="#">Home</a></li>
											<li><a href="#">Promo Jakarta-Surabaya</a></li>
											<li class="active"><span>Upload Codeco Coarri</span></li>
										</ol>
										
										<h1>Upload Codeco Coarri</h1>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<header class="main-box-header clearfix">
										<h2>Upload Codeco Coarri</h2>
									</header>
									
									<div class="main-box-body clearfix">
										
										<?php 
											$attributes = array('role'=>'form','class'=>'form-inline','onsubmit'=>'return cek_upload()');
											echo form_open_multipart(ROOT.'uploadsby/upload_codecocoarri',$attributes);
										?>
											<div class="form-group example-twitter-oss">
													<label>Codeco/Coarri :</label>
													 <select name="kategori" id="kategori">
													 <option value="0">--</option>
													  <option value="codeco">Codeco</option>
													  <option value="coarri">Coarri</option>
													</select> 
													<label>File Excel : </label>
														<div class="form-group">
															<div class="col-xs-12">
																<label class="ace-file-input">
																	<input type="file" id="attachment" name="attachment" size="20">
																</label>
															</div>
														</div>
												</div><br>
												<button type="submit" class="btn btn-success">Upload</button>
										</form>
										<br />
										Download Template Excel : <a href="downloadcodeco" target="_blank">Template Upload Codeco</a> &nbsp; <a href="downloadcoarri" target="_blank">Template Upload Coarri</a>
										<br />
									</div>
								</div>
							</div>	
						</div>
						
				
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<header class="main-box-header clearfix">
											<h2>CODECO</h2>
										</header>
									
									<div class="main-box-body clearfix">
										<div class="table-responsive clearfix">
											<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-codeco" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );

													$this->table->set_template($tmpl);												
													echo $this->table->generate();
												?>
												
									
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>COARRI</h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-coarri" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );
													$this->table->clear();
													//create table
									
													$this->table->set_heading("No", 
																				'ID JOINT VESSEL',
																			  "Vessel", 
																			  "Voyage In", 
																			  "Voyage Out", 
																			  'No Container', 
																			  'EI', 
																			  'IN/OUT', 
																			  'ISOCODE', 
																			  "Stw Position", 
																			  "Discharge" , 
																			  "Load",
																			  "Insert Date"																			  
                                                     );
													 
												
													$this->table->set_template($tmpl);
													
													if (isset($coarri)){
														for($i=0;$i<count($coarri);$i++){
															$this->table->add_row(
																$coarri[$i]['no'],
																$coarri[$i]['idjointves'],
																$coarri[$i]['vessel'],
																$coarri[$i]['voyage_in'],
																$coarri[$i]['voyage_out'],
																$coarri[$i]['nocontainer'],
																$coarri[$i]['ei'],
																$coarri[$i]['inout'],
																$coarri[$i]['isocode'],
																$coarri[$i]['bplocation'],
																$coarri[$i]['disc'],
																$coarri[$i]['load'],
																$coarri[$i]['datesend']
															);
														}
													}
													echo $this->table->generate();
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
					
					</div>
				</div>
			</div>			
		
<script>
			var table2 = $('#table-codeco').dataTable({
				'info': false,
				'sDom': 'lTfr<"clearfix">tip',
				'oTableTools': {
					'aButtons': [
						{
							'sExtends':    'collection',
							'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
							'aButtons':    [ 'print' ]
						}
					]
				},
				"lengthMenu": [[3, 10, 25, 50, -1], [3, 10, 25, 50, "All"]]
			});
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');			
			
			var table3 = $('#table-coarri').dataTable({
				'info': false,
				'sDom': 'lTfr<"clearfix">tip',
				'oTableTools': {
					'aButtons': [
						{
							'sExtends':    'collection',
							'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
							'aButtons':    [ 'print' ]
						}
					]
				},
				"lengthMenu": [[3, 10, 25, 50, -1], [3, 10, 25, 50, "All"]]
			});
			
			var tt3 = new $.fn.dataTable.TableTools(table3);
			$( tt3.fnContainer() ).insertBefore('div.dataTables_wrapper');	

			function cek_upload() {
				uploadfile = $("attachment").val();
				if(uploadfile=="") {
					alert("File Upload harus diisi!!!");
					return false;
				}
				else if (uploadfile.substr(-3)!="xls"){
					alert("File Upload harus berupa file excell 2003 (xls)!!!");
					return false;
				}
				else {
					return konfirmasi();
				}
			}

			function konfirmasi() {	
				question = confirm("data akan diupload, cek apakah file sudah benar?")
				if (question != "0")	return true;
				else					return false;
			}
</script>