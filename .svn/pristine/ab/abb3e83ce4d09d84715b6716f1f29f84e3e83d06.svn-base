<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/buttons.dataTables.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.dataTables.min.css" type="text/css" />
<style>.dt-buttons{display:none}</style>
<style>.custom {
    /*font-size: 8px;*/
    /*font-family: Arial;*/
</style>
<style type="text/css">
.centered
{
    text-align:center;
}
.margin{
	margin-top: 5%;
}
.margin2{
	margin-left: 5%;
}
.margin3{
	margin-left: 29%;
}
}
.margin4{
	margin-left: 40%;
}
</style>
<style>
table.dataTable thead .sorting { background: url(/ui/adminLTE/plugins/datatables/images/sort_both.png) no-repeat center right; }
table.dataTable thead .sorting_asc { background: url(/ui/adminLTE/plugins/datatables/images/sort_asc.png) no-repeat center right; }
table.dataTable thead .sorting_desc { background: url(/ui/adminLTE/plugins/datatables/images/sort_desc.png) no-repeat center right; }

table.dataTable thead .sorting_asc_disabled { background: url(/ui/adminLTE/plugins/datatables/images/sort_asc_disabled.png) no-repeat center right; }
table.dataTable thead .sorting_desc_disabled { background: url(/ui/adminLTE/plugins/datatables/images/sort_desc_disabled.png) no-repeat center right; }



.dataTables_wrapper .dataTables_paginate .paginate_button {
  background: none;
  color: #e84e40 !important;
  border-radius: 4px;
  border: 1px solid #ffffff;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background: none;
  color:#e84e40 !important;
  border-radius: 4px;
  border: 1px solid #ffffff;
  background-color: #eeeeee;
}
 
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  background: none;
  color: #ffffff !important;
  background-color: #e84e40;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background: none;
  color: #fff !important;
  border: 1px solid #ffffff;
  background-color: #e84e40;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
  background: none;
  color:#fff !important;
  background-color: #e84e40;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
  background: none;
  color:#e84e40 !important;
  background-color: #ffffff;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
  background: none;
  color:#e84e40 !important;
  background-color: #ffffff;
}
th{
	text-align: center;
}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100; }

tbody>tr>td:nth-child(1){text-align:center;}
tbody>tr>td:nth-child(2){text-align:right;}
tbody>tr>td:nth-child(3){text-align:center;}
tbody>tr>td:nth-child(4){text-align:center;}
tbody>tr>td:nth-child(5){text-align:center;}
tbody>tr>td:nth-child(6){text-align:center;}
tbody>tr>td:nth-child(7){text-align:center;}
tbody>tr>td:nth-child(8){text-align:center;}
tbody>tr>td:nth-child(9){text-align:center;}
</style>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Reporting</li>
			<li class="active"><span>Laporan Payment</span></li>
		</ol>

		<h1>LAPORAN PEMBAYARAN</h1>
	</div>
</div>

