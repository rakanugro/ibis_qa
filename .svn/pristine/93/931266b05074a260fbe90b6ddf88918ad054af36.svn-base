<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix">
            <header class="main-box-header clearfix">
                <h2 class="pull-left">Daftar Kontainer</h2>
            </header>

            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table id="table-container" class="table table-striped table-hover">
                        <thead>
                            <tr>
								<th><span>Hapus</span></a></th>
                                <th><span>No Kontainer</span></a></th>
                                <th><span>Ukuran</span></a></th>
                                <th><span>Tipe</span></a></th>
                                <th><span>Status</span></a></th>
								<th><span>Temperature</span></a></th>
								<th><span>Transit</span></a></th>
                                <th><span>Tinggi</span></a></th>
                                <th><span>Berbahaya</span></a></th>
                                <th><span>Carrier</span></a></th>
								<th><span>Commodity</span></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach($detail as $det) {  ?>
                            <tr>
								<td>
									<a onclick='delete_cont("<?=$det['NO_CONTAINER']?>","<?=$no_request?>","<?=$det['CARRIER']?>")' style='cursor:pointer' title='Delete'><span class='fa-stack'><i class='fa fa-square fa-stack-2x'></i>
									<i class='fa fa-trash-o fa-stack-1x fa-inverse'></i></span></a>
								</td>
                                <td>
                                    <a href="#"> <?=$det['NO_CONTAINER']?></a>
                                </td>
                                <td>
                                    <?=$det['SIZE_CONT']?>
                                </td>
                                <td>
                                    <a href="#"><?=$det['TYPE_CONT']?></a>
                                </td>
                                <td>
                                    <a href="#"><?=$det['STATUS_CONT']?></a>
                                </td>
								<td>
                                    <a href="#"><?=$det['TEMP']?></a>
                                </td>
								<td>
                                    <a href="#"><?=$det['TRANSIT']?></a>
                                </td>
                                <td>
                                    <?=$det['HEIGHT']?>
                                </td>
                                <td>
                                    <a href="#"><?=$det['HZ']?></a>
                                </td>
                                <td>
                                    
									<input type="text" class="form-control" id="carriercont" name="carriercont" data-toggle="tooltip" data-placement="bottom" value="<?=$det['CARRIER'];?>" size="3" readOnly>
                                </td>
								<td>
                                    <a href="#"><?echo "[".$det['KD_COMODITY']."] ".trim($det['NM_COMMODITY']);?></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                 <!--<input type="button" value="Submit Request" onclick="alldone()" id="submit_all" name="submit_all" class="btn btn-success"/>-->
				 <button type="submit" id="save_draft" onclick="$('#save_draft').attr('disabled','disabled');window.open('<?=ROOT.'container_receiving/main_receiving'?>','_self')" class="btn btn-success">Next</button>
            </div>
        </div>
        
    </div>
</div>
<script>
    function alldone(){
        var request_no = $("#request_no").val();
        var port = $("#port").val();
		
		/*edited by gandul, submit request no event dan akan diganti di form approval*/
        /*****commented
		var url = "<?=ROOT?>/container_receiving/submit_request";
        $.post(url,{request_no:request_no,port:port},function(data){
             var obj = jQuery.parseJSON(data);
             if(obj.rc=="S"){
                 var notification = new NotificationFx({
                        message : '<p>Permintaan Receiving Berhasil</p>',
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'success', // notice, warning, error or success 
                        onClose : function() {
						  window.open("<?=ROOT?>/container_receiving/main_receiving","_self");
					   }
                });
                 notification.show();
             }
             else {
                 var notification = new NotificationFx({
                        message : '<p>Permintaan Receiving Gagal </p><br/>'+obj.rcmsg,
                        layout : 'growl',
                        effect : 'jelly',
                        type : 'error' // notice, warning, error or success 
                });
             }
        });
		commented*****/
		window.open("<?=ROOT?>/container_receiving/main_receiving","_self");
    }
</script>