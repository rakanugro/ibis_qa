<style>
    div.DTTT.btn-group{
        display:none !important;        
    }
	.label {
		display: inline-block;
	}
</style>
<script src="<?=CUBE_?>js/jquery.dataTables.shortingCustom.js"></script>
<script src="<?=CUBE_?>js/jquery.dataTables.shortingEuro.js"></script>

					<div class="row">
						<div class="col-lg-12">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h2 class="pull-left">Request List</h2>
									
									<div id="reportrange" class="pull-right daterange-filter">
										<i class="icon-calendar"></i>
										<span></span> <b class="caret"></b>
									</div>
								</header>
								
									<div class="main-box-body clearfix">
										<!--<input type="button"  value="cek tabel" onclick="var table = $('#table-request').DataTable();console.debug(table.page.info());"></input>-->
										<div class="table-responsive clearfix">
											<?php
													$tmpl = array (
																		'table_open'          => '<form id="payment" name="payment">
																									<input type=\'hidden\' name='.$this->security->get_csrf_token_name().' value='.$this->security->get_csrf_hash().'>
																									<!--<button onclick=\'payment_group("smartpay")\' 
																										type="button" class="btn btn-success">Smartpay</button>-->
																									<button onclick=\'payment_group("ipay")\' 
																										type="button" class="btn btn-warning btn-lg">
																										&nbsp<span class="fa fa-bank"></span>&nbsp&nbsp&nbsp&nbspiPay&nbsp&nbsp&nbsp&nbsp&nbsp
																										</button>																										
																									<table id="table-request" class="table table-hover">',
																		'heading_row_start'   => '<tr class=\'clickableRow\'>',
																		'table_close'         => '</table></form>
																									<h4>Choose Payment Method</h4> 
																									<!--<button onclick=\'payment_group("smartpay")\' 
																										type="button" class="btn btn-success">Smartpay</button>-->
																									<button onclick=\'payment_group("ipay")\' 
																										type="button" class="btn btn-warning btn-lg">
																										&nbsp<span class="fa fa-bank"></span>&nbsp&nbsp&nbsp&nbspiPay&nbsp&nbsp&nbsp&nbsp&nbsp
																										</button>'
																  );

													$this->table->set_template($tmpl);												
													echo $this->table->generate();
												?>
										</div>
									</div>
							</div>
						</div>
					</div>
					
				<script>
			var table2 = $('#table-request').dataTable({
				'info': false,
				'sDom': 'lTfr<"clearfix">tip',
				'columnDefs': [
					{ type: 'date-dd-mmm-yyyy', targets: 5 }
				],
				'oTableTools': {
					'aButtons': [
						{
							'sExtends':    'collection',
							'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
							'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
						}
					]
				},
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
			});
			
			var tt2 = new $.fn.dataTable.TableTools(table2);
			$( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');
		</script>
		
		<script>
			function smartpay(data) {
				var form = document.createElement("form");
				form.setAttribute("method", "post");
				form.setAttribute("action", "<?=ROOT?>smartpay");
				form.setAttribute("target", "");

				var input = document.createElement('input');
				input.type = 'hidden';
				input.name = 'id';
				input.value = data;
				form.appendChild(input);

				document.body.appendChild(form);

				form.submit();

				document.body.removeChild(form);
			
			}
		</script>
		
		<script>
			function klikpay(data) {
				var form = document.createElement("form");
				form.setAttribute("method", "post");
				form.setAttribute("action", "<?=ROOT?>klikpay");
				form.setAttribute("target", "");

				var input = document.createElement('input');
				input.type = 'hidden';
				input.name = 'id';
				input.value = data;
				form.appendChild(input);
				
				var input2 = document.createElement('input');
				input2.type = 'hidden';
				input2.name = <?php echo $this->security->get_csrf_token_name(); ?>;
				input2.value = <?php echo $this->security->get_csrf_hash(); ?>;
				form.appendChild(input2);
				
				document.body.appendChild(form);

				form.submit();

				document.body.removeChild(form);				
			}
		</script>

		<script>
			function payment_group(type) {
				if($("input[name='id_proforma[]']:checked").length==0)
				{
					alert("Belum ada yang dipilih");
					return;
				}
				
				var form = document.getElementById('payment');
				form.setAttribute("method", "post");				
				form.setAttribute("target", "");
								
				if(type=="smartpay")
					form.setAttribute("action", "<?=ROOT?>om/smartpay");
				else if(type=="ipay")
					form.setAttribute("action", "<?=ROOT?>om/klikpay");
				
				form.submit();
			}
		</script>
		