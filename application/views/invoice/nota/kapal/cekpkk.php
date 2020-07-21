<style type="text/css">
.centered
{
    text-align:center;
}
td{
	font-size: 13px;
}
.table tbody > tr > td:first-child {font-size: 13px;font-weight: 100;}
</style>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>Kapal</li>
			<li class="active"><span>CEK PKK</span></li>
		</ol>

		<h1>CEK PKK</h1>
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
											<label for="" class="col-sm-4 control-label">No PKK</label>
											<div class="row">
												<div class="col-xs-4">
													<input type="input" name="NO_UKK" id="NO_UKK" class="form-control" placeholder="No PKK">

												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- <div class="box-body">
									<div class="form-group">
										<div class="box-body">
											<label for="" class="col-sm-4 control-label">No PPKB</label>
											<div class="row">
												<div class="col-xs-4">
													<input type="input" name="" id="" class="form-control" placeholder="No PPKB">

												</div>
											</div>
										</div>
									</div>
								</div> -->
							</div>


							<div class="box-body">
							            <div class="col-sm-12 text-right">
								              <button type="button" class="btn btn-primary btn-sm" style="color:white;" onclick="clearreset()"> Clear</button>
								              <button type="submit" class="btn btn-primary btn-sm" onclick="loaddata()"><i class="fa fa-search" style="color:white;"> </i> Search</button>
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
					<table id="tablekapal" class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>No PKK</th>
								<th>Kode Kapal (Nama Kapal)</th>
								<th>Tanggal Jam Tiba</th>
								<th>Tanggal Jam Keluar</th>
								<th>Three Portied</th>
								<th>Kode Proses</th>
							</tr>
						</thead>
						<tbody>
							<!--tr>
								<td>1</td>
								<td>BAJ00000</td>
								<td>KPL987 TANTO MANIS</td>
								<td>28/02/2018 20.00</td>
								<td>29/02/2018 17.00</td>
								<td>Upper</td>
								<td>3</td>
							</tr-->


						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js">
</script>

<script type="text/javascript">
	$('#tgl_nota').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		startDate: '-3d'

	});
	$('#tgl_nota2').datepicker({
		autoclose:true,
		format: 'dd/mm/yyyy',
		startDate: '-3d'

	});

</script>

<script>

$("#formsearch").on('submit',(function(e) {
		e.preventDefault();
		loaddata();
	}));

function clearreset() {
	window.location.reload(true);
}


function loaddata() {
  tablekapal.draw();
  return false;
}

var tablekapal ;
$( document ).ready(function() {
  var path = '';
  path = "<?php echo ROOT.'einvoice/nota/pkk_search';?>";
  tablekapal = $('#tablekapal').DataTable({
      // "destroy": true,
      "serverSide": true,
      "processing": true,
      "order": [[ 4, "desc" ]],
      "dom" : "brtlp",
      "ajax": {
          "url": path,
          data : function ( d ) {
                d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                d.BRANCH_CODE = '<?php echo $this->session->userdata('unit_id') ?>';
                d.NO_UKK = $("#NO_UKK").val();
            },
          "type": "POST"
        },
        "columns": [
                          { "data": "num" },
                          { "data": "NO_UKK" },
                          { "data": "NM_KAPAL" },
                          { "data": "TGL_JAM_TIBA" },
                          { "data": "TGL_JAM_BERANGKAT" },
                          { "data": "THREE_PARTIED" },
                          { "data": "KD_PROSES" },
                      ],
    });
});

</script>

<script>
function link_kapal(){
	window.location.href="<?php echo ROOT;?>einvoice/nota/adv_kapal";
}
</script>
