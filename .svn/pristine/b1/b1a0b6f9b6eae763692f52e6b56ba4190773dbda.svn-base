<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" type="text/css" />
<style>.dt-buttons{display:none}</style>
<style>.custom {
    /*font-size: 8px;*/
    /*font-family: Arial;*/
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
th{
	text-align: center;
}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100; }
tbody>tr>td:nth-child(1){text-align:center;}
tbody>tr>td:nth-child(3){text-align:center;}
tbody>tr>td:nth-child(5){text-align:center;}
tbody>tr>td:nth-child(7){text-align:right;}
tbody>tr>td:nth-child(8){text-align:center;}
tbody>tr>td:nth-child(9){text-align:center;}
</style>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Payment</li>
			<li class="active"><span>Payment UPER</span></li>
		</ol>

		<h1>PAYMENT UPER</h1>
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
											<label for="" class="col-sm-3 control-label">Layanan</label>
											<div class="row">
												<div class="col-xs-5">
													<select class="form-control select2" name="SLAYANAN" id="SLAYANAN"  style="width: 100%;">
														<option value="" disabled selected>-</option>
														<option value="KAPAL">KAPAL</option>
														<option value="PETIKEMAS">PETIKEMAS</option>
														<option value="BARANG">BARANG</option>
														<!-- <option value="RUPARUPA">RUPARUPA</option> -->
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No Uper</label>
											<div class="row">
												<div class="col-xs-5">
										  			<input type="text" name="SID_NOTA" id="SID_NOTA" class="form-control" placeholder="No Uper">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Status Bayar</label>
											<div class="row">
												<div class="col-xs-5">
													<select name="STATUS_LUNAS" id="STATUS_LUNAS" class="form-control select2" style="width: 100%;">
														<!-- <option value="">All</option> -->
							                  			<option value="P">LUNAS</option>
							                  			<option value="N" selected="true">BELUM LUNAS</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	

							<div class="box-body">
							            <div class="col-sm-12 text-right">
								              <button type="button" class="btn btn-primary btn-sm" onclick="clearreset()"> Clear</button>
								              <button type="submit" class="btn btn-primary btn-sm" data-toggle="" data-target=""><i class="fa fa-search"></i> Search</a></button>
							          		<!-- </div> -->
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
					<table id="table-example" class="table table-hover">
						<thead>
							<tr>
								<th class="all">No.</th>
								<th class="all">No Uper</th>
								<th class="all">Layanan</th>
								<th class="hide">ppkb ke</th>
								<th class="all">Tanggal Nota</th>
								<th class="all">Nama Kapal</th>
								<th class="all">Tanggal Kegiatan</th>
								<th class="all">Customer</th>
								<th class="all">Jumlah Total</th>
								<th class="all">Status Bayar</th>
								<th class="all">Payment</th>
							</tr>
						</thead>
						<!-- <tbody  id="show_data">

						</tbody> -->
					</table>
					
					<!-- <div class="col-md-6">
					<div class="box-body">
						<div class="form-group">
						    <div class="col-sm-offset-10 col-sm-10">
				              <button id="pdfexport"   class="btn btn-primary btn-sm" >Print All in this List</button>
				            </div>
						</div>
					</div>
				    </div> -->
				
				</div>
			    </div>
		    </div>
	    </div>
    </div>
</div>

<!-- <div class="modal fade" id="confir" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Lunas Confirmation</h4>
		    </div>
		    <form class="form-horizontal">
		        <div class="modal-body">
		        	<input type="hidden" name="kode" id="textkode" value="">
                	<div class="alert alert-danger"><p>Data tidak bisa diedit</p></div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
					</div>
				</div>
		    </form>
	    </div>
    </div>
</div> -->

