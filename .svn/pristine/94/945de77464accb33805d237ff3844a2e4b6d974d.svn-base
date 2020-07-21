<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" type="text/css" />
<style>.dt-buttons{display:none}</style>
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

/*sorting awal*/

table.dataTable thead .sorting { background: url(/ui/adminLTE/plugins/datatables/images/sort_both.png) no-repeat center right; }
table.dataTable thead .sorting_asc { background: url(/ui/adminLTE/plugins/datatables/images/sort_asc.png) no-repeat center right; }
table.dataTable thead .sorting_desc { background: url(/ui/adminLTE/plugins/datatables/images/sort_desc.png) no-repeat center right; }

table.dataTable thead .sorting_asc_disabled { background: url(/ui/adminLTE/plugins/datatables/images/sort_asc_disabled.png) no-repeat center right; }
table.dataTable thead .sorting_desc_disabled { background: url(/ui/adminLTE/plugins/datatables/images/sort_desc_disabled.png) no-repeat center right; }

/* sorting akhir*/

/*pagination awal*/

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
  color: white;
  background-color: red;
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

/*pagination akhir*/
th{
	text-align: center;
}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100;}
tbody>tr>td:nth-child(1){text-align:right;}
tbody>tr>td:nth-child(2){text-align:right;}
tbody>tr>td:nth-child(3){text-align:right;}
tbody>tr>td:nth-child(4){text-align:center;}
tbody>tr>td:nth-child(5){text-align:center;}
tbody>tr>td:nth-child(6){text-align:center;}
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Reporting</li>
			<li class="active"><span>Laporan Penggunaan e-Materai</span></li>
		</ol>

		<h1>LAPORAN PENGGUNAAN E-MATERAI</h1>
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
							<div class="form-group">
	                            <div class="box-body">
	                               <label for="" class="col-sm-2 control-label">Bulan</label>
	                               <div class="row">
										<div class="col-xs-4">
											<div class="input-group">
												<input type="month" name="MONTH" id="MONTH" class="form-control form_datetime" placeholder="Month" >

											</div>
										</div>	
									</div>
	                            </div>
	                        </div>
							<div class="box-body">
					            <div class="col-sm-12 text-right">
						              <button type="button" class="btn btn-primary btn-sm" onclick="clearreset()"> Clear</button>
						              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"> </i> Search</button>
			  					</div>
		          			</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
    <div class="row">
	    <div class="clo-lg-12">
		    <div class="main-box clearfix">
			    <div class="main-box-body clearfix">
				    <div class="table-responsive">
						<table  class="table table-hover" id="dynamic-table">
							<thead>
								<tr>
									<!-- <th>No</th> -->
									<th>Bulan</th>
									<th style="width:15%">Jumlah Materai 3000</th>
									<th style="width:15%">Jumlah Materai 6000</th>
									<th style="width:15%">Nominal Materai 3000</th>
									<th style="width:15%">Nominal Materai 6000</th>
									<th style="width:15%">Jumlah Total</th>
									<th style="width:30%">Keterangan</th>
								</tr>
							</thead>
						</table>
			        </div>
			    </div>
		    </div>
	    </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/date-euro.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
 -->

<script type="text/javascript">
    //Date picker
    /*$('#tgl_nota').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

    $('#keluar_nota').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });*/
    $(".form_datetime").date({
        format: "Month",
    });

</script>

