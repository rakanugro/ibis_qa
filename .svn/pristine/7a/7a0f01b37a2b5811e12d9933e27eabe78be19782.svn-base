<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Payment</li>
			<li class="active"><span>Payment Cash</span></li>
		</ol>
		
		<h1>PAYMENT CASH</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
				  		<form class="form-horizontal">
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
														<option value="RUPARUPA">RUPARUPA</option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Jenis Nota</label>
											<div class="row">
												<div class="col-xs-5">
													<select class="form-control select2" name="SKD_MODUL" id="SKD_MODUL"   style="width: 100%;">
														<option value="" disabled selected>All</option>
														<option value="RECEIVING">RECEIVING</option>
														<option value="DELIVERY">DELIVERY</option>
														<option value="BEHANDLE">BEHANDLE</option>
														<option value="BATALMUAT">BATALMUAT</option>
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
											<label for="" class="col-sm-3 control-label">No Pranota</label>
											<div class="row">
												<div class="col-xs-5">
										  			<input type="text" name="SID_NOTA" id="SID_NOTA" class="form-control" placeholder="No Pranota">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No Request</label>
											<div class="row">
												<div class="col-xs-5">
										  			<input type="text" name="SID_REQ" id="SID_REQ" class="form-control" placeholder="No Request">
												</div>
											</div>
										</div>
									</div>									
								</div>
							</div>

							<div class="col-md-9">
								<div class="box-body">
									<div class="form-group">
							            <div class="col-sm-offset-12 col-sm-10">
								              <button type="button" onclick="ClearSearch()" class="btn btn-primary btn-lg"> Clear</button>
								              <button type="button" onclick="loaddata()" class="btn btn-primary btn-lg" ><i class="fa fa-search"></i> Search</a></button>
							          		<!-- </div> -->
							            </div>
			      					</div>
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
	<div class="clo-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table id="table-example" class="table table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th width="15%">No Pranota</th>
								<th width="15%">No Request</th>
								<th>Layanan</th>
								<th>Jenis Nota</th>
								<th>Tanggal Nota</th>
								<th>Customer</th>
								<th class="text-right">Jumlah Total</th>
								<th class="text-center">Status Bayar</th>
								<th class="text-center">Keterangan</th>
							</tr>
						</thead>						
						<!-- <tbody  id="show_data">

						</tbody> -->
					</table>
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
    <div class="modal-dialog" >
	    <div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Payment Confirmation</h4>
		    </div>
		    <form class="form-horizontal" action="#" method="post" id="form2">
		        <div class="modal-body">
			        <div class="form-group">
						<label for="" class="col-sm-3 control-label">No Request</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text" name="ID_REQ" id="ID_REQ" class="form-control" placeholder="No Request" readonly="readonly">
							</div>
						</div>
			        </div>
			        <div class="form-group">
						<label for="" class="col-sm-3 control-label">No Pranota</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text" name="ID_NOTA" id="ID_NOTA" class="form-control" placeholder="No Nota" readonly="readonly">
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
						<label for="" class="col-sm-3 control-label">Jenis Nota</label>
						<div class="row">
							<div class="col-xs-7">
								<!-- <select class="form-control select2" id="KD_JENIS" name="KD_JENIS" style="width: 100%;">
								<option>Receiving</option>
								</select> -->
								<input type="text"  class="form-control"  id="KD_JENIS" name="KD_JENIS"  placeholder="No Nota" readonly="readonly">
							</div>
						</div>					
			        </div>
			        <div class="form-group">
						<label for="" class="col-sm-3 control-label">Metode Pembayaran</label>
						<div class="row">
							<div class="col-xs-7">
								<select class="form-control select2" id="click" name="KD_METHOD" style="width: 100%;">
									<option disabled selected></option>
									<option value="Bank">Bank</option>
									<option value="Cash">Cash</option>
								</select>
							</div>
						</div>					
			        </div>	
			        <div class="form-group" style="display:none" id="hide">
						<label class="col-sm-3 control-label">Bank</label>
						<div class="row">
							<div class="col-xs-7">
								<select class="form-control select2" id="KD_BANK" name="KD_BANK" style="width: 100%;">
									<option disabled selected></option>
									<?php foreach($bank as $bankid) { ?>
									<option><?php echo  ($bankid->INV_BANK_NAME.': '.$bankid->INV_BANK_REKENING);?></option>
										<?php } ?>
								</select>
							</div>
						</div>					
			        </div>
			        <div class="form-group">
						<label for="" class="col-sm-3 control-label">Jumlah Yang Dibayarkan</label>
							<div class="row">
								<div class="col-xs-7">
									<input type="text"  step="any" name="TOTAL" id="TOTAL" class="form-control currency " placeholder="Jumlah Yang Dibayarkan" readonly>
								</div>
							</div>
					</div>					
				    <div class="modal-footer">
						<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Tutup</button>
						<button class="btn btn-primary" id="btn_simpan" onclick="pay()" >Bayar</button>
					</div>
				</div>
		    </form>
	    </div>
    </div>