<!-- MODAL ADD -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
	    	<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white"; class="modal-title">Uper Payment Confirmation</h4>
		    </div>
		    <!-- <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Uper Payment Confirmation</h4>
		    </div> -->

		    <form id="form" class="form-horizontal" action="javascript:void(0);">
		        <div class="modal-body">
		          <div class="form-group">
						<label for="" class="col-sm-3 control-label">No Uper</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="hidden" name="TRX_DATE" id="TRX_DATE" class="form-control" placeholder="No Uper" readonly="readonly">
								<input type="hidden" name="TRX_DATE_RECEIPT" id="TRX_DATE_RECEIPT" class="form-control" placeholder="No Uper" readonly="readonly">
								<input type="text" name="ID_NOTA" id="ID_NOTA" class="form-control" placeholder="No Uper" readonly="readonly">
							</div>
						  </div>
		            </div>

		            <div class="form-group">
						<label for="" class="col-sm-3 control-label">Layanan</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text" id="KD_MODUL" name="KD_MODUL"   class="form-control" placeholder="Layanan" readonly="readonly">

							</div>
						</div>

		            </div>

		            <div class="form-group">
						<label for="" class="col-sm-3 control-label">Uper Payment Date</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control"  id="PAY_DATE" name="PAY_DATE"  placeholder="Tanggal Nota">
							</div>
						</div>
		            </div>

		            <div class="form-group">
						<label for="" class="col-sm-3 control-label">Metode Pembayaran</label>
						<div class="col-xs-7">
								<input type="text" class="form-control" id="click" name="KD_METHOD" placeholder="Bank"  readonly="readonly">
								<input type="hidden" class="form-control" id="NM_AGEN" name="NM_AGEN" placeholder="NM_AGEN"  readonly="readonly">
								<input type="hidden" class="form-control" id="EMKL" name="EMKL" placeholder="EMKL"  readonly="readonly">
								<!-- <select class="form-control select2" name="KD_METHOD" style="width: 100%;" required>
									<option disabled selected></option>
									<option value="Bank">Bank</option>
									<option value="Cash">Cash</option>
								</select> -->
						</div>
		            </div>
		            <div class="form-group">
						<label class="col-sm-3 control-label">Bank</label>
						<div class="row">
							<div class="col-xs-7">
								<select class="form-control select2" id="KD_BANK" name="KD_BANK" style="width: 100%;" required="true">
									<option disabled selected></option>
									<?php foreach($bank as $bankid) { ?>
										<option value="<?php echo $bankid->BANK_ID ?>"><?php echo  ($bankid->BANK_ACCOUNT_NAME.': '.$bankid->RECEIPT_METHOD);?></option>
									<?php } ?>
								</select>
							</div>
						</div>
		            </div>
		            <div class="form-group">
						<label for="" class="col-sm-3 control-label">Nominal Uper</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text"  class="form-control"  id="TOTAL" name="TOTAL"  placeholder="Jenis" readonly="readonly">
							</div>
						</div>
		            </div>
		            <div class="form-group">
						<label for="" class="col-sm-3 control-label">Jumlah Yang Dibayarkan</label>
							<div class="row">
								<div class="col-xs-7">
									<input type="text"  step="any" name="TOTALPAY" id="TOTALPAY" class="form-control currency " placeholder="Jumlah Yang Dibayarkan">
								</div>
							</div>
		            </div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Keterangan</label>
							<div class="row">
								<div class="col-xs-7">
									<textarea name="KETBAYAR" id="KETBAYAR" class="form-control KETBAYAR" maxlength='150'></textarea>
								</div>
							</div>
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
							<button class="btn btn-sm" data-dismiss="modal" id="btn_tutup" aria-hidden="true">Tutup</button>
							<button class="btn btn-primary btn-sm" id="btn_simpan" onclick="pay()" >Bayar</button>
						</div>
				</div>
		    </form>
	    </div>
    </div>
