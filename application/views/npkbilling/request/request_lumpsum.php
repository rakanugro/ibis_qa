	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2>Create New</h2>
                    <i>(Please click create to make a new lumpsum Request)</i>
				</header>
										
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npkbilling/request_lumpsum/create_lumpsum">
						<button type="submit" id="submit_form" onclick="" class="btn btn-success">Create</button>
					</form>
				</div>
			</div>
		</div>	
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="main-box clearfix">
				<header class="main-box-header clearfix">
					<h2 class="pull-left">List Lumpsum</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="list-lumpsum">
							<thead>
								<tr>
									<th>NO</th>
									<th >NOMOR LUMPSUM</th>
									<th >TANGGAL LUMPSUM</th>
									<th >NOMOR KONTRAK</th>
									<th >CUSTOMER NAME</th>
									<th >TIPE KEGIATAN</th>
									<th >STATUS</th>
									<th >REMARK</th>
									<th >ACTION</th>
								</tr>	
							</thead>
							<tbody>
								<?php $no = 1; foreach ($list_lumpsum as $list) { 
									$status = ($list->lumps_status == 3 || $list->lumps_status == 2)? "disabled" : ""; ?>
									<tr>
										<td><?=$no?></td>
										<td><?=$list->lumps_no?></td>
										<td><?=$list->lumps_date?></td>
										<td><?=$list->lumps_contract_no?></td>
										<td><?=$list->lumps_cust_name?></td>
										<td><?=$list->lumps_booking_type_name?></td>
										<td><?=$list->reff_name?></td>
										<td><?=$list->lumps_mark?></td>
										<td style="font-size: 15.7px;">
											<a class='btn btn-success <?php echo $status ?>' href="void:javascript(0)" onclick="send_lumpsum_approval(<?=$list->lumps_id?>)" data-toggle="tooltip" title="Send Approval"><span class="glyphicon glyphicon-send"></span></a>
											<a class='btn btn-primary' href="<?=ROOT?>npkbilling/request_lumpsum/view_lumpsum/<?=$list->lumps_id?>" data-toggle="tooltip" title="Lihat Data"><span class="glyphicon glyphicon-list-alt"></span></a>
											<a class='btn btn-danger <?php echo $status ?>' href="<?=ROOT?>npkbilling/request_lumpsum/edit_lumpsum/<?=$list->lumps_id?>" data-toggle="tooltip" title="Edit Data"><span class="glyphicon glyphicon-edit"></span></a>
										</td>										
									</tr>
								<?php $no++; } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
					
<script>
	$('[data-toggle="tooltip"]').tooltip();  
	$('#list-lumpsum').DataTable();

	function send_lumpsum_approval(lumpsum_id) {
		var url = '<?=ROOT?>npkbilling/request_lumpsum/send_lumpsum_approval';

		var response = confirm("Apakah anda yakin?");

		if (response) {
			$.blockUI();
		
			$.ajax({
				type: 'post',
				url: url,
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
					lumpsum_id : lumpsum_id 
				},
				success:function(data){

					if (data === 'Success') {
						var notification = new NotificationFx({
							message : '<p>Data Berhasil Dikirim</p><br/>',
							layout : 'growl',
							effect : 'jelly',
							type : 'success' // notice, warning, error or success
						});

						setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/request_lumpsum"; }, 3000);	
					} else {
						var notification = new NotificationFx({
							message : '<p>Data Gagal Dikirim</p><br/>',
							layout : 'growl',
							effect : 'jelly',
							type : 'error' // notice, warning, error or success
						});

						setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/request_lumpsum"; }, 3000);
					}
					$.unblockUI();

				}
			});
		}

	}

</script>