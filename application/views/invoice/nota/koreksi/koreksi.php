
<style type="text/css">
.centered
{
    text-align:center;
}
th{
	text-align: center;
}
tbody>tr>td:nth-child(5){text-align:right;}
tbody>tr>td:nth-child(6){text-align:center;}
tbody>tr>td:nth-child(7){text-align:center;}
tbody>tr>td:nth-child(8){text-align:center;}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100;}
</style>
<style type="text/css">
.selectize-control.selectAjaxDropdown::before {
	-moz-transition: opacity 0.2s;
	-webkit-transition: opacity 0.2s;
	transition: opacity 0.2s;
	content: ' ';
	z-index: 2;
	position: absolute;
	display: block;
	top: 10px;
	right: 34px;
	width: 16px;
	height: 16px;
	background: url(<?php echo base_url('assets/images/spinner.gif')?>);
	background-size: 16px 16px;
	opacity: 0;
}
.selectize-control.selectAjaxDropdown.loading::before {
	opacity: 0.4;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Koreksi</li>
			<li class="active"><span>Nota</span></li>
		</ol>

		<h1>NOTA KOREKSI</h1>
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
							<div class="col-md-5">
								<div class="box-body">
                                        <div class="form-group">
                                            <div class="box-body">
                                                <label for="" class="col-sm-3 control-label">Layanan</label>
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <select onchange="refreshRedaksi()" class="form-control select" style="width: 100%;" name="KODE_LAYANAN" id="KODE_LAYANAN">
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
								<div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No Nota</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="ID_NOTA" id="ID_NOTA" class="form-control" placeholder="No Nota">
												</div>
											</div>
										</div>
									</div>

								</div>
                                </div>
							</div>
							<div class="col-md-7">
								<div class="box-body">
									<!-- <div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Customer</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="Costumer" id="Costumer" class="form-control" placeholder="Customer">
												</div>
											</div>
										</div>
									</div> -->

									<!-- <div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Tanggal Nota</label>
											<div class="row">
												<div class="col-xs-3">
                          <div class="input-group">
                            <input type="date" name="START_DATE" id="START_DATE" class="form-control form_datetime" placeholder="dd/mm/yy" style="width: 160px;">

                          </div>
												</div>
												<label for="" class="col-sm-2 control-label">Tanggal Akhir</label>
												<div class="col-xs-3">
                          <div class="input-group">
                            <input type="date" name="END_DATE" id="END_DATE" class="form-control form_datetime" placeholder="dd/mm/yy" style="width: 160px;">
                          </div>
												</div>
											</div>
										</div>
									</div> -->
								</div>
							</div>
									<div class="box-body">
								            <div class="col-sm-12 text-right">
								              <button type="button" class="btn btn-primary btn-sm" onclick="clearreset()"> Clear</button>
								              <button type="submit" class="btn btn-primary btn-sm"><!-- <a href="<?php //echo base_url('');?>" > --><i class="fa fa-search"> </i> Search<!-- </a> --></button>
								            </div>
			  	            </div>
                         </form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div class="container text-right">
	<div class="box-body">
		<div class="form-group">
         <button class="btn btn-primary plus add_koreksi btn-sm" data-toggle="modal" ><i class="fa fa-plus"></i></button>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table id="tableKoreksi" class="table table-hover">
						<thead>
							<tr>
								<th>No Nota</th>
								<th>Layanan</th>
								<!-- <th>Jenis Nota</th> -->
								<th>Tanggal Nota</th>
								<th>Customer</th>
                        		<th>Status</th>
								<th>Ket</th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- <div class="col-md-6">
					<div class="box-body">
						<div class="form-group">
				            <div class="col-sm-offset-10 col-sm-10">
				              <button type="submit" class="btn btn-primary btn-sm">Print All in this List</button>
				            </div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>


<div id="modal_main_add" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<form action="javascript:void(0);" method="post" id="form-koreksi_add">
		<div id="review">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Koreksi <span class="text-help"></span></h4>
	        </div>
			<div class="modal-body" >
				<div class="box-body">
					<!-- <div class="form-check">
						<label for="" class="col-sm-2 control-label"> Status </label>
						<div class="row">
							<div class="col-xs-5">
								<input type="checkbox" style="width: 20px; height:20px;"  value="1" class="form-check-input" name="STATUS_KOREKSI" id="STATUS_KOREKSI" /> Proses Koreksi
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div> -->
				</div>
				<br>
				<div class="box-body">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">No Nota</label>
						<div class="row">
							<div class="col-xs-5">
  								<select id="noNota" name="noNota" class="selectAjaxDropdown formProduct" ></select>
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Jenis Layanan</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" value="" class="form-control" name="JENIS_LAYANAN" readonly="readonly" id="JENIS_LAYANAN" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Jenis Nota</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" value="" class="form-control" name="JENIS_NOTA" id="JENIS_NOTA" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Tanggal Nota</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" value="" class="form-control" name="TGLNOTA" id="TGLNOTA" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Penggunaan Jasa</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" value="" class="form-control" name="PENGGUNA_JASA" id="PENGGUNA_JASA" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Jumlah Tagihan</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" value="" class="form-control" name="JmlTagihan" id="JmlTagihan" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Tanggal Pengajuan</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="Tgl_pengjuan_ADD" id="Tgl_pengjuan_ADD" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Keterangan</label>
						<div class="row">
							<div class="col-xs-5">
  								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
								<input type="hidden" value="1" name="STATUS_KOREKSI" id="STATUS_KOREKSI_ADD" />
								<input type="hidden" value="" name="BILLER_REQUEST_ID_ADD" id="BILLER_REQUEST_ID_ADD" />
								<textarea class="form-control" name="KETERANGAN_KOREKSI_ADD" id="KETERANGAN_KOREKSI_ADD" placeholder="Keterangan" data-error="required" required></textarea>
								<!-- <input type="text" value="" class="form-control" name="INV_USER_NAME" id="INV_USER_NAME" placeholder="Nama User" data-error="required" required /> -->
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					
				</div>

			</div>

			<div class="modal-footer">
				

				<button  type="submit" id="submit" name="submit"  class="btn btn-primary btn_user_save btn-sm" >Save</button>
				<!-- <button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button> -->
			</div>

	    </div>

	   </div>
	</form>
	</div>

</div>

<div id="modal_main" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<form action="javascript:void(0);" method="post" id="form-koreksi">
		<div id="review">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Koreksi <span class="text-help"></span></h4>
	        </div>
			<div class="modal-body" >
				<div class="box-body">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">No Nota</label>
						<div class="row">
							<div class="col-xs-5">
  								<!-- <select id="noNota" name="noNota" class="selectAjaxDropdown formProduct" ></select> -->
								<input type="text" value="" class="form-control" id="noNotaEdit" name="noNotaEdit"  readonly="readonly" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Jenis Layanan</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" value="" class="form-control" name="JENIS_LAYANANEDIT" readonly="readonly" id="JENIS_LAYANANEDIT" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Jenis Nota</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" value="" class="form-control" name="JENIS_NOTAEdit" id="JENIS_NOTAEdit" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Tanggal Nota</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" value="" class="form-control" name="TGLNOTAEdit" id="TGLNOTAEdit" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Penggunaan Jasa</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" value="" class="form-control" name="PENGGUNA_JASAEdit" id="PENGGUNA_JASAEdit" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Jumlah Tagihan</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" value="" class="form-control" name="JmlTagihanEdit" id="JmlTagihanEdit" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Tanggal Pengajuan</label>
						<div class="row">
							<div class="col-xs-5">
								<input type="text" readonly="readonly" class="form-control" name="Tgl_pengjuanEdit" id="Tgl_pengjuanEdit" placeholder="" data-error="required" required />
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<!-- <div class="form-check">
						<label for="" class="col-sm-2 control-label"> Status </label>
						<div class="row">
							<div class="col-xs-5">
								<input type="checkbox" style="width: 20px; height:20px;"  value="1" class="form-check-input" name="STATUS_KOREKSI" id="STATUS_KOREKSI" /> Proses Koreksi
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div> -->
				</div>
				<br>
				<div class="box-body">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Keterangan</label>
						<div class="row">
							<div class="col-xs-5">
  								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
								<input type="hidden" value="" name="BILLER_REQUEST_ID" id="BILLER_REQUEST_ID" />
								<textarea class="form-control" name="KETERANGAN_KOREKSI" id="KETERANGAN_KOREKSI" placeholder="Keterangan" data-error="required" required></textarea>
								<!-- <input type="text" value="" class="form-control" name="INV_USER_NAME" id="INV_USER_NAME" placeholder="Nama User" data-error="required" required /> -->
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Pengajuan Koreksi</label>
						<div class="row">
							<div class="col-xs-5">
								<select class="form-control select" style="width: 100%;" name="STATUS_KOREKSI" id="STATUS_KOREKSI">
                                    <option value="1">Diterima</option>
									<option value="">Ditolak</option>
                                </select>
							</div>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>

			</div>

			<div class="modal-footer">
				

				<button  type="submit" id="submit" name="submit"  class="btn btn-primary btn_user_save btn-sm" >Save</button>
				<!-- <button type="button" class="btn btn-sm" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button> -->
			</div>

	    </div>

	   </div>
	</form>
	</div>

</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js">
</script>
<link rel="stylesheet" type="text/css" href="<?=CUBE_?>js/selectize/dist/css/selectize.css" />

<script src="<?=CUBE_?>js/selectize/dist/js/standalone/selectize.js"></script>


<script type="text/javascript">
    // $(".form_datetime").datepicker({
    //     format: "dd/mm/yyyy",
    //     todayBtn: true,
    //     autoclose: true,
    // });
    $("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));
    $("#form-koreksi").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
	      // url: self.baseUrl+"ajaxAddQuotes", // Url to which the request is send
	      url: "<?php echo ROOT.'einvoice/koreksi/savekoreksi';?>", // Url to which the request is send
	      type: "POST",             // Type of request to be send, called as method
	      data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	      contentType: false,       // The content type used when sending data to the server.
	      cache: false,             // To unable request pages to be cached
	      processData:false,        // To send DOMDocument or non processed data file it is set to false
	      success: function(resp)   // A function to be called if request succeeds
	      {
	        try {
	          var result = JSON.parse(resp);
				$('#modal_main').modal('hide');
	          // alert(result.status);
	          if (result.status == "success") {
	            loaddata();
	          } else {
	            alert("data gagal disimpan");
	          }
	          $('#add_entity').modal('hide');
	        } catch(e) {
	          console.log(e);
	          alert("data gagal disimpan");
	        }
	      }
	    });
		// loaddata();
	}));

    $("#form-koreksi_add").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
	      // url: self.baseUrl+"ajaxAddQuotes", // Url to which the request is send
	      url: "<?php echo ROOT.'einvoice/koreksi/savekoreksiAdd';?>", // Url to which the request is send
	      type: "POST",             // Type of request to be send, called as method
	      data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	      contentType: false,       // The content type used when sending data to the server.
	      cache: false,             // To unable request pages to be cached
	      processData:false,        // To send DOMDocument or non processed data file it is set to false
	      success: function(resp)   // A function to be called if request succeeds
	      {
	        try {
	          var result = JSON.parse(resp);
				$('#modal_main_add').modal('hide');
	          // alert(result.status);
	          if (result.status == "success") {
	            loaddata();
	          } else {
	            alert("data gagal disimpan");
	          }
	          $('#add_entity').modal('hide');
	        } catch(e) {
	          console.log(e);
	          alert("data gagal disimpan");
	        }
	      }
	    });
		// loaddata();
	}));
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

	$('.add_koreksi').click(function(){
		$('#form-koreksi_add')[0].reset();
		$('#modal_main_add').modal({
			show:true,
			backdrop:'static'
		});
	});

	$('#noNota').selectize({
        valueField: 'TRX_NUMBER',
        labelField: 'TRX_NUMBER',
        searchField: 'TRX_NUMBER',
        options:[],
        create: false,
        render: {
          option: function(item, escape) {
            return '<div>' +
              '<span class="title">' +
                '<span class="name">'+ escape(item.TRX_NUMBER) + '</span>'+
              '</span>' +
            '</div>';
          }
        },
        load: function(query, callback) {
          if (!query.length) return callback();
          $.ajax({
            url: "<?php echo ROOT.'einvoice/koreksi/koreksiGet?TRX_NUMBER=';?>"+encodeURIComponent(query),
            type: 'GET',
            error: function() {
              callback();
            },
            success: function(resp) {
              try {
                parseData = JSON.parse(resp);
                console.log(parseData['data']);
                callback(parseData['data']);
              }catch(e) {
                callback();
              }
            }
          });
        },
        onChange: function(value) {
	   		path = "<?php echo ROOT.'einvoice/koreksi/koreksiGetOne';?>";

	      $.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
		    ,TRX_NUMBER:value
		    }).done(function( data ) {
		      // INV_NOTA_JENIS
		      var parse = JSON.parse(data);
		      $("#JENIS_LAYANAN").val(parse.data.JENIS);
		      $("#BILLER_REQUEST_ID_ADD").val(parse.data.BILLER_REQUEST_ID);
		      $("#JENIS_NOTA").val(parse.data.JENISNota);
		      $("#TGLNOTA").val(parse.data.TRX_DATE);
		      $("#JmlTagihan").val(parse.data.AMOUNT);
		      if(parse.data.ATTRIBUTE3 != '')
			  { $("#PENGGUNA_JASA").val(parse.data.CUSTOMER_NAME); }
			  else
			  { $("#PENGGUNA_JASA").val(parse.data.ATTRIBUTE3); }

		      console.log(data);
		      // $('#update_unit').modal('show');
		    });
	    }
      });


    $("#noNota").on('onchange',(function(e) {
		e.preventDefault();

		alert("e");
		// loaddata();
	}));

    function clearreset(){
		window.location.reload(true);
	}

	function refreshRedaksi()
	{
	    // alert('123');
	    var path = '';
	    path = "<?php echo ROOT.'einvoice/unit/getNota';?>";
	    // var KODE_LAYANAN = 'KAPAL';

	    $.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	    ,INV_NOTA_LAYANAN:$("#KODE_LAYANAN").val()
	    }).done(function( data ) {
	      // INV_NOTA_JENIS
	      var parse = JSON.parse(data);
	      var html = "<option value='' selected>All</option>";
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


<script type="text/javascript">

var idKoreksi ;
function link_kapal(){
	window.location.href="<?php echo ROOT;?>einvoice/nota/adv_kapal";
}

function onMyFrameLoad(){

	$('.check_invoice').attr('disabled',false);

}
function create_invoice(){
	var url ='<?php echo ROOT;?>einvoice/nota/cetak_koreksi/koreksi/'+idKoreksi;
	window.location.href= url;
}
function koreksiForm(TRX_NUMBER,statusKoreksi,ket){
	// alert(ket);
	if (statusKoreksi == 1) {
		$("#STATUS_KOREKSI").prop( "checked", true );

	} else {
		$("#STATUS_KOREKSI").prop( "checked", false );
	}

	if (ket != null) {
		$("#KETERANGAN_KOREKSI").val(ket);
	} else {
		$("#KETERANGAN_KOREKSI").val("");
	}
	$("#noNotaEdit").val(TRX_NUMBER);
	$("#BILLER_REQUEST_ID").val(TRX_NUMBER);
	$('#modal_main').modal('show');

	path = "<?php echo ROOT.'einvoice/koreksi/koreksiGetOne';?>";

	  $.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	    ,TRX_NUMBER:TRX_NUMBER
	    }).done(function( data ) {
	      // INV_NOTA_JENIS
	      var parse = JSON.parse(data);
	      $("#JENIS_LAYANANEDIT").val(parse.data.JENIS);
	      $("#BILLER_REQUEST_ID").val(parse.data.BILLER_REQUEST_ID);
	      $("#JENIS_NOTAEdit").val(parse.data.JENISNota);
	      $("#TGLNOTAEdit").val(parse.data.TRX_DATE);
	      $("#JmlTagihanEdit").val(parse.data.AMOUNT);
	      $("#PENGGUNA_JASAEdit").val(parse.data.ATTRIBUTE3);
	      $("#Tgl_pengjuanEdit").val(parse.data.TANGGAL_KOREKSI);

	      console.log(data);
	      // $('#update_unit').modal('show');
	    });

}