<div class="container">
    <div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal" id="formsearch">
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Jenis Payment</label>
											<div class="row">
												<div class="col-xs-5">
													<select name="INV_JENIS_PAYMENT" id="INV_JENIS_PAYMENT" class="form-control select2" style="width: 100%;">
														<option value="">All</option>
														<option value="INVOICE">INVOICE</option>
														<option value="UPER">UPER</option>
													</select>
												</div>
											</div>
										</div>
									</div>

				             		<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Status Transfer</label>
											<div class="row">
												<div class="col-xs-5">
													<select for="" class="form-control select" style="width: 100%;" name="INV_STATUS_TRANSFER" id="INV_STATUS_TRANSFER">
                                                    	<option value="">All</option>
                                                        <option value="S">TRANSFER</option>
														<option value="F">FAILED</option>
														<option value="N">BELUM TRANSFER</option>
                                                    </select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
			                            <div class="box-body">
			                               <label for="" class="col-sm-3 control-label">Tanggal Payment</label>
			                               <div class="row">
												<div class="col-xs-4">
													<div class="input-group">
														<input type="date" name="TGL_PAYMENT_START" id="TGL_PAYMENT_START" class="form-control form_datetime" placeholder="dd/mm/yy">

													</div>
												</div>
												<div class="col-xs-4">
													<div class="input-group">
														<input type="date" name="TGL_PAYMENT_END" id="TGL_PAYMENT_END" class="form-control form_datetime" placeholder="dd/mm/yy">

													</div>
												</div>
											</div>
			                            </div>
			                        </div>
								</div>
							</div>

                            <!--START Penambahan Filter Laporan Payment SIGMA 29/10/19-->
                            <div class="col-md-12"><br>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="all" onclick="javascript:checkAll(this)"/>
                                        <label for="all">
                                            ALL
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="NO_RECEIPT" value="NO_RECEIPT" name="NO_RECEIPT" checked onclick="return false;">
                                        <label for="NO_RECEIPT">
                                            No Receipt
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="TGL_RECEIPT" value="TGL_RECEIPT" name="TGL_RECEIPT" checked onclick="return false;">
                                        <label for="NO_RECEIPT">
                                            Tgl Receipt
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="JNS_PAYMENT" value="JNS_PAYMENT" name="JNS_PAYMENT" checked onclick="return false;">
                                        <label for="NO_RECEIPT">
                                            Jenis Payment
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="CUST" value="CUST" name="CUST" onclick="javascript:checkSingle(this)"/>
                                        <label for="CUST">
                                            Customer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="CUR" value="CUR" name="CUR" onclick="javascript:checkSingle(this)"/>
                                        <label for="CUR">
                                            Currency
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="AMO_RECEIPT" value="AMO_RECEIPT" name="AMO_RECEIPT" checked onclick="return false;">
                                        <label for="AMO_RECEIPT">
                                            Amount Receipt
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="BANK" value="BANK" name="BANK" onclick="javascript:checkSingle(this)"/>
                                        <label for="BANK">
                                            Bank
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="STS_TRANSFER" value="STS_TRANSFER" name="STS_TRANSFER" checked onclick="return false;">
                                        <label for="STS_TRANSFER">
                                            Status Transfer
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--STOP Penambahan Filter Laporan Payment SIGMA 29/10/19-->

							<!--<div class="box-body">
					            <div class="col-sm-12 text-right">
						              <button type="button" class="btn btn-primary btn-sm" onclick="clearreset()"> Clear</button>
						              <button type="submit" class="btn btn-primary btn-sm"><a href="<?php //echo base_url('');?>" > <i class="fa fa-search"> </i> Search  </a></button>
			  					</div>
		          			</div>-->

							<!-- <div class="col-md-9">
								<div class="box-body">
									<div class="form-group">
							            <div class="col-sm-offset-12 col-sm-10 text-right">
								              <button type="button" onclick="ClearSearch()" class="btn btn-primary btn-lg" data-toggle="" data-target=""> Clear</button>
								              <button type="button" class="btn btn-primary"  onclick="loaddata()" ><i class="fa fa-search" style="color:white;"> </i> Search</button>
							            </div>
			      					</div>
			  					</div>
			          		</div> -->
						</form>

                        <div class="box-body">
                            <div class="col-sm-12 text-right">
                                <button type="button" class="btn btn-primary btn-sm" onclick="clearreset()"> Clear</button>
                                <button onclick="exportexcel3()" class="btn btn-primary btn-sm" >Export To Excel</button>
                                <button onclick="exportpdf3()"   class="btn btn-primary btn-sm" >Print Report</button>
                            </div>
                        </div>

					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<!--<div class="container">-->
