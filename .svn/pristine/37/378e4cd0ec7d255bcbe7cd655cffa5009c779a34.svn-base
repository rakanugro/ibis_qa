<style>
.centered
{
    text-align:center;
}
th{
	text-align: center;
	width: 1px;
}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100;}
tbody>tr>td:nth-child(3){text-align:center;}
tbody>tr>td:nth-child(5){text-align:center;}
tbody>tr>td:nth-child(6){text-align:right;}
/*tbody>tr>th:nth-child(6){text-align:right;}*/
tbody>tr>td:nth-child(7){text-align:center;}
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Rupa-rupa</li>
			<li class="active"><span>Create Invoice</span></li>
		</ol>

		<h1>CREATE INVOICE RUPA-RUPA</h1>
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
							<div class="box-body">
							<div class="col-md-5">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No Pranota</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="TRX_NUMBER" id="TRX_NUMBER" class="form-control" placeholder="No Pranota">
												</div>
											</div>
										</div>
									</div>

									<!-- <div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Status Bayar</label>
											<div class="row">
												<div class="col-xs-5">
					                  		<select for="" name="STATUS" id="STATUS" class="form-control select" style="width: 100%;">
					                  			<option value="">All</option>
					                  			<option value="0">Belum Lunas</option>
					                  			<option value="1">Lunas</option>
					                   		</select>
					                		</div>
						               		</div>
					               		</div>
									</div> -->

									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Jenis Nota</label>
											<div class="row">
												<div class="col-xs-5">
					                  		<select for="" name="KODE_LAYANAN" id="KODE_LAYANAN" class="form-control select" style="width: 100%;">
					                  			<option value="">ALL</option>
					                  			<option value="RUPA04">NOTA LISTRIK</option>
					                  			<option value="RUPA05">NOTA TANAH DAN BANGUNAN</option>
					                  			<option value="RUPA06">NOTA PAS PELABUHAN</option>
					                  			<option value="RUPA07">NOTA RETRIBUSI ALAT</option>
					                  			<option value="RUPA12">NOTA LAIN MANUAL</option>
					                  			<option value="RUPA13">NOTA SEWA ALAT USTER</option>
					                  			<option value="RUPA14">NOTA PORT FACILITY SERVICE</option>
					                   		</select>
					                		</div>
						               		</div>
					               		</div>
									</div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Customer</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="CUSTOMER_NAME" id="CUSTOMER_NAME" class="form-control" placeholder="Customer">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Tanggal Pranota</label>
											<div class="row">
												<div class="col-xs-4">
													<input type="date" name="tgl_nota" id="tgl_nota" class="form-control" placeholder="dd/mm/yy">
													
												</div>
												<div class="col-xs-4">
													<input type="date" name="tgl_nota2" id="tgl_nota2" class="form-control" placeholder="dd/mm/yy">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-body">
							            <div class="col-sm-12 text-right">
							              <button type="button" class="btn btn-primary btn-sm" data-toggle="" data-target="" onclick="clearreset()"> Clear</button>
							              <button type="submit" class="btn btn-primary btn-sm"><!-- <a href="<?php //echo base_url('');?>" > --><i class="fa fa-search" style="color:white;"> </i> Search<!-- </a> --></button>
							            </div>
			      			</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
			<div class="table-responsive" id="tables">
				<table id="dttable" class="table table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>No PraNota</th>
							<th>Tanggal Pranota</th>
							<th>Customer</th>
							<th>Jenis Layanan</th>
							<th>Nominal</th>
							<th>Ket</th>
						</tr>
					</thead>
					<tbody>
						<!-- <tr>
							<td>12346789</td>
							<td>20 Feb 2018</td>
							<td>PT. ABCXYZ</td>
							<td>Sampah Kapal</td>
							<td>Nominal</td>
							<td>
								<center>
								 <a target="_blank" href="<?php echo ROOT;?>einvoice/nota/cetak_nota/kapal/<?php echo $no_invoice ?>"><i class="fa fa-print"></i> </a>
									<a target="" href=""><i class="button">Invoice</i></a>
								</center>
							</td>
						</tr> -->
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>

<div id="confirmModal" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Invoice</span></h4>
	        </div>
			<div class="modal-body" style="height:500px; ">
				<span class="iframerupa"></span>
				<span class="text-me"></span>
			</div>

			<div class="modal-footer">
				<a href="javascript:void(0)"  class="btn btn-primary btn-sm" data-orgid="" data-trxnumber="" data-jenisnota="" class="btn btn-primary" id="ok" ><i class="fa fa fa-file-text-o"></i> Invoice</a>
				<button type="button" class="btn btn-sm pull-left" data-dismiss="modal">Tutup</button>
			</div>
	    </div>


	</div>

</div>


