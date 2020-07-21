<style type="text/css">
.centered
{
    text-align:center;
}
th{
	text-align: center;
}
tbody>tr>td:nth-child(3){text-align:center;}
tbody>tr>td:nth-child(5){text-align:center;}
tbody>tr>td:nth-child(6){text-align:right;}
tbody>tr>td:nth-child(7){text-align:center;}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100;}
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Barang</li>
			<li class="active"><span>Create Invoice</span></li>
		</ol>

		<h1>CREATE INVOICE BARANG</h1>
	</div>
</div>

<div class="container">
    <div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
						<form class="form-horizontal" action="javascript:void(0);" id="formsearch">
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No PraNota</label>
											<div class="row">
												<div class="col-sm-4">
						                  			<input type="text" name="" id="PRANOTA" class="form-control" placeholder="No PraNota">
						                		</div>
					                		</div>
					             		</div>
				             		</div>

				             		<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No BPRP</label>
											<div class="row">
												<div class="col-sm-4">
						                  			<input type="text" name="" id="BPRP" class="form-control" placeholder="No BPRP">
						                		</div>
					                		</div>
					             		</div>
				             		</div>
									<div class="form-group">
					             		<div class="box-body">
					             			<label for="" class="col-sm-3 control-label">No Uper</label>
					                		<div class="row">
												<div class="col-sm-4">
							                  		<input type="text" name="" id="UPER" class="form-control" placeholder="No uper">
						                		</div>
					                		</div>
					             		</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="box-body">
										<label for="" class="col-sm-3 control-label">Jenis Nota</label>
										<div class="row">
											<div class="col-xs-5">
				                  		<select for="" name="KODE_LAYANAN" id="KODE_LAYANAN" class="form-control select" style="width: 100%;">
				                  			<option value="">ALL</option>
				                  			<?php for ($i=0; $i < count($jenisnota); $i++) { ?>
				                  			<option value="<?php echo $jenisnota[$i]->INV_NOTA_CODE; ?>"><?php echo $jenisnota[$i]->INV_NOTA_JENIS; ?></option>
				                  			<?php } ?>
				                   		</select>
				                		</div>
					               		</div>
				               		</div>
								</div>
							</div>
							
							<div class="box-body">
							            <div class="col-sm-12 text-right">
								              <button type="button" class="btn btn-primary btn-sm" onclick="clearreset()"> Clear</button>
								              <button type="submit" class="btn btn-primary btn-sm"><!-- <a href="<?php //echo base_url('');?>" > --><i class="fa fa-search"></i> Search<!-- </a> --></button>
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
				<div class="table-responsive">
					<table id="tableBarang" class="table table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>No PraNota</th>
								<th>Tanggal PraNota</th>
								<th>Customer</th>
								<th>Jenis Layanan</th>
								<th>Nominal</th>
								<th>Ket</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="form_dtjk" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div id="review">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title"> Invoice <span class="text-help"></span></h4>
	        </div>
			<div class="modal-body" style="height:500px; ">
				<input type="text" id="ukk_ready" value="" class="hidden">
				<input type="text" id="cab_ready" value="" class="hidden">
				<input type="text" id="ppkb_ready" value="" class="hidden">
				<span class="text-me"></span>
			</div>

			<div class="modal-footer">
				<a href="javascript:void(0)"  class="btn btn-primary btn-sm" data-id="createInv" onClick="create_invoice()" ><i class="fa fa fa-file-text-o"></i> Invoice</a>
			<button type="button" class="btn btn-sm pull-left" data-dismiss="modal">Tutup</button>
			</div>

	    </div>

	   </div>

	</div>

</div>


<div id="confirmModal" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">

		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Confirmation</span></h4>
	        </div>
			<div class="modal-body" style="height:300px; ">
				<span class="convert_help">apakah yakin ingin melakukan invoice ?</span>
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
				<button type="button" class="btn btn-primary btn-sm" onClick="confrimOK()"  id="ok">OK</button>
				<button type="button" data-dismiss="modal" class="btn btn-primary btn-sm" onClick="BtnCancel()" id="Cancel">Cancel</button>
			</div>

	    </div>


	</div>