<!--    <div class="row">-->
<!--	    <div class="clo-lg-12">-->
<!--		    <div class="main-box clearfix">-->
<!--			    <div class="main-box-body clearfix">-->
<!--				    <div class="table-responsive">-->
<!--					<table  class="table table-hover custom" id="dynamic-table">-->
<!--						<thead>-->
<!--							<tr>-->
<!--								<th class="all">No</th>-->
<!--								<th class="all">No Receipt</th>-->
<!--								<th class="all">Tanggal Receipt</th>-->
<!--								<th class="all">Jenis Payment</th>-->
<!--								<th class="all">Customer</th>-->
<!--								<th class="all">Curr</th>-->
<!--								<th class="all">Amount Receipt</th>-->
<!--								<th class="all">Status Transfer</th>-->
<!--								<th class="all">Bank</th>-->
<!--							</tr>-->
<!--						</thead>-->
<!--					</table>-->
<!--					<div class="col-md-6">-->
<!--					<div class="box-body">-->
<!--						<div class="form-group">-->
<!--						<div class="box -body"> -->
<!--				            <div class="col-sm-offset-5 col-sm-10">-->
<!--				              <button onclick="exportexcel3()" class="btn btn-primary btn-sm" >Export To Excel</button>-->
<!--							  <button onclick="exportpdf3()"   class="btn btn-primary btn-sm" >Print Report</button>-->
<!--				            </div>-->
<!--							</div> -->
<!--						</div>-->
<!--					</div>-->
<!--				-->
<!--			        </div>-->
<!--				</div>-->
<!--			    </div>-->
<!--		    </div>-->
<!--	    </div>-->
<!--    </div>-->
<!--</div>-->


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/buttons.html5.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script> -->

<script type="text/javascript">
	$(".form_datetime").date({
        format: "dd/mm/yyyy",
    });
</script>

