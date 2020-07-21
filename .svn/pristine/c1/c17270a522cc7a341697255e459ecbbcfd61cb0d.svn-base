<?php echo validation_errors(); ?>
<div class="table-responsive">
					<table id="table-example" class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Entity</th>
								<th>Nama Entity</th>
								<th>Wilayah</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<?php
							$no=1;
							 foreach($prods as $test) { ?>
						<tbody>
							<tr>
								<td><?php echo $no++;?></td>
								<td><?php echo $test->INV_ENTITY_KODE;?></td>
								<td><?php echo $test->INV_ENTITY_NAME;?></td>
								<td><?php echo $test->INV_WILAYAH_NAME;?></td>
								<td>Aktif</td>
								<td>
									<button type="Clear" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add_entity">Master Bank</button>
									<button type="Clear" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add_wilayah"> Master Wilayah</button>
									<button type="Clear" class="btn btn-primary btn-lg" data-toggle="" data-target=""><i class="fa fa-pencil-square"></i></button>
									<button type="Clear" class="btn btn-primary btn-lg" data-toggle="" data-target=""><i class="fa fa-minus"></i></button>
								</td>
							</tr>
						</tbody>
						<?php }?>
					</table>
				</div>

<div id="add_entity" class="modal fade" role="dialog">
	<div class="modal-dialog">

	<div style="background-color:#B22222;" class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 style="color:white"; class="modal-title">Add Entity</h4>
	</div>
	<div class="modal-content">
    <form method="post" action="<?php echo base_url('ibis_qa/index.php/einvoice/administrasi/masterentity/masterentitysave');?>">
        <div>
            <label for="category">Category</label>
            <select name="category">
                <?php
                foreach ($cats as $cat) {
                    echo '<option value="' . html_escape($cat['CATEGORY']) . '">' . html_escape($cat['CATEGORY']) . '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <label for="pname">Product Name</label>
            <input type="text" name="pname" value="">
        </div>
        <div>
            <label for="price">Price</label>
            <input type="text" name="price" value="">
        </div>
        <div>
            <label for="manufacturer">Manufacturer</label>
            <input type="text" name="manufacturer" value="">
        </div>
        <div>
        </div>

		<div class="modal-footer">
		        <!-- <button type="button"  id="" onclick="send()" class="btn btn-default">Save</button> -->
				<input type="submit" value="Save" />
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>

		</div>

	</form>
    </div>
    </div>
</div>

<script type="text/javascript">

	$( document ).ready(function() {
		loaddata();
		// alert( "ready!" );
	});

	function loaddata(){
		// alert('1234');
		// alert(1234);
		var path = '';
		// path = "<?php echo base_url('ibis_qa/index.php/einvoice/nota/adv_petikemas');?>";
		path = "<?php echo ROOT.('einvoice/nota/adv_petikemas');?>";
		alert(path);
		var ID_NOTA 	= $("#ID_NOTA").val();
		var ID_REQ 		= $("#ID_REQ").val();
		// var STATUS 		= $("#STATUS").val();
		var STATUS 		= 'P';
		var CUSTOMER_NAME 		= $("#CUSTOMER_NAME").val();
		var CREATION_DATE 		= $("#tgl_nota").val();
		var TRX_DATE 		= $("#keluar_nota").val();

		$.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			TRX_NUMBER:ID_NOTA,
			BILLER_REQUEST_ID:ID_REQ,
			STATUS:STATUS,
			CUSTOMER_NAME:CUSTOMER_NAME,
			CREATION_DATE:CREATION_DATE,
			TRX_DATE:TRX_DATE
		}).done(function( data ) {
			var data1 = JSON.parse(data);
			var html = '';
			var i;
			for(i=0; i<Object.keys(data1).length; i++){
				html += '<tr>'+
						'<td>'+data1[i].TRX_NUMBER+'</td>'+
						'<td>'+data1[i].TERMINAL+'</td>'+
						'<td>'+data1[i].HEADER_SUB_CONTEXT+'</td>'+
						'<td>'+data1[i].TRX_DATE+'</td>'+
						'<td>'+data1[i].CUSTOMER_NAME+'</td>'+
						'<td>'+data1[i].AMOUNT+'</td>'+
						'<td>'+data1[i].STATUS+'</td>'+
						'<td><center><input type="checkbox"></center></td>'+
						'<td><center><input type="checkbox"></center></td>'+
						'<td><center><a target="_blank" href="<?php echo ROOT;?>einvoice/nota/cetak_nota/petikemas?'+data1[i].TRX_NUMBER+'"><i class="fa fa-print"></i></a></center></td>'+
						'</tr>';
			}
			// alert(html);die;
			$('#show_data').html(html);
        });

        return false;
	}
</script>
