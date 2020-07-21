<style type="text/css">
	.centered {
		text-align: center;
	}

	th {
		text-align: center;
	}

	tbody>tr>td:nth-child(5) {
		text-align: right;
	}

	tbody>tr>td:nth-child(6) {
		text-align: center;
	}

	tbody>tr>td:nth-child(7) {
		text-align: center;
	}

	tbody>tr>td:nth-child(8) {
		text-align: center;
	}

	.table tbody>tr>td:first-child {
		font-size: 13px;
		font-weight: 100;
	}
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Barang</li>
			<li class="active">
				<span>Nota</span>
			</li>
		</ol>

		<h1>NOTA BARANG</h1>
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
											<label for="" class="col-sm-3 control-label">No BPRP/</br>Request</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="NO_BPRP" id="NO_BPRP" class="form-control" placeholder="No BPRP/Request">
												</div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-3 control-label">No Uper</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="NO_UPER" id="NO_UPER" class="form-control" placeholder="No Uper">
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
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Customer</label>
											<div class="row">
												<div class="col-xs-5">
													<input type="text" name="Costumer" id="Costumer" class="form-control" placeholder="Customer">
												</div>
											</div>
										</div>
									</div>

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
									</div>

									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-2 control-label">Bulan</label>
											<div class="row">
												<div class="col-xs-4">
													<div class="input-group">
														<!-- <div class="col-sm-6"> -->
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
														<!-- </div> -->
														<!-- <div class="col-sm-6">
															<select class="form-control">
																<option>2018</option>
															</select>
														</div> -->
														<!-- <input type="month" name="MONTH" id="MONTH" class="form-control form_datetime" placeholder="Month" > -->

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

								</div>
							</div>
							<div class="box-body">
								<div class="col-sm-12 text-right">
									<button type="button" class="btn btn-primary btn-sm" onclick="clearreset()"> Clear</button>
									<button type="submit" class="btn btn-primary btn-sm">
										<!-- <a href="<?php //echo base_url('');?>" > -->
										<i class="fa fa-search"> </i> Search
										<!-- </a> -->
									</button>
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
								<th>No Nota</th>
								<!-- <th>Area</th> -->
								<th>No Request</th>
								<th>Jenis Nota</th>
								<th>Tanggal Nota</th>
								<th>Customer</th>
								<th>Jumlah Total</th>
								<th>Status Bayar</th>
								<!--th>Status Nota</th-->
								<th>Pernah Cetak</th>
								<th>Pernah Kirim</th>
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


<!-- <div class="md-modal md-effect-4" id="modal-4"> -->
<div id="kapalpreview" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" ; class="modal-title">Preview DPJK</h4>
			</div>
			<div class="modal-body">
				<form action="" id="form">
					<div class="form-group">
						<div class="box-body">
							<label for="exampleTextarea"></label>
							<textarea class="form-control" id="exampleTextarea" rows="3" placeholder="nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<div class="centered">
					<button type="submit" class="btn btn-primary">Ubah Status ke A4</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="kapalprint" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="background-color:#B22222;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" ; class="modal-title">Preview Print DPJK</h4>
			</div>
			<div class="modal-body">
				<form action="" id="form">
					<div class="form-group">
						<div class="box-body">
							<label for="exampleTextarea"></label>
							<textarea class="form-control" id="exampleTextarea" rows="3" placeholder="nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf nanti isi halaman print pdf"></textarea>
						</div>
					</div>
				</form>
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
					<h4 style="color:white" ; class="modal-title">Invoice
						<span class="text-help"></span>
					</h4>
				</div>
				<div class="modal-body" style="height:500px; ">
					<input type="text" id="ukk_ready" value="" class="hidden">
					<input type="text" id="cab_ready" value="" class="hidden">
					<input type="text" id="ppkb_ready" value="" class="hidden">
					<span class="text-me"></span>
				</div>

				<div class="modal-footer">
					<a href="javascript:void(0)" class="btn btn-primary check_invoice" data-id="" onClick="create_invoice()">
						<i class="fa fa fa-file-text-o"></i> Invoice</a>
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
				<h4 style="color:white" ; class="modal-title">Confirmation</span>
				</h4>
			</div>
			<div class="modal-body" style="height:300px; ">
				<span class="convert_help">Apakah Anda yakin untuk mengubah status nota ini menjadi 4A?</span>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="ok">OK</button>
				<button type="button" data-dismiss="modal" class="btn">Cancel</button>
			</div>

		</div>


	</div>