<div id="confirmModal2" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">

		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Konfirmasi</span></h4>
	        </div>
			<div class="modal-body" style="height:300px; ">
				<span class="convert_help">Apakah yakin ingin melakukan invoice ?</span>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">&nbsp;</label>
				<div class="row">
					<div class="col-xs-7">
						<label id="proses"></label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-sm" onClick="confrimOK()"  id="ok2">OK</button>
				<button type="button" data-dismiss="modal" class="btn btn-primary btn-sm" id="Cancel">Cancel</button>
			</div>

	    </div>


	</div>

</div>

<script>
	var tableRupa ;
	$(document).ready(function() {
		/*var table = $('#table-example').dataTable({
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
		});*/
		// loaddata();
		// loaddata(0);
		path = "<?php echo ROOT.'einvoice/nota/ruparupasearch';?>";
		panjang = 20;
		data = 0;
		if(data==1){
			if($("select[name=dttable_length]").val()!=undefined){
				panjang = $("select[name=dttable_length]").val();
			}
		}

		var TRX_NUMBER		= $("#TRX_NUMBER").val();
		// var STATUS			= $("#STATUS").val();
		var STATUS			= "";
		var KODE_LAYANAN	= $("#KODE_LAYANAN").val();
		var CUSTOMER_NAME	= $("#CUSTOMER_NAME").val();
		var tgl_nota		= $("#tgl_nota").val();
		var tgl_nota2		= $("#tgl_nota2").val();
		var panjang			= panjang;
		// var KD_CABANG		= 10;
		var PAGE			= 1;
		var datenota = "-";

		tableRupa = $('#dttable').DataTable({
			// "destroy": true,
        	"serverSide": true,
        	// "ordering": false,
        	"processing": true,
        	"order": [[ 2, "desc" ]],
            // "orderable": false,
		  	"dom" : "brtlp",
			"ajax": {
			    "url": path,
			    data : function ( d ) {
	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
	          		// d.KD_CABANG 	= KD_CABANG;
	          		d.TRX_NUMBER 	= $("#TRX_NUMBER").val();
	          		d.STATUS 		= STATUS;
	          		d.KODE_LAYANAN 	= $("#KODE_LAYANAN").val();
	          		d.CUSTOMER_NAME = $("#CUSTOMER_NAME").val();
	          		d.tgl_nota 		= $("#tgl_nota").val();
	          		d.tgl_nota2 	= $("#tgl_nota2").val();
	          		d.panjang 		= panjang;
	          		d.PAGE 			= PAGE;
		        },
			    "type": "POST"
			  },
			  "columns": [
	                        { "data": "RNUM" },
	                        { "data": "TRX_NUMBER" },
	                        { "data": "TGL_PRANOTA" },
	                        { "data": "CUSTOMER_NAME" },
	                        { "data": "KODE_LAYANAN" },
	                        { "data": "AMOUNT_TOTAL" },
	                        { "data": "action" },
	                    ],
		});
	});
	$("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));
	function print_rupa(a,b,c,d,e,f){
		$(".iframerupa").html('<iframe width="100%" height="400px" src="<?php echo ROOT.'einvoice/nota/priview_create_nota/';?>'+a+'/'+b+'/'+f+'/'+d+'"></iframe>');
		$(".text-me").text("");
		$("#ok").attr('disabled',false);
		$("#ok").data("orgid",f);
		$("#ok").data("trxnumber",a);
		$("#ok").data("jenisnota",b);
		$('#confirmModal').modal("show");
	}
	function confrimOK(){
		// $('#ok2').attr('disabled','disabled');
		$("#ok2").prop('disabled', true);
		$("#Cancel").prop('disabled',true);
		$("#proses").text("PROCESSING - Please wait...!");
		var orgid = $("#ok").data("orgid");
		var trxnumber = $("#ok").data("trxnumber");
		var jenisnota = $("#ok").data("jenisnota");
		path = "<?php echo ROOT.'einvoice/nota/invoicerupa';?>";
		jQuery.ajax({
       		url: '<?php echo ROOT;?>einvoice/nota/invoicerupa/',
            type: "POST",
            data: {
               	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
              	TRX_NUMBER:trxnumber,
              	ORG_ID:orgid,
              	JENIS_NOTA:jenisnota
            },

            beforeSend: function() {
                   $('.text-me').text('  Loading data... Please wait');
                   $('.check_invoice').attr('disabled',true);

     		},
            success:function(data){
            	console.log(data);
				// loaddata();
				try {
					var result = JSON.parse(data);
					// alert(result.status);
					if (result.status == "success") {
						setTimeout("$('#confirmModal2').modal('hide')", 5000);
						setTimeout("$('#confirmModal').modal('hide')", 5005);
	            		$("#proses").text("Create invoice success");
            		loaddata();
					} else {
						// alert("data gagal disimpan");
						$("#proses").text(result.message);
						$("#Cancel").prop('disabled',false);
						$("#ok2").prop('disabled', false);
					}
					
				} catch(e) {
					console.log(e);
					$("#proses").text(result.message);
					$("#Cancel").prop('disabled',false);
					$("#ok2").prop('disabled', false);
					// alert("data gagal disimpan");
				}
     //        	if(data=="1"){
            		
     //        		// settimeout("window.location.href = '"<?php echo ROOT;?>"'einvoice/nota/createrupa/createruparupa",3000);
     //        	}else{
     //        		setTimeout("$('#confirmModal2').modal('hide')", 5000);
					// setTimeout("$('#confirmModal').modal('hide')", 5005);
     //        		$("#proses").text("Gagal Create Invoice");
     //        	}
            },
            error: function (jqXHR, textStatus, errorThrown){
		 	  	alert('False Exeption while request..');
		 	 	return false;
		 	}
    	});
	}
	$("#ok").click(function(){
		$('#confirmModal2').modal('show');
		$("#ok").prop('disabled', true);
		$("#ok2").prop('disabled', false);
		$("#Cancel").prop('disabled',false);
		$("#proses").text("");
	});
	// function loaddata(data){
	function loaddata(){
		tableRupa.draw();
        return false;
	}
	function clearreset(){
        window.location.reload(true);
	}



	/* endang */
	function clickDialogDoc(a,b,c){
		console.log('a: ' + a);
		console.log('b: ' + b);
		console.log('c: ' + c);

		if((b=='NPE') ||(b=='DO')) {
			$('#frameDoc1').attr('src', a);
			$("#dialogDoc1").dialog({
				modal:false,
				height:550,
				width:950,//position:['middle',20],
				title: 'View '+b+' file test',
				buttons: { "Valid": function() {
					if (b=="NPE"){
						var flag_code = "npe_file_flag";
					} else if (b=="DO"){
						flag_code = "do_file_flag";
					}
					var this_obj = $(this);
					var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/Y";
					$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
						$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_tick.png").attr('data-valid', 'Y');
						toggleActivateApproveButton(c);
						this_obj.dialog("close");
					});
				}, "Not Valid": function() {
					if (b=="NPE"){
						var flag_code = "npe_file_flag";
					} else if (b=="DO"){
						flag_code = "do_file_flag";
					}
					var this_obj = $(this);
					var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/N";
					$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
						$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_help.png").attr('data-valid', 'N');
						toggleActivateApproveButton(c);
						this_obj.dialog("close");
					});
				}}
			});

		}
		else if((b=='PEB')||(b=='SPPB')) {
			$('#frameDoc2').attr('src', a);
			$("#dialogDoc2").dialog({
				modal:false,
				height:550,
				width:950,//position:['middle',20],
				title: 'View '+b+' file',
				buttons: { "Valid": function() {
					if (b=="PEB"){
						var flag_code = "peb_file_flag";
					} else if (b=="SPPB"){
						flag_code = "sppb_file_flag";
					}
					var this_obj = $(this);
					var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/Y";
					$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
						$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_tick.png").attr('data-valid', 'Y');
						toggleActivateApproveButton(c);
						this_obj.dialog("close");
					});
				}, "Not Valid": function() {
					if (b=="PEB"){
						var flag_code = "peb_file_flag";
					} else if (b=="SPPB"){
						flag_code = "sppb_file_flag";
					}
					var this_obj = $(this);
					var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/N";
					$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
						$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_help.png").attr('data-valid', 'N');
						toggleActivateApproveButton(c);
						this_obj.dialog("close");
					});
				}}
			});
		}
		else if(b=='BKS'||b=='SPC') {
			$('#frameDoc3').attr('src', a);
			$("#dialogDoc3").dialog({
				modal:false,
				height:550,
				width:950,//position:['middle',20],
				title: 'View Booking Shipping file',
				buttons: { "Valid": function() {
					if (b=="BKS"){
						var flag_code = "bookship_file_flag";
					} else if (b=="SPC"){
						flag_code = "sp_custom_file_flag";
					}
					var this_obj = $(this);
					var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/Y";
					$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
						$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_tick.png").attr('data-valid', 'Y');
						toggleActivateApproveButton(c);
						this_obj.dialog("close");
					});
				}, "Not Valid": function() {
					if (b=="BKS"){
						var flag_code = "bookship_file_flag";
					} else if (b=="SPC"){
						flag_code = "sp_custom_file_flag";
					}
					var this_obj = $(this);
					var url = "<?=ROOT?>approval_request/validate_doc/"+c+"/"+flag_code+"/N";
					$.post(url, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}, function(data){
						$("img[class=checktick][data-noreq="+c+"][data-flag="+b+"]").attr("src", "<?=IMAGES_?>/cr/small_help.png").attr('data-valid', 'N');
						toggleActivateApproveButton(c);
						this_obj.dialog("close");
					});
				}}
			});
		}
		$('a').removeAttr('disabled');
	}
	/* endang */

</script>

<script>
	function link_rupa(){
		window.location.href="<?php echo ROOT; ?>einvoice/nota/adv_rupa";
	}
</script>
