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
							
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><?=$subheading1?></h2>
										<div id="tbl_jktsby" class="pull-right daterange-filter">
												<i class="icon-calendar"></i>
												<span></span> <b class="caret"></b>
											</div>
                                        
                                        </header>
                                        
										
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
                        
                           <!-- <div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2><?//=$subheading2?></h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<?php
													/*$tmpl = array (
																		'table_open'          => '<table id="table-billing" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>'
																  );
													$this->table->clear();
													//create table
													$this->table->set_heading(get_content($this->user_model,"port_cooperation","no"), 
                                                      get_content($this->user_model,"port_cooperation","vessel"), 
                                                      get_content($this->user_model,"port_cooperation","voyage_in"), 
                                                      get_content($this->user_model,"port_cooperation","voyage_out"), 
                                                      get_content($this->user_model,"port_cooperation","callsign"), 
                                                      get_content($this->user_model,"port_cooperation","operatorname"), 
                                                      get_content($this->user_model,"port_cooperation","eta"), 
                                                      get_content($this->user_model,"port_cooperation","etd"), 
                                                      get_content($this->user_model,"port_cooperation","ata"), 
                                                      get_content($this->user_model,"port_cooperation","atd"), 
                                                      get_content($this->user_model,"port_cooperation","terminal")                                 
                                                     );
													$this->table->set_template($tmpl);
													for($i=0;$i<count($vesseltosby);$i++){
														$this->table->add_row(
															$vesseltosby[$i]['no'],
															$vesseltosby[$i]['id_joint_vessel'],
															$vesseltosby[$i]['vessel'],
															$vesseltosby[$i]['voyage_in'],
															$vesseltosby[$i]['voyage_out'],
															$vesseltosby[$i]['call_sign'],
															$vesseltosby[$i]['eta'],
															$vesseltosby[$i]['etd'],
															$vesseltosby[$i]['ata'],
															$vesseltosby[$i]['atd'],
															$vesseltosby[$i]['terminal']
														);
													}
													echo $this->table->generate();
													*/
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							-->
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
			minDate: '01/03/2015',
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
            window.open("<?=ROOT?>port_cooperation/vessel_schedule/"+start.format('DD-MM-YYYY')+"/"+end.format('DD-MM-YYYY'),"_self");
		 }
	  );
	  //Set the initial state of the picker label
	  $('#tbl_jktsby span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
	
    
    });
    
    </script>