</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js">
</script>

<script type="text/javascript">
	// $(".form_datetime").datepicker({
	//     format: "dd/mm/yyyy",
	//     todayBtn: true,
	//     autoclose: true,
	// });
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

	var idBarang;
	function link_kapal() {
		window.location.href = "<?php echo ROOT;?>einvoice/nota/adv_kapal";
	}

	function onMyFrameLoad() {

		$('.check_invoice').attr('disabled', false);

	}
	function create_invoice() {
		var url = '<?php echo ROOT;?>einvoice/nota/cetak_barang/barang/' + idBarang;
		window.location.href = url;
	}
	function Cetak($id) {
		// window.location.href="<?php echo ROOT;?>einvoice/nota/cetak_nota/"+$id;
		idBarang = $id;
		$('.check_invoice').attr('disabled', true);
		$('#form_dtjk').modal('show');
		var url = '<?php echo ROOT;?>einvoice/nota/cetak_barang/barang/' + $id;
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
		// alert('1234');
		// alert(1234);
		var path = '';
		path = "<?php echo ROOT.'einvoice/nota/barangsearch';?>";

		var ID_NOTA = $("#ID_NOTA").val();
		var Costumer = $("#Costumer").val();
		var MODULE = 'BARANG'; ///utk : KAPAL atau RUPA atau BARANG atau PETIKEMAS
		var START_DATE = $("#START_DATE").val();
		var END_DATE = $("#END_DATE").val();
		var KODE_LAYANAN = $("#KODE_LAYANAN").val();
		$('#tableBarang').DataTable({
			"destroy": true,
			"order": [[2, "desc"]],
			"dom": "brtlp",
			//"processing": false,
			//"serverSide": false,			  
			"ajax": {
				"url": path,
				data: function (d) {
					d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
					// d.ID_NOTA = ID_NOTA ;
					d.TRX_NUMBER = $("#ID_NOTA").val();
					//d.BILLER_REQUEST_ID = $("#NO_BPRP").val();
					d.CUSTOMER_NAME = Costumer;
					d.BPRP = $("#NO_BPRP").val();
					// d.month_date = $("#month_date").val();
					// d.year_date = $('#year_date').val();
					d.month_date = bulan;
					d.year_date = tahun;
					d.UPER = $("#NO_UPER").val();
					d.MODULE = MODULE;
					// d.SOURCE_INVOICE =SOURCE_INVOICE;
					d.START_DATE = START_DATE;
					d.END_DATE = END_DATE;
					d.KODE_LAYANAN = KODE_LAYANAN;
					d.UNIT_CODE = '<?php echo $this->session->userdata('unit_id') ?>';
					d.ROLE_TYPE = '<?php echo $this->session->userdata('role_type') ?>';
					d.ORG_ID = '<?php echo $this->session->userdata('unit_org') ?>';
					d.STATUS_LUNAS = $("#STATUS_BAYAR").val();
				},
				"type": "POST"
			},
			"columns": [
				{ "data": "TRX_NUMBER" },
				// { "data": "HEADER_CONTEXT" },
				{ "data": "BILLER_REQUEST_ID" },					
				{ "data": "JENIS" },
				{ "data": "TRX_DATE" },
				{ "data": "CUSTOMER_NAME" },
				{ "data": "jumlah" },
				{ "data": "STATUS_LUNAS" },
				//{ "data": "STATUS" },
				{ "data": "PC" },
				{ "data": "PK" },
				{ "data": "action" },
			],
		});


		return false;
	}


</script>