</div>



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

    function clearreset() {
    	window.location.reload(true);
    }

    $("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));
</script>

<script>
	var tableBarang ;
	var TRX_NUMBER ;
	var KODE_LAYANAN;
	var ORG_ID;
	var BRANCH_CODE;
	$( document ).ready(function() {
		// loaddata();
				var path = '';
		path = "<?php echo ROOT.'einvoice/cibarang/barangsearch';?>";
		tableBarang = $('#tableBarang').DataTable({
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
		          		d.PRANOTA = $("#PRANOTA").val() ;
		          		d.TRX_NUMBER = $("#PRANOTA").val() ;
		          		d.BPRP = $("#BPRP").val() ;
		          		d.UPER = $("#UPER").val() ;
		          		d.KODE_LAYANAN = $("#KODE_LAYANAN").val() ;
		          		// d.ID_NOTA = ID_NOTA ;
						// d.CUSTOMER_NAME = Costumer ;
						// d.MODULE = MODULE ;
			        },
				    "type": "POST"
				  },
				  "columns": [
				  				{ "data": "num" },
		                        { "data": "TRX_NUMBER" },
		                        { "data": "TANGGAL_PRANOTA" },
		                        { "data": "CUSTOMER_NAME" },
		                        { "data": "notaJenis" },
		                        { "data": "AMOUNT_TOTAL" },
		                        { "data": "action" },
		                    ],
			});
		// var ID_NOTA 	= $("#ID_NOTA").val();
		// var Costumer 	= $("#Costumer").val();
		// var MODULE 	= 'BARANG'; ///utk : KAPAL atau RUPA atau BARANG atau PETIKEMAS

		// alert( "ready!" );
	});

	// function loaddata(){
	// 	// tableBarang.draw();
	// 	path = "<?php echo ROOT.'einvoice/cibarang/barangsearch';?>";

	// 	// alert( "ready!" );
	// // });
	// }

	function loaddata(){
		tableBarang.draw();
        return false;
	}
	function create_invoice(){
		$("#ok").prop('disabled', false);
		$("#createInv").prop('disabled', true);
		$("#Cancel").prop('disabled',false);
		$("#proses").text("");
		// $('#ok').attr('enabled','enabled');
		$('#confirmModal').modal('show');
	}
	function BtnCancel(){
		$("#createInv").prop('disabled', false);
	}
	function confrimOK(){
		$("#ok").prop('disabled', true);
		$("#Cancel").prop('disabled',true);
		$("#proses").text("PROCESSING - Please wait...!");
		// $('#ok').attr('disabled','disabled');
		// data = {
		//     '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		// 	"TRX_NUMBER" : TRX_NUMBER,
		// 	"KODE_LAYANAN" : KODE_LAYANAN
		// }
		$.ajax({
			// url: self.baseUrl+"ajaxAddQuotes", // Url to which the request is send
			url: "<?php echo ROOT.'einvoice/cibarang/createInvoice';?>", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: {
			    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				"TRX_NUMBER" : TRX_NUMBER,
				"ORG_ID" : ORG_ID,
				"BRANCH_CODE" : BRANCH_CODE,
				"JENIS_NOTA" : KODE_LAYANAN
			}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			success: function(response)   // A function to be called if request succeeds
			{
				console.log(response);
				// loaddata();
				var result = JSON.parse(response);
				if(result != "")
				{
					if(result == "Failure" || result == "failure" || result == "F")
					{
						$("#proses").text("Create Invoice Failed");
						$("#Cancel").prop('disabled',false);
						$("#ok").prop('disabled', false);
						setTimeout("$('#confirmModal').modal('hide')", 10000);
						setTimeout("$('#form_dtjk').modal('hide')", 10002);
						location.reload();
					}
					else
					{
						$("#proses").text("Create Invoice Success");
						setTimeout("$('#confirmModal').modal('hide')", 10000);
						setTimeout("$('#form_dtjk').modal('hide')", 10002);	
						location.reload();						
					}
				}
				else
				{
					$("#proses").text("Create Invoice Failed");
					$("#Cancel").prop('disabled',false);
					$("#ok").prop('disabled', false);
					setTimeout("$('#confirmModal').modal('hide')", 10000);
					setTimeout("$('#form_dtjk').modal('hide')", 10002);
					location.reload();
				}
				/*try {
					//var result = JSON.parse(resp);
					// alert(result.status);
					if (result.status == "Failure" || result.status == "failure" || result.status == "F" ) {
						// alert("data gagal disimpan");
						$("#proses").text(result.message);
						$("#Cancel").prop('disabled',false);
						$("#ok").prop('disabled', false);
					} else {
						setTimeout("$('#confirmModal').modal('hide')", 10000);
						setTimeout("$('#form_dtjk').modal('hide')", 10002);
						$("#proses").text("Create Invoice Success");
						// $("#proses").text(result.message);
						loaddata();
					}
					
				} catch(e) {
					console.log(e);
					$("#proses").text(result.message);
					$("#Cancel").prop('disabled',false);
					$("#ok").prop('disabled', false);
					// alert("data gagal disimpan");
				}*/
			}
		});
	}
	function Cetak($id, kode ,org_id ,branch_code){
		TRX_NUMBER = $id;
		KODE_LAYANAN = kode;
		ORG_ID = org_id;
		BRANCH_CODE = branch_code;
		// alert($id);
		// window.location.href="<?php echo ROOT;?>einvoice/nota/cetak_nota/"+$id;
		// idBarang = $id;
		$('.check_invoice').attr('disabled',true);
		$("#createInv").prop('disabled', false);
		$('#form_dtjk').modal('show');
		var url ='<?php echo ROOT;?>einvoice/cibarang/cetak_barang/barang/'+$id+'/'+org_id;
		$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "'+url+'" onload="onMyFrameLoad(this)"/></iframe>');

	}
	function onMyFrameLoad(){
		$('.check_invoice').attr('disabled',false);
	}

	function link_barang(){
		window.location.href="<?php echo ROOT; ?>einvoice/nota/adv_barang";
	}
</script>
