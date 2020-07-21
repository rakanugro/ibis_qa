
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											<h2>Rekonsiliasi Header</h2>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-recon" class="table table-hover">',
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
											<h2>Rekonsiliasi Detail</h2>
											<h3 id="recon-detail-title"></h3>
										</header>
										
										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<?php
													$tmpl = array (
																		'table_open'          => '<table id="table-recon-detail" class="table table-hover">'
																  );
																  
													$this->table->clear();
													//create table
													$this->table->set_heading('No','Modul', 'Curr', 'Bank', 'Amount', 'Remaining','Credited','Applied','Date/Time','No Nota', 'User Paid', 'Status Armsg', 'arprocess_date');
													$this->table->set_template($tmpl);
													echo $this->table->generate();
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
					<script>		
						//tables-advanced.html
						var table = $('#table-recon').dataTable({
							'info': false,
							'order': [[ 0, "desc" ]],
							/*'sDom': 'lTfr<"clearfix">tip',
							'oTableTools': {
								'aButtons': [
									{
										'sExtends':    'collection',
										'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
										'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
									}
								]
							},*/
							"lengthMenu": [[9, 10, 25, 50, -1], [9, 10, 25, 50, "All"]] 
						});
						
						//var tt = new $.fn.dataTable.TableTools(table);
						//$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
					</script>
					
					<script>
						$('#table-recon').on('click', 'td', function () {
						//no pkk
						var date = $(this).closest('tr').find('td:eq(0)').text();
						var modul = $(this).closest('tr').find('td:eq(1)').text();
						var col = $(this).parent().children().index($(this));
						var find = "";
						
						if(date=="") return;
						
						if(col==2)
							find = "query_row_allnota";
						else if(col==3)
							find = "query_row_arnotfound";
						else if(col==4)
							find = "query_row_receiptnotfound";
						else if(col==5)
							find = "query_row_overpayment";
						else 
							return;
						
						//detail pkk
						$.post( "recon/getDetailData", {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',date: date, modul:modul, find:find})
							.done(function( data ) {
								//alert( "Data Loaded: " + data );
								var obj = jQuery.parseJSON(data);
								var amount = 0;
								var remaining = 0;
								var credited = 0;
								var applied = 0;
								var currency = "";
								var bank = "";
								var no = 0;
								
								$('#table-recon-detail').find("tr:gt(0)").remove();
								for(i=0;i<obj.data.data.length;i++)
								{
									if(i>0 && (currency!=obj.data.data[i].currency || bank!=obj.data.data[i].bank))
									{
										$('#table-recon-detail tr:last').after('<tr><td></td><td colspan="3" align="center">Total:</td><td align="right">'+amount.toFixed(2)+'</td><td align="right">'+remaining.toFixed(2)+'</td><td align="right">'+credited.toFixed(2)+'</td><td align="right">'+applied.toFixed(2)+'</td><td></td><td></td><td></td><td></td><td></td></tr>');
										amount = 0;
										remaining = 0;
										credited = 0;
										applied = 0;
										no=0;
									}
									
									no++;
									
									$('#table-recon-detail tr:last').after('<tr><td>'+no+'</td><td>'+obj.data.data[i].modul+'</td><td>'+obj.data.data[i].currency+'</td><td>'+obj.data.data[i].bank+'</td><td align="right">'+obj.data.data[i].amount+'</td><td align="right">'+obj.data.data[i].remaining+'</td><td align="right">'+obj.data.data[i].credited+'</td><td align="right">'+obj.data.data[i].applied+'</td><td>'+obj.data.data[i].transdate+'</td><td>'+obj.data.data[i].no_nota+'</td><td>'+obj.data.data[i].userpaid+'</td><td>'+obj.data.data[i].status_armsg+'</td><td>'+obj.data.data[i].arprocess_date+'</td></tr>');
									amount = (amount*100 + (Number(obj.data.data[i].amount)*100))/100;//precision
									remaining = (remaining*100 + (Number(obj.data.data[i].remaining)*100))/100;//precision
									credited = (credited*100 + (Number(obj.data.data[i].credited)*100))/100;//precision
									applied = (applied*100 + (Number(obj.data.data[i].applied)*100))/100;//precision
									
									currency=obj.data.data[i].currency;
									bank=obj.data.data[i].bank;	
								}

								$('#table-recon-detail tr:last').after('<tr><td></td><td colspan="3" align="center">Total:</td><td align="right">'+amount.toFixed(2)+'</td><td align="right">'+remaining.toFixed(2)+'</td><td align="right">'+credited.toFixed(2)+'</td><td align="right">'+applied.toFixed(2)+'</td><td></td><td></td><td></td><td></td><td></td></tr>');
								
								//alert("finish");
							}).fail(function() {
								alert("error");
							  });
							//alert(name);
						});
					</script>