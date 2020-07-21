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

.loading-data {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Reporting</li>
			<li class="active"><span>Dashboard Integrasi</span></li>
		</ol>

		<h1>LAPORAN DASHBOARD INTEGRASI</h1>
		<p><?php  
		$first_day = "";
		if($start_date){
			$first_day = new DateTime($start_date);
		}else{
			$first_day = new DateTime('first day of this month');
		}
		$last_day="";
		if($end_date){
			$last_day = new DateTime($end_date);
		}else{
			$last_day = new DateTime('last day of this month');

		}
    	//$first_day->format('Y/m/d');

	//$date->modify('last day of this month');
		//$last_day->format('Y/m/d');
    ?></p>
				    	

	</div>
</div>

<div class="container">
    <div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal" id="formsearch" method="post" action="<?php echo ROOT.'einvoice/reporting/searchdashboardintegrasi';?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" class="form-control" id="id_owner" value="<?php echo $this->security->get_csrf_hash(); ?>">

							<div class="col-md-9">
								<div class="box-body">
									
									<div class="form-group">
			                            <div class="box-body" style="padding: 10px;">
			                               <label for="" class="col-sm-1 control-label " style="text-align: left">Periode</label>
			                               <div class="row">
												<div class="col-xs-3">
													<div class="input-group">
														<input type="text" name="TGL_PERIODE_START" id="TGL_PERIODE_START" class="form-control form_datetime datepicker" placeholder="yy/mm/dd" value="<?php 
  														echo $first_day->format('Y/m/d');?>">

													</div>
												</div>
			                              		 <label for="" class="col-sm-1 control-label" style="text-align: center">s.d</label>
												
												<div class="col-xs-3">
													<div class="input-group">
														<input type="text" name="TGL_PERIODE_END" id="TGL_PERIODE_END" class="form-control form_datetime datepicker" placeholder="yy/mm/dd" value="<?php echo $last_day->format('Y/m/d'); ?>">

													</div>
												</div>
                                               <!-- Start SIGMA 09/12/2019 Penambahan keterangan hari -->
                                               <div class="col-xs-3">
                                                   <div class="input-group">
                                                       <span style="padding: 20;"><h6> (default today/max 31 days) </h6></span>
                                                   </div>
                                               </div>
                                               <!-- STOP SIGMA 09/12/2019 Penambahan keterangan hari -->
											</div>
			                            </div>
			                        </div>
								</div>
							</div>
							<div class="box-body">
						            <div class="col-sm-12 text-right">
								             
								              <input type="submit" class="btn btn-primary btn-sm" name="proses" value="Proses"> 
								            
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
	    <div class="col-lg-12">
		    <div class="main-box clearfix">
			    <div class="main-box-body clearfix" style="padding-top: 15px;">
			    	<?php foreach ($report_integrasi as $key => $report) {
		  			?>
				  	<div class="col-md-3 ">
    					
						<div class="main-box small-graph-box <?php 
						if($report->HEADER_CONTEXT =="RUPA"){
							echo"green-bg";
						}else if($report->HEADER_CONTEXT =="UST"){
							echo"red-bg";
						}else if($report->HEADER_CONTEXT =="PTKM"){
							echo"yellow-bg";
						}else if($report->HEADER_CONTEXT =="KPL"){
							echo "purple-bg";
						}else if($report->HEADER_CONTEXT =="BRG"){
							echo "emerald-bg";

						}
						 ?> box-header" style="position: relative;cursor:pointer;min-height: 125px" data-name="<?php echo $report->HEADER_CONTEXT; ?>" data-start="<?php  echo $start_date ?>" data-end="<?php echo $end_date?>">
							<i class="fa fa-flag rax"></i>
							<span class="stats-title"><?php if($report->HEADER_CONTEXT =="RUPA"){
							echo"RUPA RUPA";
						}else if($report->HEADER_CONTEXT =="UST"){
							echo"USTER";
						}else if($report->HEADER_CONTEXT =="PTKM"){
							echo"PETI KEMAS";
						}else if($report->HEADER_CONTEXT =="KPL"){
							echo "KAPAL";
						}else if($report->HEADER_CONTEXT =="BRG"){
							echo "BARANG";

						}?></span>
							<span class="subinfo" style="text-align: right;">
								INVOICE <?php echo $report->INV; ?>
							</span>
							
							<span id="CountNotaKapal" class="headline" ></span>

							<div class="progress" id="progresskapal" style="height: 1.5px;">
								<div style="width: 100%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">
								</div>
							</div>
							<span class="subinfo" style="text-align: right;">
								RECEIPT <?php echo $report->RCP; ?>
							</span>
							<span class="subinfo">

							</span>
							<span class="subinfo">

							</span>
						</div>
					</div>
					<?php
						}
					?>
					
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
					<table  class="table table-hover custom" id="dynamic-table">
						<thead>
							<tr>
								<!--<th class="all">No</th>-->
								<th class="all">No</th>
								<th class="all">Deskripsi</th>
								<th class="all">Jumlah</th>
								<th class="all">Detail</th>

							</tr>
						</thead>
						<tbody>
							
						</tbody>
						
					</table>

					<div class="col-md-6">
					<div class="box-body">
						
					</div>
					
			        </div>
					</div>
					<div class="row">
			    		<div class="col-md-5"></div>
				    	<div class="col-md-4 ready-load"></div>
				    	
				    	<div class="col-md-3"></div>
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="table-responsive">
			<table  class="table table-hover" id="table-detail">
				<thead>
					<tr>
						<!--<th class="all">No</th>-->
						<th class="all">No</th>
						<th class="all">No Nota</th>
						<th class="all">Tanggal Nota</th>
						<th class="all">Customer</th>
						<th class="all">Layanan</th>
						<th class="all">Jenis Nota</th>
						<th class="all">Nilai Nota</th>
						<th class="all">Error Message</th>

					</tr>
				</thead>
				<tbody>
					
				</tbody>
				
			</table>

		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var path = '';
		path = "<?php echo ROOT.'einvoice/reporting/detaildashboardintegrasi';?>";

		  $(".box-header").click(function(){
		  	$("table tbody").empty();
		  	$(".ready-load").append('<div class="loading-data"></div>');
		  	
		  	var name = $(this).data("name")
		  	var start_date = $(this).data("start")
		  	var end_date = $(this).data("end")
		  	var csrf = $('input[name=csrf_eservice]').val()
		  	console.log(csrf)
		  	$.post('detaildashboardintegrasi', {
		  		
		  		csrf_eservice: csrf,
		  		name:name,
		  		start_date:start_date,
		  		end_date:end_date

		  	}, function(response) {
		  		$(".ready-load").empty();
			      $.each(response, function(key, value){
			            console.log(value)
			            var markup = 	"<tr>"+
			            				"<td>"+value.NO+"</td>"+
			            				"<td style='text-align:center'>" + value.DESCRIPTION + "</td>"+
			            				"<td>" + value.JUMLAH + "</td>"+
			            				"<td><button type='button' class='btn btn-primary' data-context='"+value.HEADER_CONTEXT+"' data-type='"+value.TYPE+"' data-desc='"+value.DESCRIPTION+"'  data-toggle='modal' data-target='#exampleModalLong' >Detail</button> | <a href='exportexceltabledashboardintegrasi?context="+value.HEADER_CONTEXT+"&type="+value.TYPE+"&start="+start_date+"&end="+end_date+"' class='btn btn-info' target='_blank'>export</a</td>"+
			            				"</tr>";
            			$("table tbody").append(markup);
			        })
			},'json');
		  });

		  $('#exampleModalLong').on('show.bs.modal', function (event) {


			  var button = $(event.relatedTarget) // Button that triggered the modal
			  var context = button.data('context') // Extract info from data-* attributes
			  var type= button.data('type')
			  var start_date =  $('#TGL_PERIODE_START').val();
		  	  var end_date =  $('#TGL_PERIODE_END').val();
		  	  var csrf = $('input[name=csrf_eservice]').val()
			  
			  $('#table-detail').DataTable( {
			   	"paging": false,
		      	"searching": false,
		      	"destroy": true,
		        "ajax": {
		            "url": "detailtabledashboardintegrasi",
		            "type": "POST",
		            "data":function(data) {
                            data.csrf_eservice = csrf
                            data.start_date = start_date
                            data.end_date =end_date
                            data.context =context
                            data.type = type
                        },	
		            "dataSrc": ''
		        },
		        "columns": [
		            { "data": "NO" },
		            { "data": "TRX_NUMBER" },
		            { "data": "TGL_LAYANAN" },
		            { "data": "CUSTOMER_NAME" },
		            { "data": "INV_NOTA_LAYANAN" },
		            { "data": "INV_NOTA_JENIS" },
		            { "data": "NILAI_NOTA" },
		            { "data": "ERROR_MESSAGE" }
		        ]
		    } );



				 var modal = $(this)
				 modal.find('.modal-title').text('Detail ' + name)
			})



		
	})
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/buttons.html5.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script> -->

