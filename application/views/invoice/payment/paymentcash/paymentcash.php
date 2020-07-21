<style>
th{
	text-align: center;
}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100; }
tbody>tr>td:nth-child(1){text-align:center;}
tbody>tr>td:nth-child(2){text-align:center;}
tbody>tr>td:nth-child(3){text-align:center;}
tbody>tr>td:nth-child(5){text-align:center;}
tbody>tr>td:nth-child(6){text-align:center;}
tbody>tr>td:nth-child(9){text-align:center;}
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Payment</li>
			<li class="active"><span>Payment Invoice</span></li>
		</ol>

		<h1>PAYMENT INVOICE</h1>
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
													<select class="form-control select2" name="SLAYANAN" id="SLAYANAN"  style="width: 100%;" onchange="jnsNota()">
														<option value="0" selected>-</option>
														<option value="KPL">KAPAL</option>
														<option value="PTKM">PETIKEMAS</option>
														<option value="BRG">BARANG</option>
														<option value="RUPA">RUPARUPA</option>
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

							<div class="box-body">
							            <div class="col-sm-12 text-right">
								              <button type="button" onclick="clearreset()" class="btn btn-primary btn-sm"> Clear</button>
								              <button type="submit" class="btn btn-primary btn-sm" ><i class="fa fa-search"></i> Search</a></button>
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
								<th width="5%">No.</th>
								<th width="13%">No Pranota</th>
								<!-- <th width="13%">No Proforma</th> -->
								<th width="10%">No Request</th>
								<th >Layanan</th>
								<th>Jenis Nota</th>
								<th width="10%">Tanggal Proforma</th>
								<th>Nama Kapal</th>
								<th>Tanggal Kegiatan</th>
								<th>Customer</th>
								<th class="text-right" width="10%">Jumlah Total</th>
								<th class="text-center" width="10%">Status Bayar</th>
								<th class="text-center" width="10%">Ket</th>
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
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white"; class="modal-title">Payment Confirmation</h4>
		    </div>
		    <form id="form" action="javascript:void(0);" class="form-horizontal" >
		        <div class="modal-body">

		         <div class="form-group" style="margin-bottom: 8px">
						<label for="" class="col-sm-3 control-label">No Request</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text" name="ID_REQ" id="ID_REQ" class="form-control" placeholder="No Request" readonly="readonly">
							</div>
						  </div>
		            </div>

		          <div class="form-group" style="margin-top: 8px; margin-bottom: 8px">
						<label for="" class="col-sm-3 control-label">No Pranota</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text" name="ID_NOTA" id="ID_NOTA" class="form-control" placeholder="No Nota" readonly="readonly">
							</div>
						  </div>
		            </div>

		            <div class="form-group" style="margin-top: 8px; margin-bottom: 8px">
						<label for="" class="col-sm-3 control-label">Layanan</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text" id="KD_MODUL" name="KD_MODUL"   class="form-control" placeholder="Layanan" readonly="readonly">

							</div>
						</div>

		            </div>

		            <div class="form-group" style="margin-top: 8px; margin-bottom: 8px">
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
		            <div class="form-group" style="margin-top: 8px; margin-bottom: 8px">
						<label for="" class="col-sm-3 control-label">Metode Pembayaran</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text" style="display: none;" class="form-control" id="ORG_ID" name="ORG_ID"  readonly="readonly">
								<input type="text" class="form-control" id="click" name="KD_METHOD" placeholder="Bank"  readonly="readonly">
								<!-- <select class="form-control select2" name="KD_METHOD" style="width: 100%;" required>
									<option disabled selected></option>
									<option value="Bank">Bank</option>
									<option value="Cash">Cash</option>
								</select> -->
							</div>
						</div>
		            </div>
		            <div class="form-group" style="margin-top: 8px; margin-bottom: 8px">
						<label class="col-sm-3 control-label">Bank</label>
						<div class="row">
							<div class="col-xs-7">
								<select class="form-control select2" id="KD_BANK" name="KD_BANK" style="width: 100%;">
									<option disabled selected></option>
									<!-- <?php foreach($bank as $bankid) { ?>
										<option value="<?php echo $bankid->BANK_ID ?>"><?php echo  ($bankid->BANK_ACCOUNT_NAME.' : '.$bankid->RECEIPT_METHOD);?></option>
									<?php } ?> -->
								</select>
							</div>
						</div>
		            </div>
		            <div class="form-group" style="margin-top: 8px; margin-bottom: 8px">
						<label for="" class="col-sm-3 control-label">Jumlah Dibayarkan</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text"  step="any" name="TOTAL" id="TOTAL" class="form-control currency " placeholder="Jumlah Yang Dibayarkan" readonly>
							</div>
						</div>
					</div>
					<div class="form-group" style="margin-top: 8px; margin-bottom: 8px">
						<label for="" class="col-sm-3 control-label">Keterangan</label>
						<div class="row">
							<div class="col-xs-7">
								<textarea name="TXTKETERANGAN" id="TXTKETERANGAN" rows="2" class="form-control" maxlength='150'></textarea>
							</div>
						</div>
					</div>
					<div class="form-group" style="margin-top: 8px; margin-bottom: 8px">
						<label for="" class="col-sm-3 control-label"> </label>
						<div class="row">
							<div class="col-xs-7">
								<input type="checkbox" name="CHKCMS" id="CHKCMS" />&nbsp;&nbsp;CMS
								<input type="hidden" name="hidCmsYN" id="hidCmsYN">
							</div>
						</div>
					</div>
					
					<!-- ============================ CMS data input ============================ -->
					<div id="divCMSInput">
					<div class="form-group" style="margin-top: 1px; margin-bottom: 0.5px">
						<label for="" class="col-sm-3 control-label">Tgl Terima Nota</label>
						<div class="row">
							<div class="col-xs-7">
								<div class='input-group date' id='datetimepicker2'>
									<input type='date' class="form-control" name="TGL_TERIMA" id="TGL_TERIMA" >
								</div>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">No Rek Koran (RK)</label>
						<div class="row">
							<div class="col-xs-7">
								<input type="text" name="NOMORRK" id="NOMORRK" class="form-control " placeholder="Nomor Rekening KOran">
							</div>
						</div>
					</div>
					</div>
					<!-- ============================ ############## ============================ -->
					
		            <div class="form-group">
						<label for="" class="col-sm-3 control-label">&nbsp;</label>
						<div class="row">
							<div class="col-xs-7">
								<label id="proses"></label>
							</div>
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

