<style type="text/css">
.centered
{
    text-align:center;
}
.left
{
    text-align:left;
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
.margin4{
	margin-left: 40%;
}
</style>

        <!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active"><span>Send Mail to Customer</span></li>
        </ol>

    <h1>SEND MAIL TO CUSTOMER</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

    </div>
</div>

<div class="container">
    <div class="row">
		<div class="main-box clearfix">
			<header class="main-box-header clearfix"></header>
			<div class="box box-primary" style="padding: 10px;">
				<div class="box-body">
					<div class="row">
	                            <form class="form-horizontal" action="javascript:loaddata()" id="formsearch">
	                                <div class="col-md-6">
	                                    <div class="box-body">
	                                        <div class="form-group">
	                                            <div class="box-body">
	                                                <label for="" class="col-sm-3 control-label">Layanan</label>
	                                                <div class="row">
	                                                    <div class="col-xs-5">
	                                                        <select onchange="refreshRedaksi()" class="form-control select" style="width: 100%;" name="INV_NOTA_LAYANAN" id="INV_NOTA_LAYANAN">
		                                                        <option value="">All</option>
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
                                                  <?php
                                                  //print_r($nota);
                                                   ?>
	                                                <div class="row">
	                                                    <div class="col-xs-5">
	                                                        <select for="" class="form-control select" style="width: 100%;" name="INV_NOTA_JENIS" id="INV_NOTA_JENIS">
	                                                        	<option value="">All</option>
	                                                            <option value="NOTA TAGIHAN JASA BARANG">NOTA TAGIHAN JASA BARANG</option>
																<option value="NOTA DERMAGA PENUMPUKAN">NOTA DERMAGA PENUMPUKAN</option>
																<option value="NOTA ANGKUTAN LANGSUNG">NOTA ANGKUTAN LANGSUNG</option>
																<option value="PELAYARAN DALAM NEGERI">PELAYARAN DALAM NEGERI</option>
																<option value="PELAYARAN LUAR NEGERI">PELAYARAN LUAR NEGERI</option>
																<option value="RECEIVING">RECEIVING</option>
																<option value="DELIVERY">DELIVERY</option>
																<option value="BONGKAR MUAT">BONGKAR MUAT</option>
																<option value="BEHANDLE">BEHANDLE</option>
																<option value="PERPANJANGAN DELIVERY">PERPANJANGAN DELIVERY</option>
																<option value="BATAL MUAT">BATAL MUAT</option>
																<option value="NOTA LISTRIK">NOTA LISTRIK</option>
																<option value="NOTA TANAH DAN BANGUNAN">NOTA TANAH DAN BANGUNAN</option>
																<option value="NOTA PAS PELABUHAN">NOTA PAS PELABUHAN</option>
																<option value="NOTA RETRIBUSI ALAT">NOTA RETRIBUSI ALAT</option>
																<option value="NOTA LAIN MANUAL">NOTA LAIN MANUAL</option>
																<option value="NOTA SEWA ALAT USTER">NOTA SEWA ALAT USTER</option>

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
	                                                <label for="" class="col-sm-3 control-label">Customer</label>
	                                                <div class="row">
	                                                    <div class="col-xs-5">
	                                                        <input type="text" name="customer_mail" id="customer_mail" class="form-control" placeholder="Customer">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <div class="box-body">
	                                                <label for="" class="col-sm-3 control-label">Tanggal Nota</label>
	                                                <div class="row">
	                                                    <div class="col-xs-4">
	                                                        <input type="date" name="NOTA_DATE_START" id="NOTA_DATE_START" class="form-control" placeholder="dd/mm/yy">
	                                                    </div>
	                                                    <div class="col-xs-4">
	                                                        <input type="date" name="NOTA_DATE_END" id="NOTA_DATE_END" class="form-control" placeholder="dd/mm/yy">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <!-- <div class="row"> -->
	                                <div class="box-body">
							            <div class="col-sm-12 text-right">
		                                                	<button type="button" onclick="clearreset()" class="btn btn-primary btn-sm" style="color:white;"> Clear</button>
		                                                  	<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" style="color:white;"> </i> Search</button>
		                                                  	<!-- <button type="button" class="btn btn-primary" id="btn1">Tambah Email</button> -->

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
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
            <div class="adv-table">
            <table  class="table table-hover" id="dynamic-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Nota</th>
                        <th>Tanggal Nota</th>
                        <th>Layanan</th>
                        <th>Jenis Nota</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Ket</th>
                    </tr>
                </thead>

            </table>
            </div>
            </div>
        </section>
    </div>
</div>

<div id="modal_main" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo ROOT.'einvoice/nota/send_mail';?>" method="post" >
		<div id="review">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Kirim Nota Ke Customer <span class="text-help"></span></h4>
	        </div>
			<div class="modal-body" style="height:400px; ">
				<span class="text-me"></span>
			</div>

			<div class="modal-footer">
				<div>
                    <div class="form-group">
                    	<div class="left">
                        	<p>Kirim Nota ke</p>
                    	</div>
                    	<div >
                        	<label for="" class="col-sm-2 control-label">Customer</label>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">
                                <input type="text" value="" name="CUSTOMER" id="CUSTOMER" class="form-control" placeholder="Customer"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                    	<div>
                        	<label for="" class="col-sm-2 control-label">Customer Email</label>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">
                                <input type="text" name="TO_EMAIL" id="TO_EMAIL" class="form-control" placeholder="Customer Email">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            </div>
                            <span> <input type="submit" class="btn btn-primary btn-sm" value="SEND MAIL"></span>
                        </div>
                    </div>
                </div>


				<!-- <a href="javascript:void(0)"  class="btn btn-primary check_invoice" data-id="" onClick="create_invoice()" ><i class="fa fa fa-file-text-o"></i> Invoice</a>
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
			</div>

	    </div>

	   </div>
	</form>
	</div>

</div>
<!-- Modal Send Email-->
<!-- <div id="modal_main" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:white"; class="modal-title">Kirim Nota Ke Customer</h4>
            </div>
            <div class="modal-body">
                <form id="form1">
                    <div class="form-group">
                        <div class="box-body">
                            <div class="main-box-body clearfix">
                                <div class="tabs-wrapper">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab-home">
                                            <form class="form-horizontal">
                                            	<span class="text-me"></span>
                                            </form>
                                        </div>
                                    </div>
                                    <form role="form" method="post" action="<?php echo ROOT.'invoice/nota/send_mail';?>" >
	                                    <div class="modal-footer">
	                                    	  <div class="box-body">
	                                    	  		<div class="left">
                                                    	<p>Kirim Nota ke</p>
                                                	</div>
                                                    <div>
	                                                    <div class="form-group">
	                                                    	<div class="margin2">
	                                                        	<label for="" class="col-sm-3 control-label">Customer</label>
	                                                        </div>
	                                                        <div class="row">
	                                                            <div class="col-xs-5">
	                                                                <input type="text" value="" name="customer_" id="customer_" class="form-control" placeholder="Customer"/>
	                                                            </div>
	                                                        </div>
	                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="box-body">
                                                    <div class="form-group">
                                                    	<div class="margin2">
                                                        	<label for="" class="col-sm-3 control-label">Customer Email</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-5">
                                                                <input type="text" name="mail_customer" id="mail_customer" class="form-control" placeholder="Customer Email">
                                                            </div>
                                                            <span> <input type="submit" class="btn btn-primary" value="SEND MAIL"></span>
                                                        </div>
                                                    </div>
                                                </div>
	                                    </div>
                                	</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
        <!-- page end-->


<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js">
</script>

<script type="text/javascript">
	$('#tgl_nota').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		startDate: '-20y'
	});
	$('#tgl_nota2').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		startDate: '-20y'

	});