<script>
    $("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

	$(document).ready(function() {
		$('#dynamic-table').DataTable();
		loaddata();
		/*
		var table = $('#table-example').dataTable({
			'info': false,
			"lengthChange": false,
			'sDom': 'lTr<"clearfix">tip',
			'oTableTools': {
	            'aButtons': [
	                {
	                    'sExtends':    'collection',
	                    'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
	                    'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
	                }
	            ]
	        }
		});
		*/
	});

		$("#excelexport").click(function(){
			$(".dt-button.buttons-excel.buttons-html5").click();
		return false;
		});

		$("#pdfexport").click(function(){
			$(".dt-button.buttons-pdf.buttons-html5").click();
		return false;
		});


	function loaddata(){
		// alert('1234');
		// alert(1234);
		var path = '';
		path = "<?php echo ROOT.'einvoice/reporting/paymenthistory';?>";

		var JENIS_PAYMENT			= $('#INV_JENIS_PAYMENT').val();
		var STATUS_TRANSFER			= $('#INV_STATUS_TRANSFER').val();
    	var TGL_PAYMENT_START 		= $("#TGL_PAYMENT_START").val();
    	var TGL_PAYMENT_END 		= $("#TGL_PAYMENT_END").val();

		$('#dynamic-table').DataTable( {
				"bFilter": false,
				"bInfo": false,
				"order": [[ 2, "desc" ]],
				"lengthMenu": [ 10, 25, 50, 100, 250 ],
				"fixedHeader": false,
				"autoWidth": true,
				"destroy": true, responsive: true,
				dom: 'Bfrtp<"bottom"li><"clear">',
        buttons: [
        			{

					extend: 'pdfHtml5',

					  	exportOptions: {
		                    columns: [  0,1,2,3,4,5,6]
		                },
					title: 'LAPORAN PERIODIK',
					filename: 'Laporan Periodik',
					messageTop: 'Jenis Nota 	 : '+$('#INV_NOTA_LAYANAN option:selected').text()+'                                                                                                                                                                                                                                                                                              Periode : All ' + '\n' + '\n' + 'Layanan          : '+$('#INV_NOTA_JENIS option:selected').text()+'' + '\n' +  '\n' + 'Status Bayar  : '+$('#STATUS_LUNAS option:selected').text()+'',
					orientation: 'landscape',
					pageSize: 'A4',
					 widths: [ 'auto', '*', '*' ] ,
					customize: function(doc) {

						doc['footer']=(function(page, pages) {
								return {
								columns: [
								'',
								{
								alignment: 'right',
								text: [
								{ text: page.toString(), italics: true },
								' of ',
								{ text: pages.toString(), italics: true }
								]
								}
								],
								margin: [10, 0]
								}
								});

						doc.content.splice( 0, 0, {
                        margin: [ 0, 0, 0, 0 ],
                        alignment: 'left',
                        image: 'data:image/jpeg;base64,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',
                        	width: 75
                    } );
						doc.defaultStyle.fontSize = 7; //<-- set fontsize to 16 instead of 10
						doc.defaultStyle.alignment = 'left';
						doc.styles.title.fontSize = 20;
						doc.styles.tableHeader.fontSize = 8;
						doc.pageMargins = [20,20,20,20];
						doc.styles['td:nth-child(2)'] = {
					       width: '500px',
					       'max-width': '500px'
					     }
					}


			     },
			     {
			     	extend: 'excel',
			     	exportOptions: {
	               		columns: [  0,1,2,3,4,5,6]
	               	},
			     	title: '',
					filename: 'Laporan Periodik',
					exportOptions: {
						fontSize: 11,
		                stripHtml: false
		            },

			     	customize: function (xlsx) {
		                var sheet = xlsx.xl.worksheets['sheet1.xml'];
		                var numrows = 8;
		                var clR = $('row', sheet);
		                
		                clR.each(function () {
		                    var attr = $(this).attr('r');
		                    var ind = parseInt(attr);
		                    ind = ind + numrows;
		                    $(this).attr("r",ind);
		                });

		                // Create row before data
		                $('row c ', sheet).each(function () {
		                    var attr  = $(this).attr('r');
		                    var pre   = attr.substring(0, 1);
		                    var ind   = parseInt(attr.substring(1, attr.length));
		                    ind = ind + numrows;
		                    $(this).attr("r", pre + ind);
		                });

		                function Addrow(index,data) {
		                    msg = '<row r="'+index+'">'
		                    for(i=0;i<data.length;i++){
		                        var key=data[i].key;
		                        var value=data[i].value;
		                        msg += '<c t="inlineStr" r="' + key + index + '">';
		                        msg += '<is>';
		                        msg += '<t>'+value+'</t>';
		                        msg += '</is>';
		                        msg += '</c>';
		                    }
		                    msg += '</row>';
		                    return msg;
		                }


		                //insert
		               			var r2 = Addrow(2, [{ key: 'C', value: 'PT. Pelabuhan Indonesia II (Persero)' }/*,  { key: 'F', value: $('#TGL_PELUNASAN_START').val() }, { key: 'G', value: '-' }, { key: 'H', value: $('#TGL_PELUNASAN_END').val() }*/,]);

		               			var r4 = Addrow(5, [{ key: 'C', value: 'LAPORAN PERIODIK' },]);

				                /*var r3 = Addrow(3, [{ key: 'C', value: '' }, { key: 'C', value:  $('#INV_NOTA_JENIS option:selected').text() }, { key: 'H', value: 'Customer :' }, { key: 'I', value: $('#CUSTOMER').val() },]);*/

				                var r1 = Addrow(6, [{ key: 'C', value: 'PERIODE : ' },{ key: 'D', value: $('#TGL_PELUNASAN_START').val() },{ key: 'E', value: '-' },{ key: 'F', value: $('#TGL_PELUNASAN_END').val() }, ]);

				                /*var r4 = Addrow(1,[{key: 'A', value: image},]);*/


				                sheet.childNodes[0].childNodes[1].innerHTML =  r2+ r4+ r1 + sheet.childNodes[0].childNodes[1].innerHTML;
		            }
			     }

			     ],

			    /* "columnDefs":[
					{
						"width" : "300%" ,
						 "targets": [2] ,
					}
				],*/
				"ajax": {
					"url": path,
					data : function ( d ) {
								d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
								/*d.INV_NOTA_JENIS	= INV_NOTA_JENIS;*/

								d.JENIS_PAYMENT			= JENIS_PAYMENT;
								d.STATUS_TRANSFER		= STATUS_TRANSFER;
						        d.TGL_PAYMENT_START		= TGL_PAYMENT_START;
						        d.TGL_PAYMENT_END 		= TGL_PAYMENT_END;
						        d.UNIT_CODE 			= '<?php echo $this->session->userdata('unit_id') ?>';
								d.ROLE_TYPE				= '<?php echo $this->session->userdata('role_type') ?>';
								d.ORG_ID				= '<?php echo $this->session->userdata('unit_org') ?>';
						},
					"type": "POST"
				},
				"columns": [
										{ "data": "num" },
										{ "data": "TRX_NUMBER" },
										{ "data": "CREATED" },
										{ "data": "JENIS_PAYMENT"},
										{ "data": "CUSTOMER_NAME"},
										{ "data": "CURRENCY"},
										{ "data": "AMOUNT_RECEIPT"},
										{ "data": "STATUS_TRANSFER"},
										{ "data": "BANK"},
				],} );

		return false;
	}
</script>

<script type="text/javascript">

	function clearreset(){
       window.location.reload(true);
	}

    function checkAll(o) {
        var boxes = document.getElementsByTagName("input");
        for (var x = 0; x < boxes.length; x++) {
            var obj = boxes[x];
            if (obj.type == "checkbox") {
                //if (obj.name != "check")
                if (obj.name != "NO_RECEIPT" && obj.name != "TGL_RECEIPT" && obj.name != "JNS_PAYMENT" && obj.name != "STS_TRANSFER" && obj.name != "AMO_RECEIPT")
                    obj.checked = o.checked;
            }
        }
    }

    function checkSingle(o) {
        var boxes = document.getElementsByTagName("input");
        for (var x = 0; x < boxes.length; x++) {
            var obj = boxes[x];
            if (obj.type == "checkbox") {
                if (obj.name == "")
                    obj.checked = o.uncheck;
            }
        }
    }

	function exportexcel3(){
	var JENIS_PAYMENT			= $('#INV_JENIS_PAYMENT').val();
	var STATUS_TRANSFER			= $('#INV_STATUS_TRANSFER').val();
	var TGL_PAYMENT_START 		= $("#TGL_PAYMENT_START").val();
	var TGL_PAYMENT_END 		= $("#TGL_PAYMENT_END").val();
    var NO_RECEIPT		        = 'false'; if ($("input[type=checkbox][name=NO_RECEIPT]:checked").val() !== undefined){ var NO_RECEIPT = 'true'; }
    var TGL_RECEIPT		        = 'false'; if ($("input[type=checkbox][name=TGL_RECEIPT]:checked").val() !== undefined){ var TGL_RECEIPT = 'true'; }
    var JNS_PAYMENT		        = 'false'; if ($("input[type=checkbox][name=JNS_PAYMENT]:checked").val() !== undefined){ var JNS_PAYMENT = 'true'; }
    var CUST 		            = 'false'; if ($("input[type=checkbox][name=CUST]:checked").val() !== undefined){ var CUST = 'true'; }
    var CUR 		            = 'false'; if ($("input[type=checkbox][name=CUR]:checked").val() !== undefined){ var CUR = 'true'; }
    var AMO_RECEIPT 		    = 'false'; if ($("input[type=checkbox][name=AMO_RECEIPT]:checked").val() !== undefined){ var AMO_RECEIPT = 'true'; }
    var BANK 		            = 'false'; if ($("input[type=checkbox][name=BANK]:checked").val() !== undefined){ var BANK = 'true'; }
    var STS_TRANSFER 		    = 'false'; if ($("input[type=checkbox][name=STS_TRANSFER]:checked").val() !== undefined){ var STS_TRANSFER = 'true'; }
	window.open('<?php echo ROOT.'einvoice/reporting/cetak_paymenthistoryexcel';?>?'
		+"JENIS_PAYMENT="+JENIS_PAYMENT+"&"
		+"STATUS_TRANSFER="+STATUS_TRANSFER+"&"
		+"TGL_PAYMENT_START="+TGL_PAYMENT_START+"&"
		+"TGL_PAYMENT_END="+TGL_PAYMENT_END+"&"
        +"NO_RECEIPT="+NO_RECEIPT+"&"
        +"TGL_RECEIPT="+TGL_RECEIPT+"&"
        +"JNS_PAYMENT="+JNS_PAYMENT+"&"
        +"CUST="+CUST+"&"
        +"CUR="+CUR+"&"
        +"AMO_RECEIPT="+AMO_RECEIPT+"&"
        +"BANK="+BANK+"&"
        +"STS_TRANSFER="+STS_TRANSFER+"&"
		,'_blank');
	}

	function exportpdf3(){
	var JENIS_PAYMENT			= $('#INV_JENIS_PAYMENT').val();
	var STATUS_TRANSFER			= $('#INV_STATUS_TRANSFER').val();
	var TGL_PAYMENT_START 		= $("#TGL_PAYMENT_START").val();
	var TGL_PAYMENT_END 		= $("#TGL_PAYMENT_END").val();
    var NO_RECEIPT		        = ''; if ($("input[type=checkbox][name=NO_RECEIPT]:checked").val() !== undefined){ var NO_RECEIPT = '1'; }
    var TGL_RECEIPT		        = ''; if ($("input[type=checkbox][name=TGL_RECEIPT]:checked").val() !== undefined){ var TGL_RECEIPT = '1'; }
    var JNS_PAYMENT		        = ''; if ($("input[type=checkbox][name=JNS_PAYMENT]:checked").val() !== undefined){ var JNS_PAYMENT = '1'; }
    var CUST 		            = ''; if ($("input[type=checkbox][name=CUST]:checked").val() !== undefined){ var CUST = '1'; }
    var CUR 		            = ''; if ($("input[type=checkbox][name=CUR]:checked").val() !== undefined){ var CUR = '1'; }
    var AMO_RECEIPT 		    = ''; if ($("input[type=checkbox][name=AMO_RECEIPT]:checked").val() !== undefined){ var AMO_RECEIPT = '1'; }
    var BANK 		            = ''; if ($("input[type=checkbox][name=BANK]:checked").val() !== undefined){ var BANK = '1'; }
    var STS_TRANSFER 		    = ''; if ($("input[type=checkbox][name=STS_TRANSFER]:checked").val() !== undefined){ var STS_TRANSFER = '1'; }
        window.open('<?php echo ROOT.'einvoice/reporting/cetak_laporanpembayaran';?>?'
		+"JENIS_PAYMENT="+JENIS_PAYMENT+"&"
		+"STATUS_TRANSFER="+STATUS_TRANSFER+"&"
		+"TGL_PAYMENT_START="+TGL_PAYMENT_START+"&"
		+"TGL_PAYMENT_END="+TGL_PAYMENT_END+"&"
        +"NO_RECEIPT="+NO_RECEIPT+"&"
        +"TGL_RECEIPT="+TGL_RECEIPT+"&"
        +"JNS_PAYMENT="+JNS_PAYMENT+"&"
		+"CUST="+CUST+"&"
		+"CUR="+CUR+"&"
		+"AMO_RECEIPT="+AMO_RECEIPT+"&"
        +"BANK="+BANK+"&"
		+"STS_TRANSFER="+STS_TRANSFER+"&"
		,'_blank');
	}

</script>

<script>
function SetDate($date){
	var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
						"Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	var dt1;
	var formattedDate1 = new Date($date);
	var d1 = formattedDate1.getDate();
	var m1 = monthNames[formattedDate1.getMonth()];
	var y1 = formattedDate1.getFullYear();
	dt1  = d1+'-'+m1+'-'+y1;

	return dt1;
}

function GetDate(str)
	{
		var arr = str.split("-");
		var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

		var month = (1+months.indexOf(arr[1].toLowerCase())).toString();
		if(month.length==1) month='0'+month;
		var year = '20' + parseInt(arr[2]);
		var day = parseInt(arr[0]);
		var result = year + '-' + month + '-' + ((day < 10 ) ? "0"+day : day);
		return result;
	}
</script>
