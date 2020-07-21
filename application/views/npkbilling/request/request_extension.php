	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				<header class="main-box-header clearfix">
					<h2>Create New</h2>
                    <i>(Please click create to make a new Stacking Extension Request)</i>
				</header>
										
				<div class="main-box-body clearfix">
					<form class="form-inline" role="form" action="<?=ROOT?>npkbilling/request_extension/create_extension">
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
					<h2 class="pull-left">List Stacking Extension</h2>
				</header>
								
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="list-extension">
							<thead>
								<tr>
									<th>NO</th>
									<th>NOMOR REQUEST</th>
									<th>TANGGAL REQUEST</th>
									<th>CUSTOMER NAME</th>
									<th>NAMA VESSEL</th>
									<th>STATUS</th>
									<th>REMARK</th>
									<th>ACTION</th>
								</tr>	
							</thead>
							<tbody>
								<?php $no = 1; foreach ($list_extension as $list) {
									$isDisabled = ($list->del_status == "2" || $list->del_status == "3") ? "disabled" : "";
								?>
									<tr>
										<td><?=$no?></td>
										<td><?=$list->del_no?></td>
										<td><?=$list->del_date?></td>
										<td><?=$list->del_cust_name?></td>
										<td><?=$list->del_vessel_name?></td>
										<td><?=$list->reff_name?></td>
										<!-- <td><?php echo $list->del_status == '1' ? 'Draft' : 'Send';?></td> -->
										<td><?=$list->del_mark?></td>
										<td style="font-size: 15.7px;">
											<a class="btn btn-success open-AddBookDialogApprove"  href="#" data-id="<?=$list->del_id?>" data-toggle="modal" data-target="#modal-send" <?php echo $list->del_status == "2" || $list->del_status == "3" ? "disabled" : ""; ?>><span class="glyphicon glyphicon-send" title="Approve Proforma"></span></a>
											<!-- <a class="btn btn-success" href="void:javascript(0)" onclick="send_extension_approval(<?=$list->del_id?>)" data-toggle="tooltip" title="Send Approval" <?php $isDisabled ?> ><span class="glyphicon glyphicon-send"></span></a> -->
											<a class="btn btn-primary" href="<?=ROOT?>npkbilling/request_extension/view_extension/<?=$list->del_id?>" data-toggle="tooltip" title="Lihat Data"><span class="glyphicon glyphicon-list-alt"></span></a>
											<a class="btn btn-danger" href="<?=ROOT?>npkbilling/request_extension/edit_extension/<?=$list->del_id?>" data-toggle="tooltip" title="Edit Data" <?php echo $list->del_status == "2" || $list->del_status == "3" ? "disabled" : ""; ?>><span class="glyphicon glyphicon-edit"></span></a>
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

	<div class="modal fade" id="modal-send">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Informasi</h4>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin?&hellip;</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button id="btn-modal-send" class="btn btn-primary">Simpan</button>
				</div>
			</div>
		</div>
	</div>
					
<script>
$('[data-toggle="tooltip"]').tooltip();  
$('#list-extension').DataTable();

$(document).on("click", ".open-AddBookDialogApprove", function () {
	var id = $(this).data('id');
	$('#btn-modal-send').click(function(){ 
		send_extension_approval(id); 
		return false; 
	});
});

function send_extension_approval(extension_id) {
	$('#modal-send').modal('hide');
	var url = '<?=ROOT?>npkbilling/request_extension/send_extension_approval';

	$.blockUI();

	$.ajax({
		type: 'post',
		url: url,
		data: {
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			extension_id : extension_id 
		},
		success:function(data){
			var response = JSON.parse(JSON.parse(data));
			no_req = response.no_req;

			if (response.Success == true) {
				alert('Request berhasil terkirim..');
				sendExt_log(no_req);

				setTimeout(function(){ window.location = "<?=ROOT?>npkbilling/request_extension"; }, 3000);	
			} else {
				alert('Request gagal terkirim..');
			}
			$.unblockUI();

		}
	});
}

function sendExt_log(no_req){
	$.ajax({
		url: "<?=ROOT?>npkbilling/transaction_log/sendExt_log",
		type: 'POST',
		//dataType: 'json',
		data: {
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			no_req 			: no_req,

		},
		success: function( data ) {
			console.log(data);
		}
	});
}

</script>