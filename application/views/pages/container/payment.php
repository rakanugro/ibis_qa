<style>
    div.DTTT.btn-group{display:none !important;}
	.label {display: inline-block;}
	div.notes{font-size: 0.9em;border-radius: 5px;border: 0.1px solid #73AD21;padding: 10px;height:70px;}
	div.myContainer{width: 40px;height: 15px;margin: 0;display:inline-block;}
	.warnaTpk{background:#6fcaf7;}
	.warnaPtp{background:#e8e8e8;}
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

		<script type="text/javascript">
    		 $(function() {
             	$('#table-request_length').append( "<div class='notes'><span  style='color:blue;'>*) Anda hanya bisa memilih invoice/payment dengan warna yang sama</span><br/><div class='myContainer warnaTpk'></div> :Invoice/Payment IPC-TPK<br/><div class='myContainer warnaPtp'></div> :Invoice/Payment PTP</div>" );
             	$('tr:has(td:contains("TPK"))').addClass('warnaTpk');
				$('tr:has(td:contains("PTP"))').addClass('warnaPtp');
             	$('#table-request').removeClass("table-hover");
             });
		</script>

		<script>
			function payment_group(type) {
				if($("input[name='id_proforma[]']:checked").length==0)
				{
					alert("Belum ada yang dipilih");
					return;
				}
				
				var check_port = "";
				var port_msg = "";
				var tipe ="";
				var enableSubmit = new Boolean(true);

				$("input[name='id_proforma[]']:checked").each(function(){

					tipe = tipe == "" ? $(this).closest('td').find(':hidden').val():tipe;
					if(tipe != $(this).closest('td').find(':hidden').val()){
						alert("Anda hanya bisa memilih invoice/payment dengan warna yang sama");
						enableSubmit=false;
					}

					var noProforma = $(this).val().replace(/\./g,'');
					var temp1 = noProforma.substring(0, 6);
					var temp2 = noProforma.substring(0, 5);

					const tpkPriok = ['010811','010812','010816','010813','010821','010822','010831'];
					const tpk09 = ['95811','95812','95813','95821','95822'];
					const ptp = ['010011','010012','010013','010019'];
					const ptp09 = ['95011','95012','95013','95019'];
					const panjang = ['95020','95802'];
					const teluk_bayur = ['011805','010805','010030'];
					const jambi = ['010804','011804','010100'];

					//const palembang = ['958031','950401'];
					//const pontianak = ['958061','925015','950151','915013','950151'];
					const palembang = ['958031','950401','95803','95040'];
					const pontianak = ['958061','925015','950151','915013','950151','95806',];

					const jict2 = ['010814'];
					
					if(ptp.includes(temp1) || ptp09.includes(temp2)){ //PTP

						if (check_port == "" || check_port == 'IDJKT') {
							check_port = 'IDJKT';
						} else {
							port_msg = "Tidak bisa melakukan pembayaran beda site sekaligus";
							return false;
						}
					}else if(tpkPriok.includes(temp1) || tpk09.includes(temp2)){  //TPK
						if (check_port == "" || check_port == 'IDJKT') {
							check_port = 'IDJKT'; //Ref:Edo
						} else {
							port_msg = "Tidak bisa melakukan pembayaran beda site sekaligus";
							return false;
						}
					}else if(panjang.includes(temp2)){ ///Panjang
					 	if (check_port == "" || check_port == 'IDPJG') {
							check_port = 'IDPJG';
						} else {
							port_msg = "Tidak bisa melakukan pembayaran beda site sekaligus";
							return false;
						}
					}else if(teluk_bayur.includes(temp1) || teluk_bayur.includes(temp2)){ ///teluk bayur
					 	if (check_port == "" || check_port == 'IDTLB') {
							check_port = 'IDTLB';
						} else {
							port_msg = "Tidak bisa melakukan pembayaran beda site sekaligus";
							return false;
						}
					}else if(jambi.includes(temp1) || jambi.includes(temp2)){ ///teluk bayur
					 	if (check_port == "" || check_port == 'IDDJB') {
							check_port = 'IDDJB';
						} else {
							port_msg = "Tidak bisa melakukan pembayaran beda site sekaligus";
							return false;
						}
					}else if(pontianak.includes(temp1) || pontianak.includes(temp2)){ ///pontianak
					 	if (check_port == "" || check_port == 'IDPNK') {
							check_port = 'IDPNK';
						} else {
							port_msg = "Tidak bisa melakukan pembayaran beda site sekaligus";
							return false;
						}
					}else if(palembang.includes(temp1) || palembang.includes(temp2)){ ///palembang
					 	if (check_port == "" || check_port == 'IDPLM') {
							check_port = 'IDPLM';
						} else {
							port_msg = "Tidak bisa melakukan pembayaran beda site sekaligus";
							return false;
						}
					}else if(jict2.includes(temp1) || jict2.includes(temp2)){ ///palembang
					 	if (check_port == "" || check_port == 'IDJKT') {
							check_port = 'IDJKT';
						} else {
							port_msg = "Tidak bisa melakukan pembayaran beda site sekaligus";
							return false;
						}
					}else{

						port_msg = "Port Belum Terdaftar";
						return false;
					}
				});
				
				if (port_msg != "") {
					alert(port_msg);
					enableSubmit=false;
				}
		
				var form = document.getElementById('payment');
				form.setAttribute("method", "post");				
				form.setAttribute("target", "");
								
				if(type=="smartpay")
					form.setAttribute("action", "<?=ROOT?>smartpay");
				else if(type=="ipay")
					form.setAttribute("action", "<?=ROOT?>klikpay");

				if(enableSubmit){
					form.submit();
				}	
			}
		</script>