<script type="text/javascript">
	function oke(){
		alert('Data Tidak bisa diedit');
		 //$('#confir').modal('show');
	}

	$("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));
</script>

<script type="text/javascript">

	function jnsNota()
	{
        var path = '';
        var notaJns = "";
        if ($("#SLAYANAN").val() != "0") {
			path = "<?php echo ROOT.'einvoice/payment/getMstNotaList/';?>/"+$("#SLAYANAN").val();	
			$.post( path, {
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			,
			}).done(function( data ) {
				var data1 = JSON.parse(data);
				console.log(data1);
				$("#SKD_MODUL").html('<option value="" selected>All</option>');
				for(i=0; i<Object.keys(data1).length; i++){
					$("#SKD_MODUL").append('<option value='+data1[i].INV_NOTA_CODE+'>'+data1[i].INV_NOTA_JENIS+'</option>');
				}
			});
        	
        } else {
			$("#SKD_MODUL").html('<option value="" disabled selected>All</option>');
        }

        // if ($("#SLAYANAN").val() == "BRG") {
        if ($("#SLAYANAN").val() != "PTK") {
        	path = "<?php echo ROOT.'einvoice/payment/paymentsearch';?>";
			// var ID_NOTA  = 
			// var ID_REQ 	 = 
			// var LAYANAN  = 
			// var KD_MODUL =
     		tablePay = $('#table-example').DataTable({
				"destroy": true,
            	"serverSide": true,
	            // "orderable": false,
            	"processing": true,
			  	"dom" : "brtlp",
				"ajax": {
				    "url": path,
				    data : function ( d ) {
		          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
		          		d.ID_NOTA = $("#SID_NOTA").val();
						d.ID_REQ = $("#SID_REQ").val();
						d.LAYANAN = $("#SLAYANAN").val();
						d.KD_MODUL = $("#SKD_MODUL").val();
			            d.UNIT_CODE 		= '<?php echo $this->session->userdata('unit_id') ?>';
				       	d.ROLE_TYPE		= '<?php echo $this->session->userdata('role_type') ?>';
				       	d.ORG_ID			= '<?php echo $this->session->userdata('unit_org') ?>';
						// if ($data['STATUS']=="S"){

						// }
			        },
				    "type": "POST"
				  },
				  "columns": [
		                        { "data": "num" },
		                        { "data": "ID_NOTA" },
		                        /*{ "data": "NO_FAKTUR" },*/
		                        { "data": "ID_REQ" },
		                        { "data": "MODUL" },
		                        { "data": "LAYANAN" },
		                        { "data": "TGL_SIMPAN" },
								{ "data": "NAMAKAPAL" },
								{ "data": "TGLKEGIATAN" },
		                        { "data": "EMKL" },
		                        { "data": "TTL","class":"text-right"},
		                        { "data": "STAT" },
		                        { "data": "action" },
		                    ],
			
	        });
        }

	}

	function paymentshow($id)
	{
            // var id=$(this).attr('data');
            $('#myModal').modal('show');
				$('[name="ID_REQ"]').val($id);
            // $('[name="kode"]').val($id);
	}

 	function paymentupdate($id,$idproforma)
	{
		
		document.getElementById("TXTKETERANGAN").value = "";
		
		clearFormCms();
		//reset Form
		//$('#form')[0].reset();
		$("#proses").text("");
		$("#btn_simpan").prop('disabled',false);
		$("#btn_tutup").prop('disabled',false);
		//Hidden bank
		// $('#hide').hide();
		var path = '';
		if($("#SLAYANAN").val() == "PTKM"){
			path = "<?php echo ROOT.'einvoice/payment/paymenteditBarang';?>";
			//path = "<?php echo ROOT.'einvoice/payment/paymentedit';?>";
		// } else if($("#SLAYANAN").val() == "BRG") {
		} else {
			path = "<?php echo ROOT.'einvoice/payment/paymenteditBarang';?>";	
		}
		var ID_NOTA 	= $id;
		var ID_PROFORMA 		= $idproforma;
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
		,ID_NOTA:ID_NOTA,
		ID_PROFORMA:ID_PROFORMA,

		}).done(function( data ) {
			var data1 = JSON.parse(data);
			// alert(data);die;
			for(i=0; i<Object.keys(data1).length; i++){
				$('[name="ID_REQ"]').val(data1[i].ID_REQ);
				$('[name="ID_NOTA"]').val(data1[i].ID_NOTA);
				$('[name="KD_MODUL"]').val(data1[i].KD_MODUL);
				// $('[name="KD_MODUL"]').val('TEST');
				$('[name="KD_JENIS"]').val(data1[i].LAYANAN);
				$('[name="KD_METHOD"]').val("BANK");
				$('[name="ORG_ID"]').val(data1[i].ORG_ID);
				
				$tot =addCommas(data1[0].TOTAL);
				$('[name="TOTAL"]').val($tot);
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
				var RECEIPT_METHOD = '';
				if (data[i].RECEIPT_METHOD != '' && data[i].RECEIPT_METHOD != undefined){
					RECEIPT_METHOD = ' : '+data[i].RECEIPT_METHOD ;
				}
				else{
					//RECEIPT_METHOD = ' : '+data[i].BRANCH_CODE;
					RECEIPT_METHOD = ' : '+data[i].bankAcctUseId;
				}
				console.log(data[i].BANK_ACCOUNT_NAME);
				//$("#KD_BANK").append('<option value='+data[i].BANK_ID+'>'+data[i].BANK_ACCOUNT_NAME+RECEIPT_METHOD+'</option>');
				$("#KD_BANK").append('<option value='+data[i].bankAccountId+'>'+data[i].bankAccountName+RECEIPT_METHOD+'</option>');
			}
		});

		return false;
	}

	function pay()
	{
		// alert($('#ID_REQ').val());
		
		var ID_NOTA 	= $("#ID_NOTA").val();
		var ID_REQ 		= $("#ID_REQ").val();
		var KD_METHOD 	= $("#click").val();
		var BANK_ID 	= $("#KD_BANK").val();
		var KD_BANK 	= $("#KD_BANK").val();
		var KD_MODUL 	= $("#KD_MODUL").val();
		var LAYANAN 	= $("#KD_JENIS").val();
		var TOTAL 		= $("#TOTAL").val();
		var RECEIPT_ACCOUNT = $("#").val();
		var SLAYANAN	=$("#SLAYANAN").val();
		var UNIT_CODE	= '<?php echo $this->session->userdata('unit_id'); ?>';

		var KD_BANK2 = $("#KD_BANK option:selected").text().split(":");
		var REMARK_TO_BANK_ID = "";
		/*********** 20180817 3ono ***********/
		var KETERANGAN = "";
		var CMS_YN = "N";
		var TANGGAL_TERIMA = "NA";
		var NOREK_KORAN = "NA";
				
		if ($('#CHKCMS').is(':checked')) {
			if ($('#TGL_TERIMA').val() == ""){
				alert('Tanggal terima harus diisi.');
				return;
			} else {
				if (!isValidDate($('#TGL_TERIMA').val())) {
					alert('Format tanggal tidak sesuai. Harap gunakan format tanggal YYYY-mm-dd');
					return;
				}
			}
			
			if ($('#NOMORRK').val() == ""){
				alert('Nomor rekening koran harap diisi.');
				return;
			}
			
			CMS_YN = 'Y';
			TANGGAL_TERIMA = $('#TGL_TERIMA').val();
			NOREK_KORAN = $('#NOMORRK').val();
		}
		
		KETERANGAN = $("#TXTKETERANGAN").val();
		/**************************************/
		
		$("#btn_simpan").prop('disabled',true);
		$("#btn_tutup").prop('disabled',true);	
		$("#proses").text("PROCESSING");
		
		if(KD_BANK2.length>1){
			if(KD_BANK2[1].charAt(0)==" "){
				KD_BANK2[1] = KD_BANK2[1].replace(" ","");
			}
			RECEIPT_ACCOUNT 	= KD_BANK2[0];
			KD_METHOD 			= KD_BANK2[1];
		}

		// alert(SLAYANAN);
		if (SLAYANAN == "PTKM") {
			path = "<?php echo ROOT.'einvoice/payment/paymentsave';?>";
		} else {
			path = "<?php echo ROOT.'einvoice/payment/paymentsaveConsolidasi';?>";
		}
		// var unit_org = '<?php echo $this->session->userdata('unit_org') ?>'; 
		var unit_org = $('[name="ORG_ID"]').val();
		//alert(unit_org);
		/*var unit_org = JSON.parse('<?php //echo $this->session->userdata('unit_org') ?>');
		if(unit_org.length==1){
			unit_org = unit_org[0];
		}*/
		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			ID_NOTA:ID_NOTA,
			ID_REQ:ID_REQ,
			RECEIPT_NUMBER:ID_NOTA,
			BANK_ID:BANK_ID,
			REMARK_TO_BANK_ID:'BANK_ACCOUNT_ID',
			// RECEIPT_METHOD:KD_METHOD,
			RECEIPT_METHOD:"BANK",
			ORG_ID:unit_org,
			LAYANAN:LAYANAN,
			RECEIPT_ACCOUNT:KD_BANK,
			RECEIPT_ACCOUNT2:RECEIPT_ACCOUNT.trim(),
			TOTAL:TOTAL,
			UNIT_CODE:UNIT_CODE,
			COMMENTS:KETERANGAN, /* 20180817 3ono */
			CMS_YN:CMS_YN,
			TANGGAL_TERIMA:TANGGAL_TERIMA,
			NOREK_KORAN:NOREK_KORAN
		}).done(function(data1) {
			 //alert(data1);
			// paymentload();
			try {
					var result = JSON.parse(data1);
					if (result.status == "S" || result.status == "success" || data1.status == "success") {
						setTimeout("$('#myModal').modal('hide')", 10000);
						// $('#myModal').modal('hide');
						// alert(result.message);
						$("#proses").text(result.message);
						$("#btn_tutup").prop('disabled',false);
						loaddata();
					} else {
						console.log(result);
						$("#proses").text(result.message);
						$("#btn_tutup").prop('disabled',false);
						// $('#myModal').modal('hide');
						// alert(result.message);
						// alert("data gagal disimpan");
					}
				} catch(e) {
					console.log(e);
					// $('#myModal').modal('hide');
					 //alert(data1);
					$("#proses").text(result.message);
					// alert("data gagal disimpan");
				}

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

	function search(){
		//alert(1234);
		var path = '';
		path = "<?php echo ROOT.'einvoice/payment/paymentsearch';?>";

		var ID_NOTA 	= $("#SID_NOTA").val();
		var ID_REQ 		= $("#SID_REQ").val();
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
			$('#able-example').html(data);
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
		 
		//alert( "ready!" );
		
		$("textarea[maxlength]").bind('input propertychange', function() {  
			var maxLength = $(this).attr('maxlength');  
			if ($(this).val().length > maxLength) {  
				$(this).val($(this).val().substring(0, maxLength));  
			}  
		})
		
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
		
		loaddata();
		
		
		$("#CHKCMS").click(function() {
			if ($(this).is(":checked")) {
				$("#hidCmsYN").val('Y');
				$("#divCMSInput").show();
			} else {
				$("#hidCmsYN").val('N');
				$("#divCMSInput").hide();
			}
		});
	});
	function clearreset(){
		window.location.reload(true);
	}
	
	function clearFormCms() {
		$("#divCMSInput").hide();
		$('#CHKCMS').prop('checked', false);
		
		$("#TGL_TERIMA").val('');
		$("#NOMORRK").val('');
		
	}
	
	function isValidDate(dateString) {
	  var regEx = /^\d{4}-\d{2}-\d{2}$/;
	  if(!dateString.match(regEx)) return false;  // Invalid format
	  var d = new Date(dateString);
	  if(Number.isNaN(d.getTime())) return false; // Invalid date
	  return d.toISOString().slice(0,10) === dateString;
	}
	
	function loaddata(){
		//alert('1234');
		// var path = '';
		// path = "<?php //echo ROOT.'einvoice/payment/paymentsearch';?>";

		// var ID_NOTA 	= $("#SID_NOTA").val();
		// var ID_REQ 		= $("#SID_REQ").val();
		// var LAYANAN 	= $("#SLAYANAN").val();
		// var SKD_MODUL 	= $("#SKD_MODUL").val();

		// $.post( path, {'<?php //echo $this->security->get_csrf_token_name(); ?>' : '<?php //echo $this->security->get_csrf_hash(); ?>',
		// 	ID_NOTA:ID_NOTA,
		// 	ID_REQ:ID_REQ,
		// 	LAYANAN:LAYANAN,
		// 	KD_MODUL:SKD_MODUL
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
		// 				'<td>'+data1[i].MODUL+'</td>'+
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
		//console.log(LAYANAN); return false;
		if (LAYANAN == 0 || LAYANAN == null) {
			//alert("Silakan pilih layanan");
		} else {
	        // if ($("#SLAYANAN").val() == "BRG") {
	        if ($("#SLAYANAN").val() != "PTKM") {
	        	tablePay.draw();
	        } else {
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
				            d.UNIT_CODE 		= '<?php echo $this->session->userdata('unit_id') ?>';
					       	d.ROLE_TYPE		= '<?php echo $this->session->userdata('role_type') ?>';
					       	d.ORG_ID			= '<?php echo $this->session->userdata('unit_org') ?>';
							// if ($data['STATUS']=="S"){

							// }
				        },
					    "type": "POST"
					  },
					  "columns": [
			                        { "data": "num" },
			                        { "data": "ID_NOTA" },
			                        // { "data": "NO_FAKTUR" },
			                        { "data": "ID_REQ" },
			                        { "data": "MODUL" },
			                        { "data": "KET" },
			                        { "data": "TGL_SIMPAN" },
									{ "data": "NAMAKAPAL"},
									{ "data": "TGLKEGIATAN"},
			                        { "data": "EMKL" },
			                        { "data": "TTL","class":"text-right"},
			                        { "data": "STAT" },
			                        { "data": "action" },
			                    ],
				
		        });
			}
		}

        return false;
	}
</script>