function Cetak($id){
	// window.location.href="<?php echo ROOT;?>einvoice/nota/cetak_nota/"+$id;
	idKoreksi = $id;
	$('.check_invoice').attr('disabled',true);
	$('#form_dtjk').modal('show');
	var url ='<?php echo ROOT;?>einvoice/nota/cetak_koreksi/koreksi/'+$id;
	$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "'+url+'" onload="onMyFrameLoad(this)"/></iframe>');

}



	$( document ).ready(function() {
		loaddata();
		// alert( "ready!" );
	});

	function loaddata(){
		// alert('1234');
		// alert(1234);
		var path = '';
		path = "<?php echo ROOT.'einvoice/koreksi/koreksisearch';?>";

		var ID_NOTA 	= $("#ID_NOTA").val();
		var Costumer 	= $("#Costumer").val();
		// var MODULE 	= ''; $("#KODE_LAYANAN").val();///utk : KAPAL atau RUPA atau KOREKSI atau PETIKEMAS
		var MODULE 	= $("#KODE_LAYANAN option:selected").text();;///utk : KAPAL atau RUPA atau KOREKSI atau PETIKEMAS
    	var START_DATE 	= $("#START_DATE").val();
		var END_DATE 		= $("#END_DATE").val();
		var KODE_LAYANAN = $("#INV_NOTA_JENIS").val();
		$('#tableKoreksi').DataTable({
				"destroy": true,
				"order": [[ 2, "desc" ]],
			  	"dom" : "brtlp",
				"ajax": {
				    "url": path,
				    data : function ( d ) {
		          		d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
		          		// d.ID_NOTA = ID_NOTA ;
		          		d.TRX_NUMBER = $("#ID_NOTA").val();
		          		d.STATUS_KOREKSI = 1;
						d.CUSTOMER_NAME = Costumer ;
		          		d.BPRP = $("#NO_BPRP").val() ;
		          		d.UPER = $("#NO_UPER").val() ;
						d.MODULE = MODULE ;
            d.START_DATE = START_DATE;
            d.END_DATE = END_DATE;
            d.KODE_LAYANAN = KODE_LAYANAN;
            d.UNIT_CODE 		= '<?php echo $this->session->userdata('unit_id') ?>';
	       	d.ROLE_TYPE		= '<?php echo $this->session->userdata('role_type') ?>';
	       	d.ORG_ID			= '<?php echo $this->session->userdata('unit_org') ?>';
					    d.STATUS_LUNAS	= $("#STATUS_BAYAR").val();
			        },
				    "type": "POST"
				  },
				  "columns": [
		                        { "data": "TRX_NUMBER" },
		                        { "data": "JENIS" },
		                        // { "data": "JENIS" },
		                        { "data": "TRX_DATE" },
		                        { "data": "CUSTOMER_NAME" },
		                        { "data": "statusKoreksi" },
		                        { "data": "action" },
		                    ],
			});
		/*$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			ID_NOTA:ID_NOTA,
			CUSTOMER_NAME:Costumer,
			MODULE:MODULE
		}).done(function( data ) {
			var data1 = JSON.parse(data);
			// alert (Object.keys(data1).length);	die;
			var html = '';
			var i;
			for(i=0; i<Object.keys(data1).length; i++){
				var $id = data1[i].TRX_NUMBER;
				var $enable1='';
				var $enable2=''; //hide
				html += '<tr>'+
						'<td>'+data1[i].TRX_NUMBER+'</td>'+
						'<td>'+data1[i].HEADER_CONTEXT+'</td>'+
						'<td>'+data1[i].HEADER_SUB_CONTEXT+'</td>'+
						'<td>'+data1[i].TRX_DATE+'</td>'+
						'<td>'+data1[i].CUSTOMER_NAME+'</td>'+
						'<td>'+data1[i].AMOUNT+'</td>'+
						'<td>'+data1[i].STATUS+'</td>'+
						'<td><input type=checkbox name=c1 checked></td>'+
						'<td><input type=checkbox name=c1 checked></td>'+
						'<td><center>'+
									'<button type="button" class="btn btn-primary '+$enable1+'" onclick="Cetak(\''+$id+'\')" > '+
									'<i class="fa fa-table" ></i></button>'+
									// '<button type="button" class="btn btn-link '+$enable2+'" onclick="Cetak(\''+$id+'\')" > '+
									// '<i class="fa fa-print" ></i></button>'+
									'<a target="_blank" class="btn btn-primary '+$enable2+'" href="<?php echo ROOT;?>einvoice/nota/cetak_koreksi/koreksi/'+data1[i].TRX_NUMBER+'"> '+
									'<i class="fa fa-print" ></i></a>'+
						'</center></td>'+
						'</tr>';
			}
			// alert(html);die;
			// $('#show_data').html(html);

        });
*/
        return false;
	}


</script>