<script>

	$("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

	$("#excelexport").click(function(){
			$(".dt-button.buttons-excel.buttons-html5").click();
		return false;
		});

		$("#pdfexport").click(function(){
			$(".dt-button.buttons-pdf.buttons-html5").click();
		return false;
		});

	$(document).ready(function(){
		loaddata();
	});

		function loaddata(){
		var path = '';
		path = "<?php echo ROOT.'einvoice/reporting/emateraisearch';?>";
		var MONTH		= $('#MONTH').val();
    var TGL_PENGGUNAAN_START = $('#TGL_PENGGUNAAN_START').val();
    var TGL_PENGGUNAAN_END = $('#TGL_PENGGUNAAN_END').val();

		$('#dynamic-table').DataTable( {

						"bFilter": false,
						"order": [[ 0, "desc" ]],
				        "bInfo": false,
						"lengthMenu": [ 10, 25, 50, 100, 250 ],
						"fixedHeader": true,
						"autoWidth": true,
						"destroy": true, responsive: true,
						dom: 'Bfrtp<"bottom"li><"clear">',
		        buttons: [

		        			{
					       extend: 'pdfHtml5',
					       exportOptions: {
			               		columns: [  0,1,2,3,4,5,6]
			               },


/*					       title: 'LAPORAN PENGIRIMAN NOTA' + '\n' + 'a new line',*/
					       title: 'LAPORAN PENGGUNAAN MATERAI',
					       filename: 'Laporan Penggunaan Materai',
					       messageTop: 'Organizational Unit 	: '+$('#MONTH option:selected').text()+'                                                                                                                                                                                                        Periode : All ',
					       orientation: 'landscape',

					       pageSize: 'A4',
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
								doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10
								doc.defaultStyle.alignment = 'left';
								doc.styles.title.fontSize = 16;
								doc.styles.tableHeader.fontSize = 10;
								doc.pageMargins = [20,20,20,30];
							}

					     },
					     {
					     	extend: 'excel',
					     	exportOptions: {
			               		columns: [  0,1,2,3,4,5,6]
			               	},
					     	title: '',
					     	filename: 'Laporan Penggunaan Materai',
					     	customize: function (xlsx) {

				                var sheet = xlsx.xl.worksheets['sheet1.xml'];
				                var numrows = 7;
				                var clR = $('row', sheet);

				                //update Row
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
				                /*var image = Addrow(1,[{ key : 'A', value: "<img src='https://www.datatables.net/media/images/nav-dt.png' style='height:30px; width:30px'>"}])*/

				                var r2 = Addrow(5, [{ key: 'A', value: 'Organizational Unit :' }, { key: 'B', value: $('#MONTH option:selected').text() },{ key: 'K', value: 'Periode :' }, { key: 'L', value: 'All'},]);

				                var r1 = Addrow(2, [{ key: 'F', value: 'LAPORAN PENGGUNAAN MATERAI' },]);


				                sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2+  sheet.childNodes[0].childNodes[1].innerHTML;
				            }
			     } ],
				"ajax": {
					"url": path,
					data : function ( d ) {
								d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
								d.MONTH	= $('#MONTH').val();
								d.TGL_PENGGUNAAN_START = TGL_PENGGUNAAN_START;
								d.TGL_PENGGUNAAN_END = TGL_PENGGUNAAN_END;
						        d.UNIT_CODE 		 = '<?php echo $this->session->userdata('unit_id') ?>';
								d.ROLE_TYPE			 = '<?php echo $this->session->userdata('role_type') ?>';
								d.ORG_ID			 = '<?php echo $this->session->userdata('unit_org') ?>';
								/*d.HEADER_CONTEXT	= HEADER_CONTEXT;
								d.INV_NOTA_JENIS	= INV_NOTA_JENIS;
								d.CUSTOMER_NAME		= CUSTOMER_NAME;*/
						},
					"type": "POST"
				},
				"columns": [
										/*{ "data": "num" },*/
										{ "data": "BULAN" },
										{ "data": "MATERAI_3000" },
										{ "data": "MATERAI_6000" },
										{ "data": "MATERAI_3000_SUM" },
										{ "data": "MATERAI_6000_SUM"},
										{ "data": "TOTAL_MATERAI"},
										{ "data": "Keterangan"},
				],} );

		return false;
	}
</script>
<script type="text/javascript">

	function clearreset(){
		window.location.reload(true);
	}

</script>