</script>
<script>
function test() {
  var path = '';
  path = "<?php echo ROOT.'einvoice/nota/send_mail';?>";
  $.post(path, { name: "John", time: "2pm" })
    .done(function( data ) {
      alert( "Data Loaded: " + data );
    });

}
<script>
function refreshRedaksi()
{
    // alert('123');
    var path = '';
    path = "<?php echo ROOT.'einvoice/unit/getNota';?>";
    // var INV_NOTA_LAYANAN = 'KAPAL';

    $.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
    ,INV_NOTA_LAYANAN:$("#INV_NOTA_LAYANAN").val()
    }).done(function( data ) {
      // INV_NOTA_JENIS
      var parse = JSON.parse(data);
      var html = "<option value='' selected>All</option>";
      $.each( parse, function( key, value ) {
        console.log(value);
        html += "<option>"+value.INV_NOTA_JENIS+"</option>"
        // alert( key + ": " + value );
      });
      $("#INV_NOTA_JENIS").html(html);
      console.log(data);
      // $('#update_unit').modal('show');
    });

    return false;
}
</script>

<script>
	$("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

	function getRandom() {
	  return Math.floor((Math.random() * 1000000000) + 1);
	}
	$(document).ready(function(){
		loaddata();
	    /*$("#btn1").click(function(){
	    	var nonota = getRandom();
	        $('#show_data').append('<tr class="No"><td><center>1</center></td> <td><center>'+nonota+'</center></td><td><center>Kapal</center></td> <td><center>LISTRIK</center></td><td><center>IPC PELINDO</center></td> <td><center>Belum Kirim</center></td><td><center><button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_main" onclick="kirim(\''+nonota+'\',\'IPC PELINDO\',\'jefiegeofani@gmail.com\')" data-dismiss="modal"><i class="fa fa-envelope fa-1" aria-hidden="true"></i></button></center></td></tr>');
	    });*/
	});
	function kirim(a,b,c,d){
		$("#CUSTOMER").val(b);
		$("#TO_EMAIL").val(c);

		Cetak(a,d);

	}

  function refreshRedaksi()
  {
      // alert('123');
      var path = '';
      path = "<?php echo ROOT.'einvoice/unit/getNota';?>";
      // var INV_NOTA_LAYANAN = 'KAPAL';

      $.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
      ,INV_NOTA_LAYANAN:$("#INV_NOTA_LAYANAN").val()
      }).done(function( data ) {
        // INV_NOTA_JENIS
        var parse = JSON.parse(data);
        var html = '<option value="" selected>All</option>';
        $.each( parse, function( key, value ) {
          console.log(value);
          html += "<option value='"+value.INV_NOTA_CODE+"'>"+value.INV_NOTA_JENIS+"</option>"
          // alert( key + ": " + value );
        });
        $("#INV_NOTA_JENIS").html(html);
        console.log(data);
        // $('#update_unit').modal('show');
      });

      return false;
  }

	function loaddata(){
		// alert('1234');
		// alert(1234);
		var path = '';
		path = "<?php echo ROOT.'einvoice/nota/allsearch';?>";

		var CUSTOMER 			= $('#customer_mail').val();
		var JENIS_NOTA			= $('#INV_NOTA_JENIS').val();
		var LAYANAN 		 	= $("#INV_NOTA_LAYANAN").val();
    var NOTA_DATE_START 		 	= $("#NOTA_DATE_START").val();
    var NOTA_DATE_END		 	= $("#NOTA_DATE_END").val();

		$('#dynamic-table').DataTable( {
				"pageLength": 5,
				"destroy": true,
				"dom" : "brtlp",
				"ajax": {
					"url": path,
					data : function ( d ) {
								d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
								/*d.INV_NOTA_JENIS	= INV_NOTA_JENIS;*/
								d.LAYANAN		= LAYANAN;
								d.JENIS_NOTA	= JENIS_NOTA;
								d.CUSTOMER		= CUSTOMER;
                d.NOTA_DATE_START		= NOTA_DATE_START;
                d.NOTA_DATE_END		= NOTA_DATE_END;
						},
					"type": "POST"
				},
				"columns": [
										{ "data": "num" },
										{ "data": "NO_NOTA" },
										{ "data": "NOTA_DATE" },
										{ "data": "INV_NOTA_LAYANAN" },
										{ "data": "INV_NOTA_JENIS"},
										{ "data": "CUSTOMER"},
										{ "data": "SEND_STATUS"},
										{ "data": "action"},
				],} );

		return false;
	}
	/*function loaddata(){
		path = "<?php echo ROOT.'einvoice/nota/mailsearch';?>";
		var LAYANAN 			= $("#LAYANAN").val();
		var JENIS_NOTA	 		= $("#JENIS_NOTA").val();
		var CUSTOMER 			= $("#CUSTOMER").val();

		$('#dynamic-table').dataTable({
			"columnDefs": [
			    {
			    	"searchable": false,
			    	"targets": [0,1,2,3,4,5]
			    }
			  ],
			"destroy": true,
		  	"dom" : "brtlp",
			"ajax": {
			    "url": path,
			    data : function ( d ) {
	          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
	          		d.LAYANAN 		= LAYANAN;
	          		d.JENIS_NOTA 	= JENIS_NOTA;
	          		d.CUSTOMER 		= CUSTOMER;
		        },
			    "type": "POST"
			},
			  "columns": [
	                        { "data": "num" },
	                        { "data": "NO_NOTA" },
	                        { "data": "TANGGAL_NOTA" },
	                        { "data": "LAYANAN" },
	                        { "data": "JENIS_NOTA" },
	                        { "data": "CUSTOMER" },
	                        { "data": "STATUS" },
	                        { "data": "action" },
	                    ],
		});
        return false;
	}*/