</div>
        <!--END MODAL ADD-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- ADD DATA -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        // $('#click').change(function(){
        //     $(this).val() == "Bank" ? $('#hide').show() : $('#hide').hide();
        // });
		
		function format_number(number, prefix, thousand_separator, decimal_separator)
		{
			var 	thousand_separator = thousand_separator || ',',
				decimal_separator = decimal_separator || '.',
				regex		= new RegExp('[^' + decimal_separator + '\\d]', 'g'),
				number_string = number.replace(regex, '').toString(),
				split	  = number_string.split(decimal_separator),
				rest 	  = split[0].length % 3,
				result 	  = split[0].substr(0, rest),
				thousands = split[0].substr(rest).match(/\d{3}/g);
			
			if (thousands) {
				separator = rest ? thousand_separator : '';
				result += separator + thousands.join(thousand_separator);
			}
			result = split[1] != undefined ? result + decimal_separator + split[1] : result;
			return prefix == undefined ? result : (result ? prefix + result : '');
		};
		
		var input = document.getElementById('TOTALPAY');
		input.addEventListener('keyup', function(e)
		{
			input.value = format_number(this.value);
		});
		
		
		$("textarea[maxlength]").bind('input propertychange', function() {  
			var maxLength = $(this).attr('maxlength');  
			if ($(this).val().length > maxLength) {  
				$(this).val($(this).val().substring(0, maxLength));  
			}  
		})
    });
</script>


<script type="text/javascript">
    //Date picker
    $('#tgl_bayar').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-20d'
    });

    $('#keluar_nota').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-20d'
    });
</script>

