<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#">Jakarta<->Surabaya</a></li>
										<li class="active"><span><?=$heading?></span></li>
									</ol>
									
									<h1><?=$heading?></h1>
								</div>
							</div>

						<div class="bs-example">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#spil" data-toggle="tab">SPIL</a></li>
							<li><a href="#temas" data-toggle="tab">TEMAS</a></li>
							<li><a href="#tnt" data-toggle="tab">TANTO</a></li>
							<li><a href="#mrt" data-toggle="tab">MERATUS</a></li>
							<li><a href="#ctp" data-toggle="tab">CTP</a></li>
						</ul>
							<div class="tab-content" id="tabs">
								<div class="tab-pane fade active in" id="spil">
								<div class="row">
									<div class="col-lg-12">
										<div class="main-box clearfix">
											<header class="main-box-header clearfix">
											
												<div id="tbl_jktsby" class="pull-right daterange-filter">
													<i class="icon-calendar"></i>
													<span></span> <b class="caret"></b>
												</div>
												<li class="active"><span>SUMMARY</span></li>
												20 FULL =  <?=$spil20?> BOX<br>
												40 FULL = <?=$spil40?> BOX<br>
												45 FULL = <?=$spil45?> BOX<br>
											</header>
											<br />
											
											<div class="main-box-body clearfix">
												<div class="table-responsive">
													<?php
														$tmpl = array (
																			'table_open'          => '<table id="tbl_jktsby" class="table table-hover">',
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
							</div>
							<div class="tab-pane" id="temas">
								
								 <div class="row">
										<div class="col-lg-12">
											<div class="main-box clearfix">
												<header class="main-box-header clearfix">
												<div id="tbl_jktsby" class="pull-right daterange-filter">
													<i class="icon-calendar"></i>
													<span></span> <b class="caret"></b>
												</div>
												<li class="active"><span>SUMMARY</span></li>
												20 FULL =  <?=$tms20?> BOX<br>
												40 FULL = <?=$tms40?> BOX<br>
												45 FULL = <?=$tms45?> BOX<br>
												</header>
												<br />
												<div class="main-box-body clearfix">
													<div class="table-responsive">
														<?php
														   $tmpl1 = array (
																				'table_open'          => '<table id="table-billing" class="table table-hover">',
																				'heading_row_start'   => '<tr class=\'clickableRow\'>'
																		  );
															$this->table->clear();
															//create table
															$this->table->set_heading("No", 
															  "Vessel", 
															  'Voyage (In-Out)', 
															  "Call Sign", 
															  "Operator Name", 
															  "ETA", 
															  "ETD", 
															  "ATA", 
															  "ATD", 
															  "Terminal",
															'Qty 20F','Qty 40F','Qty 45F'
															 );
															 
															
															$this->table->set_template($tmpl1);
															for($i=0;$i<count($vesseltms);$i++){
																$this->table->add_row(
																	$vesseltms[$i]['no'],
																	$vesseltms[$i]['vessel'],
																	$vesseltms[$i]['voyage'],
																	$vesseltms[$i]['call_sign'],
																	$vesseltms[$i]['operator_name'],
																	$vesseltms[$i]['eta'],
																	$vesseltms[$i]['etd'],
																	$vesseltms[$i]['ata'],
																	$vesseltms[$i]['atd'],
																	$vesseltms[$i]['terminal'],
																	$vesseltms[$i]['qty_20'],
																	$vesseltms[$i]['qty_40'],
																	$vesseltms[$i]['qty_45']
																);
															}
															echo $this->table->generate();
															
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane" id="tnt">
								<div class="row">
										<div class="col-lg-12">
											<div class="main-box clearfix">
												<header class="main-box-header clearfix">
												<div id="tbl_jktsby" class="pull-right daterange-filter">
													<i class="icon-calendar"></i>
													<span></span> <b class="caret"></b>
												</div>
												<li class="active"><span>SUMMARY</span></li>
												20 FULL =  <?=$tnt20?> BOX<br>
												40 FULL = <?=$tnt40?> BOX<br>
												45 FULL = <?=$tnt45?> BOX<br>
												</header>
												<br />
												<div class="main-box-body clearfix">
													<div class="table-responsive">
														<?php
														   $tmpl2 = array (
																				'table_open'          => '<table id="table-billing" class="table table-hover">',
																				'heading_row_start'   => '<tr class=\'clickableRow\'>'
																		  );
															$this->table->clear();
															//create table
															$this->table->set_heading("No", 
															  "Vessel", 
															  'Voyage (In-Out)', 
															  "Call Sign", 
															  "Operator Name", 
															  "ETA", 
															  "ETD", 
															  "ATA", 
															  "ATD", 
															  "Terminal",
															'Qty 20F','Qty 40F','Qty 45F'
															 );
															$this->table->set_template($tmpl2);
															for($i=0;$i<count($vesseltnt);$i++){
																$this->table->add_row(
																	$vesseltnt[$i]['no'],
																	$vesseltnt[$i]['vessel'],
																	$vesseltnt[$i]['voyage'],
																	$vesseltnt[$i]['call_sign'],
																	$vesseltnt[$i]['operator_name'],
																	$vesseltnt[$i]['eta'],
																	$vesseltnt[$i]['etd'],
																	$vesseltnt[$i]['ata'],
																	$vesseltnt[$i]['atd'],
																	$vesseltnt[$i]['terminal'],
																	$vesseltnt[$i]['qty_20'],
																	$vesseltnt[$i]['qty_40'],
																	$vesseltnt[$i]['qty_45']
																);
															}
															echo $this->table->generate();
															
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane" id="mrt">
								<div class="row">
										<div class="col-lg-12">
											<div class="main-box clearfix">
												<header class="main-box-header clearfix">
												<div id="tbl_jktsby" class="pull-right daterange-filter">
													<i class="icon-calendar"></i>
													<span></span> <b class="caret"></b>
												</div>
												<li class="active"><span>SUMMARY</span></li>
												20 FULL =  <?=$mrt20?> BOX<br>
												40 FULL = <?=$mrt40?> BOX<br>
												45 FULL = <?=$mrt45?> BOX<br>
												</header>
												<br />
												<div class="main-box-body clearfix">
													<div class="table-responsive">
														<?php
														   $tmpl3 = array (
																				'table_open'          => '<table id="table-billing" class="table table-hover">',
																				'heading_row_start'   => '<tr class=\'clickableRow\'>'
																		  );
															$this->table->clear();
															//create table
															$this->table->set_heading("No", 
															  "Vessel", 
															  'Voyage (In-Out)', 
															  "Call Sign", 
															  "Operator Name", 
															  "ETA", 
															  "ETD", 
															  "ATA", 
															  "ATD", 
															  "Terminal",
															'Qty 20F','Qty 40F','Qty 45F'
															 );
															$this->table->set_template($tmpl3);
															for($i=0;$i<count($vesselmrt);$i++){
																$this->table->add_row(
																	$vesselmrt[$i]['no'],
																	$vesselmrt[$i]['vessel'],
																	$vesselmrt[$i]['voyage'],
																	$vesselmrt[$i]['call_sign'],
																	$vesselmrt[$i]['operator_name'],
																	$vesselmrt[$i]['eta'],
																	$vesselmrt[$i]['etd'],
																	$vesselmrt[$i]['ata'],
																	$vesselmrt[$i]['atd'],
																	$vesselmrt[$i]['terminal'],
																	$vesselmrt[$i]['qty_20'],
																	$vesselmrt[$i]['qty_40'],
																	$vesselmrt[$i]['qty_45']
																);
															}
															echo $this->table->generate();
															
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
							<div class="tab-pane" id="ctp">
								<div class="row">
										<div class="col-lg-12">
											<div class="main-box clearfix">
												<header class="main-box-header clearfix">
												<div id="tbl_jktsby" class="pull-right daterange-filter">
													<i class="icon-calendar"></i>
													<span></span> <b class="caret"></b>
												</div>
												<li class="active"><span>SUMMARY</span></li>
												20 FULL =  <?=$ctp20?> BOX<br>
												40 FULL = <?=$ctp40?> BOX<br>
												45 FULL = <?=$ctp45?> BOX<br>
												</header>
												<br />
												<div class="main-box-body clearfix">
													<div class="table-responsive">
														<?php
														   $tmpl4 = array (
																				'table_open'          => '<table id="table-billing" class="table table-hover">',
																				'heading_row_start'   => '<tr class=\'clickableRow\'>'
																		  );
															$this->table->clear();
															//create table
															$this->table->set_heading("No", 
															  "Vessel", 
															  'Voyage (In-Out)', 
															  "Call Sign", 
															  "Operator Name", 
															  "ETA", 
															  "ETD", 
															  "ATA", 
															  "ATD", 
															  "Terminal",
															'Qty 20F','Qty 40F','Qty 45F'
															 );
															$this->table->set_template($tmpl4);
															for($i=0;$i<count($vesselctp);$i++){
																$this->table->add_row(
																	$vesselctp[$i]['no'],
																	$vesselctp[$i]['vessel'],
																	$vesselctp[$i]['voyage'],
																	$vesselctp[$i]['call_sign'],
																	$vesselctp[$i]['operator_name'],
																	$vesselctp[$i]['eta'],
																	$vesselctp[$i]['etd'],
																	$vesselctp[$i]['ata'],
																	$vesselctp[$i]['atd'],
																	$vesselctp[$i]['terminal'],
																	$vesselctp[$i]['qty_20'],
																	$vesselctp[$i]['qty_40'],
																	$vesselctp[$i]['qty_45']
																);
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

							
                        
                          
					
					
				<!--	<script>
					
						//tables-advanced.html
						var table = $('#tbl_jktsby').dataTable({
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
						
						var tt = new $.fn.dataTable.TableTools(table);
						$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
					</script>-->
    <script>
    $(document).ready(function() {
		$('#tbl_jktsby').daterangepicker({
			startDate: moment().subtract('days', 29),
			endDate: moment(),
			minDate: '01/01/2015',
			maxDate: '31/12/2015',
			dateLimit: { days: 60 },
			showDropdowns: true,
			showWeekNumbers: true,
			timePicker: false,
			timePickerIncrement: 1,
			timePicker12Hour: true,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
				'Last 7 Days': [moment().subtract('days', 6), moment()],
				'Last 30 Days': [moment().subtract('days', 29), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
			},
			opens: 'left',
			buttonClasses: ['btn btn-default'],
			applyClass: 'btn-small btn-primary',
			cancelClass: 'btn-small',
			format: 'DD/MM/YYYY',
			separator: ' to ',
			locale: {
				applyLabel: 'Submit',
				fromLabel: 'From',
				toLabel: 'To',
				customRangeLabel: 'Custom Range',
				daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
				monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				firstDay: 1
			}
		 },
		 function(start, end) {
		    //alert('start :'+start.format('DD-MM-YYYY'));
		    //alert('end :'+end.format('DD-MM-YYYY'));
            //console.log("Callback has been called!");
            $('#tbl_jktsby span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            window.open("<?=ROOT?>port_cooperation/dashboard_monitoring/"+start.format('DD-MM-YYYY')+"/"+end.format('DD-MM-YYYY'),"_self");
		 }
	  );
	  //Set the initial state of the picker label
	  $('#tbl_jktsby span').html('<?=$startDate?>' + ' to ' + '<?=$endDate?>');
	
        
    });
	

    </script>
	
<style type="text/css">
	.bs-example{
		margin: 20px;
	}
</style>