</script>


<script type="text/javascript">

	function clearreset(){
		window.location.reload(true);
	}

	function Cetak($id,LAYANAN){
	// window.location.href="<?php echo ROOT;?>einvoice/nota/cetak_nota/"+$id;
	NO_NOTA = $id;
	/*alert(LAYANAN);*/
		if(LAYANAN == "BARANG"){
			var url ='<?php echo ROOT;?>einvoice/nota/cetak_barang/barang/'+$id;
			/*alert(url);*/
			$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "'+url+'" onload="onMyFrameLoad(this)"/></iframe>');

		}else if(LAYANAN == "KAPAL" ){
			var url ='<?php echo ROOT;?>einvoice/nota_kapal/cetak_nota_kapal/'+$id;
			/*alert(url);*/
			$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "'+url+'" onload="onMyFrameLoad(this)"/></iframe>');

		}else if(LAYANAN == "PETIKEMAS"){
			var url ='<?php echo ROOT;?>einvoice/nota/cetak_nota/petikemas/'+$id;
			/*alert(url);*/
			$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "'+url+'" onload="onMyFrameLoad(this)"/></iframe>');
		}else{
			var url ='<?php echo ROOT;?>einvoice/nota/cetak_nota/RUPARUPA/'+$id;
			/*alert(url);*/
			$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "'+url+'" onload="onMyFrameLoad(this)"/></iframe>');
		}


	}
	/*alert($id);*/
/*	$('.check_invoice').attr('disabled',true);*/
	/*$('#form_dtjk').modal('show');*/
</script>