</div>
        <!--END MODAL ADD-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#click').change(function(){
            $(this).val() == "Bank" ? $('#hide').show() : $('#hide').hide();
        });
    });
</script>


<script type="text/javascript">
    //Date picker
    $('#tgl_nota').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });

    $('#keluar_nota').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-3d'
    });
</script>

<script>
	$(document).ready(function() {
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
	});
</script>

<script type="text/javascript">
	function oke(){
		alert('Data Tidak bisa diedit');
		 //$('#confir').modal('show');
	}
</script>

<script type="text/javascript">
	
	function paymentshow($id)
	{		
            // var id=$(this).attr('data');
            $('#myModal').modal('show');
				$('[name="ID_REQ"]').val($id);
            // $('[name="kode"]').val($id);
	}

 	function paymentupdate($id)
	{		
			//alert('123');
			var path = '';
			path = "<?php echo ROOT.'einvoice/payment/paymentedit';?>";
			var ID_NOTA 	= $id;
			$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,ID_NOTA:ID_NOTA,
			}).done(function( data ) {	
				var data1 = JSON.parse(data);
				// alert(data);die;
				for(i=0; i<Object.keys(data1).length; i++){
					$('[name="ID_REQ"]').val(data1[i].ID_REQ);
					$('[name="ID_NOTA"]').val(data1[i].ID_NOTA);
					$('[name="KD_MODUL"]').val(data1[i].KD_MODUL);
					$('[name="KD_JENIS"]').val(data1[i].LAYANAN);
					$tot =addCommas(data1[0].TOTAL);
					$('[name="TOTAL"]').val($tot);
				}
				$('#myModal').modal('show');
			});
			
			return false;
	}
	function confirmation1(){
		$('#NotaUpdate').modal('show');
	}
	function pay()
	{		
		alert(1234);
		var path = '';
		path = "<?php echo ROOT.'einvoice/payment/paymentsave';?>";
		var ID_NOTA 	= $("#ID_NOTA").val();
		var KD_METHOD 	= $("#click").val();
		var KD_BANK 	= $("#KD_BANK").val();
		var LAYANAN 	= $("#KD_JENIS").val();
		var TOTAL 		= $("#TOTAL").val();
		alert(TOTAL);
		return false;

		// alert(KD_METHOD);die;
		
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			ID_NOTA:ID_NOTA, 
			RECEIPT_METHOD:KD_METHOD, 
			LAYANAN:LAYANAN,
			RECEIPT_ACCOUNT:KD_BANK,
			TOTAL:TOTAL
		}).done(function( data ) {
			//alert(data);
			// paymentload();
        });
		
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

	function search(){// alert(1234);
		var path = '';
		path = "<?php echo ROOT.'einvoice/payment/paymentsearch';?>";
		
		var ID_NOTA 	= $("#SID_NOTA").val();
		var ID_REQ 	= $("#SID_REQ").val();
		var LAYANAN 	= $("#SLAYANAN").val();
		var KD_MODUL 		= $("#SKD_MODUL").val();
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			ID_NOTA:ID_NOTA, 
			ID_REQ:ID_REQ, 
			LAYANAN:LAYANAN,
			KD_MODUL:KD_MODUL
		}).done(function( data ) {
			//alert(data);
			// paymentload();
			$('#table-example').html(data);
			// $( "#table-example" ).load( "paymentcash.php #table-example" );
        });
		
        return false;
	}	
	
	function addCommas(x) 
	{
		var parts = x.toString().split(".");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		return parts.join(".");
	}


	$( document ).ready(function() {
		 loaddata();
		// alert( "ready!" );
	});

	function ClearSearch(){
		location.reload();
	}
	function loaddata(){
		// alert('1234');
		// var path = '';
		// path = "<?php echo ROOT.'einvoice/payment/paymentsearch';?>";

		// var ID_NOTA 	= $("#SID_NOTA").val();
		// var ID_REQ 	= $("#SID_REQ").val();
		// var LAYANAN 	= $("#SLAYANAN").val();
		// var KD_MODUL 	= $("#SKD_MODUL").val();

		// $.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		// 	ID_NOTA:ID_NOTA, 
		// 	ID_REQ:ID_REQ,
		// 	LAYANAN:LAYANAN,
		// 	KD_MODUL:KD_MODUL
		// 	//MODUL:SKD_MODUL
		// }).done(function( data ) {
		// 	var data1 = JSON.parse(data);	
		// 	var html = '';
		// 	var i;
		// 	for(i=0; i<Object.keys(data1).length; i++){
		// 		var $id = data1[i].ID_NOTA;
		// 		html += '<tr>'+
		// 				'<td>'+data1[i].ID_NOTA+'</td>'+
		// 				'<td>'+data1[i].ID_REQ+'</td>'+
		// 				'<td>'+data1[i].KD_MODUL+'</td>'+
		// 				'<td>'+data1[i].LAYANAN+'</td>'+
		// 				'<td>'+data1[i].TGL_SIMPAN+'</td>'+
		// 				'<td>'+data1[i].EMKL+'</td>'+
		// 				'<td align="right">'+data1[i].TOTAL+'</td>'+
		// 				'<td align="center">'+data1[i].STATUS+'</td>'+
		// 				'<td><center>'+
		// 							'<button type="button" class="btn btn-link" onclick="paymentupdate(\''+$id+'\')" ><i class="fa fa-dollar" ></i></button>'+
		// 				'</center></td>'+
		// 				'</tr>';
		// 	}
		// 	// alert(html);die;
		// 	$('#show_data').html(html);
		path = "<?php echo ROOT.'einvoice/payment/paymentsearch';?>";
		var ID_NOTA  = $("#SID_NOTA").val();
		var ID_REQ 	 = $("#SID_REQ").val();
		var LAYANAN  = $("#SLAYANAN").val();
		var KD_MODUL = $("#SKD_MODUL").val();

		$('#table-example').dataTable({
			"destroy": true,
		  	"dom" : "brtlp",
			"ajax": {
			    "url": path,
			    data : function ( d ) {
	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
	          		d.ID_NOTA = ID_NOTA; 
					d.ID_REQ = ID_REQ;
					d.LAYANAN = LAYANAN;
					d.KD_MODUL = KD_MODUL;
		        },
			    "type": "POST"
			  },
			  "columns": [
	                        { "data": "num" },
	                        { "data": "ID_NOTA" },
	                        { "data": "ID_REQ" },
	                        { "data": "KD_MODUL" },
	                        { "data": "LAYANAN" },
	                        { "data": "TGL_SIMPAN" },
	                        { "data": "EMKL" },
	                        { "data": "TOTAL" },
	                        { "data": "STATUS" },
	                        { "data": "action" },
	                    ],
        });
		
        return false;
	}		
</script>