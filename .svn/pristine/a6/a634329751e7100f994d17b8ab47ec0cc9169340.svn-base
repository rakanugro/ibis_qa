<style type="text/css">
	.centered {
		text-align: center;
	}

	th {
		text-align: center;
		width: 20px;
	}

	tbody>tr>td:nth-child(7) {
		text-align: right;
	}

	tbody>tr>td:nth-child(8) {
		text-align: center;
	}

	.table tbody>tr>td:first-child {
		font-size: 13px;
		font-weight: 100;
	}
</style>
<?php
$no_ukk_create='';
if($no_ukk_create!= null) {
	$no_ukk_create =$_GET["UKK_CREATE"];
}

?>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Kapal</li>
			<li class="active">
				<span>Nota</span>
			</li>
		</ol>

		<h1>NOTA KAPAL (CUSTOMER)</h1>
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
							<div class="col-md-5">
								<div class="box-body">
									<!--
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No PPKB</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="NO_PPKB" id="NO_PPKB" class="form-control" placeholder="No PPKB">
												</div>
											</div>
										</div>
									</div>
									-->
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
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No PKK</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="NO_PKK" id="NO_PKK" class="form-control" placeholder="No PKK" value="<?php echo $no_ukk_create ?>">
												</div>
											</div>
										</div>
									</div>


									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">Jenis Nota</label>
											<div class="row">
												<div class="col-xs-5">
													<select for="" name="KODE_LAYANAN" id="KODE_LAYANAN" class="form-control select" style="width: 100%;">
														<option value="">ALL</option>
														<?php for ($i=0; $i < count($jenisnota); $i++) { ?>
														<option value="<?php echo $jenisnota[$i]->INV_NOTA_CODE; ?>">
															<?php echo $jenisnota[$i]->INV_NOTA_JENIS; ?>
														</option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="box-body">
								<!--
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Customer</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="CUSTOMER" id="CUSTOMER" class="form-control" placeholder="Customer">
												</div>
											</div>
										</div>
									</div>
									-->
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Status Bayar</label>
											<div class="row">
												<div class="col-xs-5">
													<select for="" name="STATUS_BAYAR" id="STATUS_BAYAR" class="form-control select" style="width: 100%;">
														<option value="">ALL</option>
														<option value="Y">LUNAS</option>
														<option value="X">KOREKSI</option>
														<option value="XY">BELUM LUNAS</option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Tanggal Nota</label>
											<div class="row">
												<div class="col-xs-3">
													<div class="input-group">
														<input type="date" name="TGL_NOTA_START" id="TGL_NOTA_START" class="form-control form_datetime" placeholder="dd/mm/yy" style="width: 160px;">

													</div>
												</div>
												<label for="" class="col-sm-2 control-label">Tanggal Akhir</label>
												<div class="col-xs-3">
													<div class="input-group">
														<input type="date" name="" name="TGL_NOTA_FINISH" id="TGL_NOTA_FINISH" class="form-control form_datetime" placeholder="dd/mm/yy"
														 style="width: 160px;">

													</div>
												</div>
											</div>
										</div>
									</div>
									<!--
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Bulan</label>
											<div class="row">
												<div class="col-xs-3">
													<div class="input-group">

														<select id="month_date" class="form-control">
															<option value=""> - </option>
															<option value="01">January</option>
															<option value="02">Febuary</option>
															<option value="03">March</option>
															<option value="04">April</option>
															<option value="05">May</option>
															<option value="06">June</option>
															<option value="07">July</option>
															<option value="08">August</option>
															<option value="09">September</option>
															<option value="10">October</option>
															<option value="11">November</option>
															<option value="12">Desember</option>
														</select>
													</div>
												</div>
												<label for="" class="col-sm-1 control-label">Tahun</label>
												<div class="col-xs-3">
													<div class="input-group">
														<select id="year_date" class="form-control">
															<option value=""> - </option>
															<?php $yearago = get_years_ago(10); foreach ($yearago as $value) {?>
															<option value="<?php echo $value;?>">
																<?php echo $value?>
															</option>
															<?php }?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									-->
								</div>
							</div>


							<div class="box-body">
								<div class="col-sm-12 text-right">
									<button type="button" class="btn btn-primary btn-sm" data-toggle="" data-target="" onclick="clearreset()"> Clear</button>
									<button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
										<i class="fa fa-search"></i> Search</a>
									</button>
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


<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="main-box-body clearfix">
				<div class="table-responsive">
					<table id="tableKapal" class="table table-hover">
						<thead>
							<tr>
								<th>No Nota</th>
								<th>No PKK</th>
								<th>No PPKB</th>
								<th>Nama Kapal</th>
								<th>Periode Kunjungan</th>
								<th>Tanggal Nota</th>
								<th>Jumlah Tagihan</th>
								<th>Status Bayar</th>
								<th width="150px">Nota</th>
							</tr>
						</thead>
						<tbody>


						</tbody>
					</table>
				</div>
				<!-- <div class="col-md-6">
					<div class="box-body">
						<div class="form-group">
				            <div class="col-sm-offset-10 col-sm-10">
				              <button onclick="exportall()" class="btn btn-primary btn-sm">Print All in this List</button>
				            </div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>
<!--add by Derry utk kebutuhan eService : 10 Oct 2019-->
<div id="form_dtjk" class="modal fade" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div id="review">
		<div class="modal-content">
	        <div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">DTJK DPJK <span class="text-help"></span></h4>
	        </div>
			<div class="modal-body" style="height:500px; ">
				<input type="text" id="ukk_ready" value=""  class="hidden">
				<input type="text" id="cab_ready" value="" class="hidden">
				<input type="text" id="ppkb_ready" value="" class="hidden">
				<span class="text-me"></span>
			</div>

			<div class="modal-footer">
			<button type="button" class="btn btn-sm pull-left" data-dismiss="modal">Tutup</button>
			</div>
	    </div>
	   </div>
	</div>
</div>
<!-- end by Derry-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js">
</script>

<script type="text/javascript">
	$("#formsearch").on('submit', (function (e) {
		let bulan = $("#month_date").val(),
			tahun = $('#year_date').val();
		e.preventDefault();
		loaddata(bulan, tahun);
	}));
</script>

<script>
	$(document).ready(function () {
		var table = $('#table-example').dataTable({
			'info': false,
			"lengthChange": false,
			'sDom': 'lTr<"clearfix">tip',
			'oTableTools': {
				'aButtons': [
					{
						'sExtends': 'collection',
						'sButtonText': '<i class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>',
						'aButtons': ['csv', 'xls', 'pdf', 'copy', 'print']
					}
				]
			}
		});
	});

	function clearreset() {
		window.location.reload(true);
	}


</script>

<script>
	function SetDate($date) {
		var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
			"Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var dt1;
		var formattedDate1 = new Date($date);
		var d1 = formattedDate1.getDate();
		var m1 = monthNames[formattedDate1.getMonth()];
		var y1 = formattedDate1.getFullYear();
		dt1 = d1 + '-' + m1 + '-' + y1;

		return dt1;
	}

	function GetDate(str) {
		var arr = str.split("-");
		var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

		var month = (1 + months.indexOf(arr[1].toLowerCase())).toString();
		if (month.length == 1) month = '0' + month;
		var year = '20' + parseInt(arr[2]);
		var day = parseInt(arr[0]);
		var result = year + '-' + month + '-' + ((day < 10) ? "0" + day : day);
		return result;
	}

</script>


<script type="text/javascript">

	var idKapal;
	function link_kapal() {
		window.location.href = "<?php echo ROOT;?>einvoice/nota/adv_kapal";
	}

	function onMyFrameLoad() {

		$('.check_invoice').attr('disabled', false);

	}
	function create_invoice() {
		var url = '<?php echo ROOT;?>einvoice/nota_kapal/cetak_nota_kapal/' + idKapal;
		window.location.href = url;
	}
	function Cetak($id) {
		// window.location.href="<?php echo ROOT;?>einvoice/nota/cetak_nota/"+$id;
		idKapal = $id;
		$('.check_invoice').attr('disabled', true);
		$('#form_dtjk').modal('show');
		var url = '<?php echo ROOT;?>einvoice/nota_kapal/cetak_nota_kapal/' + $id;
		$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "' + url + '" onload="onMyFrameLoad(this)"/></iframe>');

	}



	$(document).ready(function () {
		var bulan;
		var tahun;
		var d = new Date();
		var n = ('0' + (d.getMonth() + 1)).slice(-2);
		var n_year = ('0' + d.getFullYear()).slice(-4);
		if($("#month_date").val('') && $("#year_date").val(''))
		{
			let bulan = '',
				tahun = '';		
		}		
		else
		{
			let bulan = $("#month_date").val(n),
				tahun = $("#year_date").val(n_year);				
		}

		loaddata(bulan, tahun);
	});
	
	function loaddata(bulan, tahun) {
		var path = '';
		path = "<?php echo ROOT.'einvoice/nota/kapalsearch';?>";

		var ID_NOTA = $("#ID_NOTA").val();
		var Costumer = $("#Costumer").val();
		var MODULE = 'KAPAL'; ///utk : KAPAL atau RUPA atau BARANG atau PETIKEMAS
		var START_DATE = $("#TGL_NOTA_START").val();
		var END_DATE = $("#TGL_NOTA_FINISH").val();
		var KODE_LAYANAN = $("#KODE_LAYANAN").val();
		$('#tableKapal').DataTable({
			"destroy": true,
			"order": [[2, "desc"]],
			"dom": "brtlp",
			//"processing": true,
			//"serverSide": true,				
			"ajax": {
				"url": path,
				data: function (d) {
					d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
					// d.ID_NOTA = ID_NOTA ;
					d.TRX_NUMBER = $("#ID_NOTA").val();
					d.CUSTOMER_NAME = Costumer;
					d.NO_PKK = $("#NO_PKK").val();
					d.NO_PPKB = $("#NO_PPKB").val();
					// d.month_date = $("#month_date").val();
					// d.year_date = $('#year_date').val();
					d.month_date = bulan;
					d.year_date = tahun;
					d.MODULE = MODULE;
					// d.SOURCE_INVOICE =SOURCE_INVOICE;
					d.START_DATE = START_DATE;
					d.END_DATE = END_DATE;
					d.KODE_LAYANAN = KODE_LAYANAN;
					d.UNIT_CODE = '<?php echo $this->session->userdata('unit_id') ?>';
					d.ROLE_TYPE = '<?php echo $this->session->userdata('role_type') ?>';
					d.ORG_ID = '<?php echo $this->session->userdata('unit_org') ?>';
					//add by derry utk eService : 5 Oct 2019
					d.CUST_ID = '<?php echo $this->session->userdata('customerid_phd') ?>';					
					d.STATUS_LUNAS = $("#STATUS_BAYAR").val();					
				},
				"type": "POST"
			},
			"columns": [
				{ "data": "TRX_NUMBER" },
				{ "data": "NO_PKK" },
				{ "data": "NO_PPKB" },
				{ "data": "VESSEL_NAME" },
				{ "data": "PER_KUNJUNGAN" },
				{ "data": "TRX_DATE" },
				{ "data": "jumlah" },
				{ "data": "STATUS_LUNAS" },
				//{ "data": "STATUS" },
				//{ "data": "PC" },
				//{ "data": "PK" },
				{ "data": "action" },
			],
		});


		return false;
	}
//add By Derry utk cetak Pranota di Nota Kapal 10 Oct 2019
  $(document).on('click','.btn-ok',function(e){

                 var ukk = $(this).attr('data-id');
                 var cab 	= $(this).attr('data-branch');
                 var ppkb = $(this).attr('data-ppkb');
                $("#invoicing").css("display","none");
                jQuery.ajax({

	           		url: '<?php echo ROOT;?>dashboard_invoice/cekInvoicing/'+ukk+'/'+ppkb,
	                type: "POST",
	               	data: {
		               	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                  	},
	                success:function(data){
	                	console.log("====>"+data);
	                	if(data=="1"){
	                		$("#invoicing").css("display","");
	                	}else{
	                		if (data != undefined && data != null && data.length > 0) {
	                			alert(data);
	                		} else {
	                			alert('Data kapal belum dapat invoicing.');
	                		}
	                	}
	                },
	                error: function (jqXHR, textStatus, errorThrown){
				 	  	alert('False Exeption while request..');
				 		return false;
				 	}
	        	});
                 // alert(ukk + '-' + cab +'-'+ppkb);
                 $('#form_dtjk').modal({

						show:true,
						backdrop:'static'



				});
                 $('.text-help').text(ukk);

                 // $( "#review" ).load(window.location.href + " #review" );

                 jQuery.ajax({

	           		url: '<?php echo ROOT;?>dashboard_invoice/cetak_dpjk/'+ukk+'/'+cab+'/'+ppkb,
	                type: "POST",
		               data: {
		               	'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
	                  	NO_UKK:ukk,
	                  	BRANCH_CODE:cab,
	                  	KD_PPKB:ppkb
	                  },

	                beforeSend: function() {
	                       $('.text-me').text('  Loading data... Please wait');
	                       $('.check_invoice').attr('disabled',true);

	                 		},
	                success:function(data){
	                	$('.text-help').text(ukk);
						var url ='<?php echo ROOT;?>dashboard_invoice/cetak_dpjk/'+ukk+'/'+cab+'/'+ppkb;
	                	$('.text-me').html('<iframe  class="the_pdf" style="height: 100%;width:100%;"  src= "'+url+'" /></iframe>')
						$('#ukk_ready').val(ukk);
						$('#cab_ready').val(cab);
						$('#ppkb_ready').val(ppkb);
						 $('.check_invoice').attr('disabled',false);
	     //            	$('.modal-body').load(location.href );
	     //            	$('.the_pdf').attr('src', url);



	                },
	                 error: function (jqXHR, textStatus, errorThrown){
				 	  	alert('False Exeption while request..');
				 	 	 return false;
				 	 }





	        	});



        });	

</script>