<!-- <script type="text/javascript">
	$(".form_datetime").date({
        format: "dd/mm/yyyy",
    });

</script>
 -->
<script>
    /*$("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));*/

	$(document).ready(function() {

		var date = new Date();
		var currentMonth = date.getMonth();
		var currentDate = date.getDate();
		var currentYear = date.getFullYear();


		$("#TGL_PERIODE_START").datepicker({
		      format: 'yyyy/mm/dd',
		      autoclose: true,
		      todayHighlight: true,
		       onClose: function (selectedDate, instance) {
		       		console.log(selectedDate)
		            /*if (selectedDate != '') { //added this to fix the issue
		                $("#to").datepicker("option", "minDate", selectedDate);
		                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
		                date.setMonth(date.getMonth() + 3);
		                console.log(selectedDate, date);
		                $("#to").datepicker("option", "minDate", selectedDate);
		                $("#to").datepicker("option", "maxDate", date);
		            }*/
		        }
		    	//endDate: new Date(2019, 09, 20+31),

		    	//startDate: new Date(2019, 09, 20),

		      //maxDate: new Date('2018-3-26')
		  });
		var start_value = $('#TGL_PERIODE_START').val()
		
		var day         = new Date(start_value),
        year        = ((day.getMonth() - 2) < 0) ? (day.getFullYear() - 1) : day.getFullYear(),
        month       = ((day.getMonth() - 2) < 0) ? (12 + (day.getMonth() - 2)) : (day.getMonth() + 1),
        date        = year + '/' + month + '/' + day.getDate();

        $('#TGL_PERIODE_START').datepicker().on('changeDate', function (ev) {
        	console.log(ev.date)
			var dateObj = new Date(ev.date);
			var monthafter = dateObj.getUTCMonth(); //months from 1-12
			var dayafter = dateObj.getUTCDate();
			var yearafter = dateObj.getUTCFullYear();
    		 $("#TGL_PERIODE_END").datepicker('setEndDate', new Date(yearafter, monthafter, dayafter+31));
    		 $("#TGL_PERIODE_END").datepicker('setStartDate', new Date(yearafter, monthafter, dayafter+1));
		});

        console.log(date)
		$("#TGL_PERIODE_END").datepicker({
		      format: 'yyyy/mm/dd',
		      autoclose: true,
		      todayHighlight: true,
		      //endDate: new Date(start_value.getFullYear(), start_value.getMonth()+ '1', start_value.getDate()+31)
		      endDate:new Date(year, month-1, day.getDate()+ 31),

		      startDate: new Date(year, month-1, day.getDate()),

		      //maxDate: new Date('2018-3-26')
		  });
		 //$('#datePicker').val(new Date().toDateInputValue());

		//$('#dynamic-table').DataTable();
		//loaddata();
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

		  $("#btnSubmit").click(function(){
        alert("button");
    }); 

		$("#excelexport").click(function(){
				alert('dsffds')
		});
		$('#excelexport').bind("click",function(){
            // your statements;
            alert('dsffds')
    	 });


	});

	

		

		

		$("#pdfexport").click(function(){
			$(".dt-button.buttons-pdf.buttons-html5").click();
		return false;
		});

		 $('.export-excel').on('click', function (event) {
		   	//alert('dsf')
		   	console.log('dfs')
		   })