<script>
    $("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

	$( "#cetakTes" ).click(function() {
	  $( "#submitPrintAll" ).click();
	});
	// $(document).ready(function() {
	// 	// $('#mastertable').DataTable( {
	// 	// 		"pageLength": 10,
	// 	// 		"destroy": true
	// 	var table = $('#table-example').dataTable({
	// 		'pageLength' : 10,
	// 		'destroy' : true,
	// 		'info': false,
	// 		"lengthChange": true,
	// 		'sDom': 'lTr<"clearfix">tip',
	// 		'oTableTools': {
	//             'aButtons': [
	//                 {
	//                     'sExtends':    'collection',
	//                     'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
	//                     'aButtons':    [ 'csv', 'xls', 'pdf', 'copy', 'print' ]
	//                 }
	//             ]
	//         }
	// 	});
	// });

</script>

<script type="text/javascript">
	function oke(){
		alert('Data Tidak bisa diedit');
		 //$('#confir').modal('show');
	}
</script>

<script type="text/javascript">
	function cari(){
		$('[name="SLAYANAN"]').val('');
		$('[name="SID_NOTA"]').val('');
	}
	$("#pdfexport").click(function(){
			$(".dt-button.buttons-pdf.buttons-html5").click(); 
		return false;
	});
	function ClearSearch(){
		// var LAYANAN = $("#SLAYANAN").val();
		// // alert(LAYANAN);
		// if (LAYANAN == "KAPAL") {
		// 	$('[name="SLAYANAN"]').val('KAPAL');
		// }else if ((LAYANAN == "PETIKEMAS")) {
		// 	$('[name="SLAYANAN"]').val('PETIKEMAS');
		// }else{
		// 	$('[name="SLAYANAN"]').val('PETIKEMAS');
		// }
		// $('[name="SID_NOTA"]').val('');
		// loaddata()
	}

	function paymentshow($id)
	{
            // var id=$(this).attr('data');
            $('#myModal').modal('show');
				$('[name="ID_REQ"]').val($id);
            // $('[name="kode"]').val($id);
	}


	function Cetak($id)
	{
		alert('Cetak Uper: '+$id);
	}


 	function paymentupdate($id)
	{
			// var LAYANAN = $("#SLAYANAN").val();
			// alert(LAYANAN);
			$('#form')[0].reset();
			$("#proses").text("");
			$("#btn_simpan").prop('disabled',false);
			$("#btn_tutup").prop('disabled',false);
			// var ORG_ID_nya = '<?php echo $this->session->userdata('unit_org') ?>';
			var UNIT_ID_nya = '<?php echo $this->session->userdata('unit_id') ?>';
			var path = '';
			if($("#SLAYANAN").val() == "PETIKEMAS"){
				// alert(ORG_ID_nya);
				path = "<?php echo ROOT.'einvoice/payment/uperedit';?>";
				// if (ORG_ID_nya.includes(89,1827)){
					$('#TOTALPAY').attr('readonly',false);
				// }
				// $('$TOTAL').readonly
			} else if($("#SLAYANAN").val() == "KAPAL") {
				// alert("KAPAL");
				path = "<?php echo ROOT.'einvoice/payment/upereditKapal';?>";
				$('#TOTALPAY').attr('readonly',false);
			} else if($("#SLAYANAN").val() == "BARANG") {
				// alert("KAPAL");
				if (UNIT_ID_nya.includes('JBI')){

					$('#TOTALPAY').attr('readonly',true);
				} else {
					$('#TOTALPAY').attr('readonly',false);
				}

				path = "<?php echo ROOT.'einvoice/payment/upereditBarang';?>";
			}
			//path = "<?php //echo base_url('ibis_qa/index.php/einvoice/payment/uperedit');?>";
			var ID_NOTA 	= $id;
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,NO_NOTA:ID_NOTA,
			}).done(function( data ) {
				// alert(data);
				var data1 = JSON.parse(data);
				for(i=0; i<Object.keys(data1).length; i++){
					// $('[name="ID_REQ"]').val(data1[i].ID_REQ);
					$('[name="ID_NOTA"]').val(data1[i].NO_UPER);
					$('[name="NM_AGEN"]').val(data1[i].NM_AGEN);
					$('[name="KD_MODUL"]').val(data1[i].KD_MODUL);
					$('[name="TRX_DATE"]').val(data1[i].TGL_UPER2_C);
					if (data1[i].TGL_UPER != undefined && data1[i].TGL_UPER.length > 0) {
						$('[name="TRX_DATE_RECEIPT"]').val(data1[i].TGL_UPER);
					}

					if (data1[i].TGL_JAM_ENTRY != undefined && data1[i].TGL_JAM_ENTRY.length > 0) {
						$('[name="TRX_DATE_RECEIPT"]').val(data1[i].TGL_JAM_ENTRY);
					}

						// TGL_JAM_ENTRY
					// $('[name="KD_JENIS"]').val(data1[i].LAYANAN);
					$('[name="KD_METHOD"]').val("BANK");
					$tot = Math.round(data1[0].TOTAL);
					if ($tot < 1){
						$tot = 0;
					}else{
						$('[name="EMKL"]').val(data1[i].EMKL);
						$tot = addCommas($tot);
					}
					$('[name="TOTAL"]').val($tot);
					$('[name="TOTALPAY"]').val($tot);
				}
				$('#myModal').modal('show');
			});

			

			path = "<?php echo ROOT.'einvoice/payment/paymentGetBank';?>";	
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,LAYANAN:$("#SLAYANAN").val(),
			}).done(function( resp ) {
				var data = JSON.parse(resp);
				console.log(data);
				// KD_BANK
				$("#KD_BANK").html('');
				for(i=0; i<Object.keys(data).length; i++){
					console.log(data[i].BANK_ACCOUNT_NAME);
					//$("#KD_BANK").append('<option value='+data[i].BANK_ID+'>'+data[i].BANK_ACCOUNT_NAME+'</option>');
					$("#KD_BANK").append('<option value='+data[i].bankAccountId+'>'+data[i].bankAccountName+'</option>');
				}
			});

			return false;
	}

	function pay()
	{
		// alert(1234);
		// $("#btn_simpan").prop('disabled',true);
		// $("#btn_tutup").prop('disabled',true);
		var TOTAL = parseInt($("#TOTAL").val().replace(/\D/g,''));
		var TOTALPAY = parseInt($("#TOTALPAY").val().replace(/\D/g,''));
		var LAYANANNYA = $("#KD_MODUL").val();
	//	alert(TOTAL-TOTALPAY);
	//	alert(TOTALPAY-TOTAL);
		var ORG_ID = <?php echo $this->session->userdata('unit_org') ?>;
		 // ORG_ID = json_decode(ORG_ID);
			
			if (LAYANANNYA == "KAPAL") {
				path = "<?php echo ROOT.'einvoice/payment/upersaveKapal';?>";
			} else if(LAYANANNYA == "BARANG"){
				path = "<?php echo ROOT.'einvoice/payment/upersaveBarang';?>";
			} else {
				path = "<?php echo ROOT.'einvoice/payment/upersave';?>";
				// alert("PETIKEMAS");
			}
		if(TOTALPAY>=TOTAL){
			$("#proses").text("PROCESSING");
			// var path = '';
			// path = "<?php echo ROOT.'einvoice/payment/upersave';?>";
			var NO_UPER 	= $("#ID_NOTA").val();
			var TRX_DATE 	= $("#TRX_DATE").val();
			//var TRX_DATE_RECEIPT 	= $("#TRX_DATE_RECEIPT").val();
			var TRX_DATE_RECEIPT 	= $("#PAY_DATE").val();
			var KD_METHOD 	= $("#click").val();
			var KD_BANK 	= $("#KD_BANK").val();
			var bank_account 	= $("#KD_BANK").find(":selected").text();
			var LAYANAN 	= $("#KD_MODUL").val();
			var NM_AGEN		= $("#NM_AGEN").val();
			var EMKL		= $("#EMKL").val();
			var KETBAYAR = $('#KETBAYAR').val();
			// TOTAL 		= $("#TOTALPAY").val();
			// alert(KD_METHOD);
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				NO_UPER:NO_UPER,
				TRX_DATE:TRX_DATE,
				TRX_DATE_RECEIPT:TRX_DATE_RECEIPT,
				RECEIPT_METHOD:KD_METHOD,
				LAYANAN:LAYANAN,
				RECEIPT_ACCOUNT:KD_BANK,
				bank_account:bank_account,
				TOTAL:TOTALPAY,
				TOTALPAY:TOTALPAY,
				ORG_ID : ORG_ID,
				NM_AGEN : NM_AGEN,
				EMKL	: EMKL,
				COMMENTS : KETBAYAR
			}).done(function(data) {
				// alert(result)
				// paymentload();
				try {
					var result = JSON.parse(data);
					if (result.status == "success" || data.status == "success") {
						$("#proses").text(result.message);
						$("#btn_tutup").prop('disabled',false);
						setTimeout("$('#myModal').modal('hide')",10000);
						// alert("data saved");
						loaddata();
					} else {
						console.log(result);
						$("#proses").text(result.message);
						$("#btn_tutup").prop('disabled',false);
						setTimeout("$('#myModal').modal('hide')",10000);
						// alert("data saved");
						setTimeout("loaddata();",5000);
						// loaddata();
						// alert(result.message);
					}
				} catch(e) {
					console.log(e);
					$("#proses").text(result.message);
						$("#btn_tutup").prop('disabled',false);
					// alert(data);
					// alert("data gagal disimpan");
				}
				// loaddata();
	        });
		}else{
			alert("Jumlah yang dibayarkan tidak boleh kurang dari Nominal Uper");
		} 
        return false;
	}

	function paymentload(){
		var path = '';
		path = "<?php echo ROOT.'einvoice/payment/paymentcash';?>";
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		}).done(function( data ) {
			// alert(data)
        });
	}

	function addCommas(x)
	{
		if(x!=""||x>0){
			var parts = x.toString().split(".");
			parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			return parts.join(".");
		}
	}

	$( document ).ready(function() {
		 loaddata();
		 // alert( "ready!" );
	});
	function cetak_all(){
		var ID_NOTA 	= $("#SID_NOTA").val();
		var LAYANAN 		= $("#SLAYANAN").val();
		// var URLPRINT = ''
		// if (ID_NOTA == ''){
		// 	URLPRINT =
		// }
		var path ='';
		path = "<?php echo ROOT.'einvoice/payment/cetak_uper_all/uper/';?>";
		window.open(path+LAYANAN+"/"+ID_NOTA,'_blank');
      // <window.open(url, '_blank'
		 // echo "<a id="submitPrintAll" href="<?php echo ROOT;?>einvoice/payment/cetak_uper_all/uper/" target="_blank" class="btn btn-primary btn-lg" >Print All in this List</a>";
		// $("#submitPrintAll")[0].click();
		// return false
	}
	function loaddata(){
		// alert('1234');
		
  		path = "<?php echo ROOT.'einvoice/payment/upersearch';?>";

		var ID_NOTA 	= $("#SID_NOTA").val();
		var LAYANAN 		= $("#SLAYANAN").val();
		var KD_MODUL 		= $("#SKD_MODUL").val();
		var STATUS_LUNAS		= $("#STATUS_LUNAS").val();
		//var MODUL 		=$("#SLAYANAN").val();
		if (LAYANAN == 0 || LAYANAN == null) {
			// alert("Silakan pilih layanan");
		} else {
			if (ID_NOTA == ''){
				NOTA = "ALL";
			}else{
				NOTA = ID_NOTA;
			}
			$('#table-example').dataTable({
				"bFilter": false,
				// "order": [[ 3, "desc" ]],
				/* "bInfo": false
				"pageLength": 10,*/
				"lengthMenu": [ 10, 25, 50, 100, 250 ],
				"fixedHeader": true,
				"autoWidth": true,
				"destroy": true, responsive: true,
				dom:'Bfrtp<"bottom"li><"clear">',
				// "aoColumnDefs": [
				// {
				// "bVisible": false, "aTargets": [8]
				// }
				// ],
		        buttons: [ 

		        			{
					       extend: 'pdfHtml5',
					       exportOptions: {
		                    columns: [ 0, 1,2,4,5,6,7 ]
		                   },
/*					       title: 'LAPORAN PENGIRIMAN NOTA' + '\n' + 'a new line',*/
					       title: 'LAPORAN UPER '+ LAYANAN,
					       filename: 'Laporan UPER '+LAYANAN,
					       messageTop: 'No Nota    	   : '+ NOTA +'                                                                                                                                                                Layanan         : '+LAYANAN + '\n' + '\n' + 'Status Lunas  : '+$('#STATUS_LUNAS option:selected').text(),
					       orientation: 'landscape',
					       pageSize: 'A4',
							customize: function(doc) {
								doc.content.splice( 0, 0, {
		                        margin: [ 0, 0, 0, 0 ],
		                        alignment: 'left',
		                        image: 'data:image/jpeg;base64,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',
		                        width: 75
		                    } );
								doc.defaultStyle.fontSize = 12; //<-- set fontsize to 16 instead of 10 
								doc.defaultStyle.alignment = 'left';
								doc.styles.title.fontSize = 20;
								doc.styles.tableHeader.fontSize = 14;
								doc.pageMargins = [30,30,30,40];
							}

					     }, ],
				"ajax": {
				    "url": path,
				    data : function ( d ) {
		          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
		          		d.NO_UPER = ID_NOTA;
						d.LAYANAN = LAYANAN;
						d.KD_MODUL = KD_MODUL;
						d.STATUS_LUNAS = STATUS_LUNAS;
						d.ORG_ID	= '<?php echo $this->session->userdata('unit_org') ?>';
						d.BRANCH_CODE = '<?php echo $this->session->userdata('unit_id') ?>';
			        },
				    "type": "POST"
				  },
				  "columns": [
		                        { "data": "num" },
		                        { "data": "NO_UPER" },
		                        { "data": "MODUL" },
		                        { "data": "PPKBKE","class":"hide"},
		                        { "data": "TGL_SIMPAN" },
								{ "data": "NAMAKAPAL"},
								{ "data": "TGLKEGIATAN"},
		                        { "data": "EMKL" },
		                        { "data": "TTL" },
		                        { "data": "STAT" },
		                        { "data": "action" },
		                    ],
			
	        });
	    }
        return false;
	}

	function clearreset() {
		window.location.reload(true);
	}
</script>
 