</script>

<script type="text/javascript">

	function clearreset(){
       window.location.reload(true);
	}

	function exportexcel3($start_date,$end_date,$context,$type){
	var JENIS_PAYMENT			= $('#INV_JENIS_PAYMENT').val();
	var STATUS_TRANSFER			= $('#INV_STATUS_TRANSFER').val();
	var TGL_PAYMENT_START 		= $("#TGL_PAYMENT_START").val();
	var TGL_PAYMENT_END 		= $("#TGL_PAYMENT_END").val();
	window.open('<?php echo ROOT.'einvoice/reporting/cetak_paymenthistoryexcel';?>?'
		+"JENIS_PAYMENT="+JENIS_PAYMENT+"&"
		+"STATUS_TRANSFER="+STATUS_TRANSFER+"&"
		+"TGL_PAYMENT_START="+TGL_PAYMENT_START+"&"
		+"TGL_PAYMENT_END="+TGL_PAYMENT_END+"&"
		,'_blank');
	}

	function exportpdf3(){
	var JENIS_PAYMENT			= $('#INV_JENIS_PAYMENT').val();
	var STATUS_TRANSFER			= $('#INV_STATUS_TRANSFER').val();
	var TGL_PAYMENT_START 		= $("#TGL_PAYMENT_START").val();
	var TGL_PAYMENT_END 		= $("#TGL_PAYMENT_END").val();
	window.open('<?php echo ROOT.'einvoice/reporting/cetak_laporanpembayaran';?>?'
		+"JENIS_PAYMENT="+JENIS_PAYMENT+"&"
		+"STATUS_TRANSFER="+STATUS_TRANSFER+"&"
		+"TGL_PAYMENT_START="+TGL_PAYMENT_START+"&"
		+"TGL_PAYMENT_END="+TGL_PAYMENT_END+"&"
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
